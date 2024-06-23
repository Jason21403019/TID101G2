<?php

include("./conn.php");
$member = json_decode(file_get_contents("php://input"), true);

if (!isset($member['email']) || !isset($member['password'])) {
    $respBody=array(
        'success' => false,
        'message' => 'Email 和 Password 是必填的'
    );
    echo json_encode($respBody);
    exit;
}

$sql = 'SELECT * FROM member WHERE email = :email AND password = :password';
$pstmt = $pdo->prepare($sql);

if (!$pstmt) {
    echo json_encode(['success' => false, 'message' => '無法準備語句']);
    exit;
}

$pstmt->bindValue(':email', $member['email']);
$pstmt->bindValue(':password', $member['password']);

if (!$pstmt->execute()) {
    echo json_encode(['success' => false, 'message' => '執行查詢失敗']);
    exit;
}

$members = $pstmt->fetchAll();
$success = count($members) == 1;

$respBody=array(
    'success'=>$success,
);

if ($success) {
    session_start();
    $_SESSION['member'] = $members[0];
} else {
    $respBody['message'] = 'email或password錯誤';
}

echo json_encode($respBody);
exit;