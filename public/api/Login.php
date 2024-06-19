<?php

include("./conn.php");
$member = json_decode(file_get_contents("php://input"), true);


if (!isset($member['email']) || !isset($member['password'])) {
    echo json_encode(['success' => false, 'message' => 'Email 和 Password 是必填的']);
    exit;
}


$sql = 'SELECT * FROM TID101_G2.member WHERE email = :email AND password = :password';
$pstmt = $pdo->prepare($sql);
$pstmt->bindValue(':email', $member['email']);
$pstmt->bindValue(':password', $member['password']);
$pstmt->execute();
$members = $pstmt->fetchAll();
$success = count($members) == 1;

header('Content-Type: application/json');

$respBody['success'] = $success;
if ($success) {
    session_start();
    $_SESSION['member'] = $members[0];
} else {
    $respBody['message'] = 'email或password錯誤';
}


echo json_encode($respBody);
exit;
?>