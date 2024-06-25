<?php

include("conn.php");

try {
    $member = json_decode(file_get_contents("php://input"), true);

    // 驗證是否提供了必要的參數
    if (!isset($member['email']) || !isset($member['password'])) {
        http_response_code(400); // 壞請求
        echo json_encode([
            'success' => false,
            'message' => 'Email 和 Password 是必填的'
        ]);
        exit;
    }

    $sql = 'SELECT * FROM member WHERE email = :email AND password = :password';
    $pstmt = $pdo->prepare($sql);

    // 驗證預處理語句是否成功
    if (!$pstmt) {
        http_response_code(500); // 內部伺服器錯誤
        echo json_encode(['success' => false, 'message' => '無法準備語句']);
        exit;
    }

    $pstmt->bindValue(':email', $member['email']);
    $pstmt->bindValue(':password', $member['password']);

    // 驗證查詢執行是否成功
    if (!$pstmt->execute()) {
        http_response_code(500); // 內部伺服器錯誤
        echo json_encode(['success' => false, 'message' => '執行查詢失敗']);
        exit;
    }

    $members = $pstmt->fetchAll();
    $success = count($members) == 1;

    if ($success) {
        session_start();
        $_SESSION['member'] = $members[0];
        http_response_code(200); // 成功
        $respBody = [
            'success' => true,
            'message' => '登入成功'
        ];
    } else {
        http_response_code(401); // 未授權
        $respBody = [
            'success' => false,
            'message' => 'Email 或 Password 錯誤'
        ];
    }

    echo json_encode($respBody);
} catch (Exception $e) {
    http_response_code(500); // 內部伺服器錯誤
    echo json_encode([
        'success' => false,
        'message' => '伺服器錯誤',
        'error' => $e->getMessage()
    ]);
}
exit;
?>