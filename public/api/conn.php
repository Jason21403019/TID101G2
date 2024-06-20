<?php
header("Access-Control-Allow-Origin: *"); // 允許特定的域名
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// // 設置返回的內容類型
header('Content-Type: application/json');
// 資料庫連線設定
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "tid101_g2";

try {
    
    // 建立連線
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // 設定錯誤模式為異常
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
    exit();
}
?>
