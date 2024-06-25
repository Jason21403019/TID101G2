<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("conn.php");

try {
    $member = json_decode(file_get_contents("php://input"), true);

    $sql = 'SELECT * FROM member WHERE email = :email AND password = :password';
    $pstmt = $conn->prepare($sql);

    $pstmt->bindValue(':email', $member['email']);
    $pstmt->bindValue(':password', $member['password']);

    $pstmt->execute();

    $members = $pstmt->fetchAll(PDO::FETCH_ASSOC);

    $success = count($members) >= 1;

    if ($success) {
        $respBody = [
            'success' => true,
            'userid'=>$members[0]['id'],
            'message' => '登入成功'
        ];
    } else {
        $respBody = [
            'success' => false,
            'message' => 'Email 或 Password 錯誤'
        ];
    }

    echo json_encode($respBody);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => '伺服器錯誤',
        'error' => $e->getMessage()
    ]);
}
exit;