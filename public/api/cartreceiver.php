<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include './conn.php';  // 確保包含你的數據庫連接檔

$member_id = "M001";  // 從GET請求中獲取會員ID

// 準備SQL語句
$sql = "SELECT full_name, email, phone, address FROM member WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $member_id, PDO::PARAM_STR);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['error' => 'No data found']);
}

?>
