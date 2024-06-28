<?php
require 'conn.php';

header('Content-Type: application/json');

// 設置 CORS 標頭
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// 處理 OPTIONS 請求方法（CORS 預檢請求）
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

if ($method === 'POST') {
    // 檢查必需字段，假設content也是必需的
    if (isset($data['id'], $data['name'], $data['price'], $data['brand'], $data['product_class_id'], $data['details'], $data['stock'], $data['content'])) {
        // 新增商品，包括content欄位
        $stmt = $conn->prepare('INSERT INTO product (id, name, price, brand, product_class_id, details, stock, content) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$data['id'], $data['name'], $data['price'], $data['brand'], $data['product_class_id'], $data['details'], $data['stock'], $data['content']]);
        echo json_encode(['message' => '新增商品成功']);
    } else {
        echo json_encode(['error' => '缺少必需字段']);
    }
}
elseif ($method === 'PUT') {
    // 檢查必需字段
    if (isset($data['name'], $data['price'], $data['brand'], $data['product_class_id'], $data['details'], $data['stock'])) {
        // 修改商品
        $id = basename($_SERVER['REQUEST_URI']);
        $stmt = $conn->prepare('UPDATE product SET name = ?, price = ?, brand = ?, product_class_id = ?, details = ?, stock = ? WHERE id = ?');
        $stmt->execute([$data['name'], $data['price'], $data['brand'], $data['product_class_id'], $data['details'], $data['stock'], $id]);
        echo json_encode(['message' => '修改商品成功']);
    } else {
        echo json_encode(['error' => '缺少必需字段']);
    }
} else {
    echo json_encode(['error' => '無效的請求方法']);
}
?>
