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


$sql = 'SELECT * FROM TID101_G2.member WHERE email = :email AND password = :password';
$pstmt = $pdo->prepare($sql);
$pstmt->bindValue(':email', $member['email']);
$pstmt->bindValue(':password', $member['password']);
$pstmt->execute();
$members = $pstmt->fetchAll();
$success = count($members) == 1;

// header('Content-Type: application/json');

// $respBody['success'] = $success;

$respBody=array(
    'success'=>$success,
);
if ($success) {
    session_start();
    $_SESSION['member'] = $members[0];
} else {
    $respBody['message'] = 'email或password錯誤';
}


// print_r($respBody);
echo json_encode($respBody);
exit;