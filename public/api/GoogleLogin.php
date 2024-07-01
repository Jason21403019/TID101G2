<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conn.php");

//設定取得Google API 三要素：用戶端編號、用戶端密鑰、已授權的重新導向URI
$clientID = '1044890836835-r8en0b6503kt2ee6fdt1d4oto00a63jb.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUrl = 'http://localhost/TID101G2/public/api/GoogleLogin.php';

// 建立client端 的 request需求 給 Google
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->addScope('email');

//$_GET['code']的'code' 是取得 [授權碼]
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    //取得GOOGLE使用者帳號資訊
    $gauth = new Google_Service_Oauth2($client);
    $google_info = $gauth->userinfo->get();
    $email = $google_info->email;
    
    echo "You are registered using email: " . $email;
} else {
    echo "<a href='" . $client->createAuthUrl() . "'>Login with Google</a>";
}

?>