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
        // 檢查是否有圖片文件
        $base64Picture = null;
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            // 將圖片轉換為Base64
            $pictureData = file_get_contents($_FILES['picture']['tmp_name']);
            $base64Picture = base64_encode($pictureData);
        } else {
            // 處理沒有圖片的情況，例如設置預設圖片
            $base64Picture = "default_image_base64"; 
        }

        // 新增商品，包括content欄位和圖片
        $stmt = $conn->prepare('INSERT INTO product (id, name, price, brand, product_class_id, details, stock, content, picture) VALUES (:id, :name, :price, :brand, :product_class_id, :details, :stock, :content, :picture)');

        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':brand', $data['brand']);
        $stmt->bindParam(':product_class_id', $data['product_class_id']);
        $stmt->bindParam(':details', $data['details']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':picture', $base64Picture, PDO::PARAM_LOB); // 將圖片以 BLOB 型態綁定

        $stmt->execute();

        echo json_encode(['message' => '新增商品成功']);
    } else {
        echo json_encode(['error' => '缺少必需字段']);
    }
} elseif ($method === 'PUT') {
    // 檢查必需字段
    if (isset($data['name'], $data['price'], $data['brand'], $data['product_class_id'], $data['details'], $data['stock'])) {
        // 檢查是否有圖片文件
        $base64Picture = null;
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            // 將圖片轉換為Base64
            $pictureData = file_get_contents($_FILES['picture']['tmp_name']);
            $base64Picture = base64_encode($pictureData);
        }

        // 修改商品，包括圖片
        $id = basename($_SERVER['REQUEST_URI']);

        // 如果有新的圖片上傳，則更新圖片
        if ($base64Picture !== null) {
            $stmt = $conn->prepare('UPDATE product SET name = :name, price = :price, brand = :brand, product_class_id = :product_class_id, details = :details, stock = :stock, picture = :picture WHERE id = :id');
            $stmt->bindParam(':picture', $base64Picture, PDO::PARAM_LOB); // 將圖片以 BLOB 型態綁定
        } else {
            // 沒有新的圖片上傳，則只更新其他欄位
            $stmt = $conn->prepare('UPDATE product SET name = :name, price = :price, brand = :brand, product_class_id = :product_class_id, details = :details, stock = :stock WHERE id = :id');
        }

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':brand', $data['brand']);
        $stmt->bindParam(':product_class_id', $data['product_class_id']);
        $stmt->bindParam(':details', $data['details']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo json_encode(['message' => '修改商品成功']);
    } else {
        echo json_encode(['error' => '缺少必需字段']);
    }
} else {
    echo json_encode(['error' => '無效的請求方法']);
}
?>