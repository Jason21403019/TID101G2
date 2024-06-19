<?php
header("Content-Type: application/json");
include("./conn.php");

// 獲取原始的 POST 資料
$postData = file_get_contents("php://input");
$data = json_decode($postData, true);

// 簡單驗證
if ($data['password'] !== $data['confirmPassword']) {
    echo json_encode(["success" => false, "message" => "Passwords do not match"]);
    exit();
}

// 準備和綁定
$stmt = $conn->prepare("INSERT INTO users (full_name, phone, email, password) VALUES (?, ?, ?, ?)");
if ($stmt === false) {
    echo json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]);
    exit();
}

$stmt->bind_param("ssss", $full_name, $phone, $email, $hashed_password);

// 設置參數並執行
$full_name = $data['full_name'];
$phone = $data['phone'];
$email = $data['email'];
$hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);

if ($stmt->execute()) {
    echo json_encode(["success" => true]); 
} else {
    echo json_encode(["success" => false, "message" => "Execute failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();

?>