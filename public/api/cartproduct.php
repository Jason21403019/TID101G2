<?php

// 設置CORS頭部
header("Access-Control-Allow-Origin: http://localhost:5173"); // 允許特定的域名
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// 設置返回的內容類型
header('Content-Type: application/json');

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include './conn.php'; 

// if ($conn->connect_error) {
//     die("連接失敗: " . $conn->connect_error);
// }

$member_id = 'M001'; // 假設會員ID從GET參數獲取

$sql = "SELECT cart.id, cart.product_id, cart.count, product.name, product.picture, product.price, product.details FROM cart JOIN product ON cart.product_id = product.id WHERE cart.member_id = $member_id";

$result = $conn->query($sql);

$items = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

echo json_encode($items);

$conn->close();
?>

   





