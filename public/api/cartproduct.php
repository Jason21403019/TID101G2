<?php

// 允許所有的標頭
header("Access-Control-Allow-Headers: *");




include './conn.php'; 

$member_id = "M001"; // 假設會員ID從GET參數獲取

// $sql = "SELECT cart.id, cart.product_id, cart.count, product.name, product.price AS unitPrice, product.details, product.picture FROM cart JOIN product ON cart.product_id = product.id WHERE cart.member_id = \"".$member_id . "\"";
$sql = "SELECT cart.id, cart.product_id, cart.count, product.name, product.price AS unitPrice, product.stock, product.details, product.picture FROM cart JOIN product ON cart.product_id = product.id WHERE cart.member_id = '".$member_id."'";


// print_r("============\r\n");
// print_r($sql . "\r\n");
// print_r("============\r\n");

$result = $conn->query($sql);

// print_r($result);
$items = array();



// print_r("有" . $result->rowCount() . "筆資料");

if ($result->rowCount() > 0) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // print_r($row["name"]);
        $items[] = $row;
    }
}

// print_r($items);

echo json_encode($items);

$conn = null;

?>

   







   







   





