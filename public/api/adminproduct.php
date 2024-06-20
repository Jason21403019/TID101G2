<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

include './conn.php'; // 包含你的資料庫連接文件

try {
    // 判斷請求方法
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'GET') {
        // 檢查是否有查詢參數
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        
        if ($category && $name) {
            $stmt = $conn->prepare("SELECT id, brand, name, details, price, stock, subpage_photo, picture, content, product_class_id FROM product WHERE product_class_id = ? AND name LIKE ?");
            $stmt->execute([$category, "%$name%"]);
        } elseif ($category) {
            $stmt = $conn->prepare("SELECT id, brand, name, details, price, stock, subpage_photo, picture, content, product_class_id FROM product WHERE product_class_id = ?");
            $stmt->execute([$category]);
        } elseif ($name) {
            $stmt = $conn->prepare("SELECT id, brand, name, details, price, stock, subpage_photo, picture, content, product_class_id FROM product WHERE name LIKE ?");
            $stmt->execute(["%$name%"]);
        } else {
            $stmt = $conn->prepare("SELECT id, brand, name, details, price, stock, subpage_photo, picture, content, product_class_id FROM product");
            $stmt->execute();
        }
        
        // 設定 fetch 模式
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $products = $stmt->fetchAll();
        // 處理圖片 BLOB 字段
        foreach ($products as &$product) {
            if (!empty($product['picture'])) {
                // 將 BLOB 資料轉換為 Base64 編碼
                $product['picture'] = base64_encode($product['picture']);
            }
        }
        // 檢查資料是否存在
        if (empty($products)) {
            echo json_encode(["message" => "No records found."]);
        } else {
            echo json_encode($products);
        }
    } elseif ($method == 'POST') {
        // 新增資料
        $data = json_decode(file_get_contents("php://input"), true);
        if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {
            $stmt = $conn->prepare("INSERT INTO product (brand, name, details, price, stock, subpage_photo, picture, content, product_class_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$data['brand'], $data['name'], $data['details'], $data['price'], $data['stock'], $data['subpage_photo'], base64_decode($data['picture']), $data['content'], $data['product_class_id']]);
            echo json_encode(["message" => "Product added successfully."]);
        } else {
            echo json_encode(["error" => "Invalid input."]);
        }
    } elseif ($method == 'DELETE') {
        // 刪除資料
        $data = json_decode(file_get_contents("php://input"), true);
        $id = isset($data['id']) ? $data['id'] : '';
        if (json_last_error() === JSON_ERROR_NONE && !empty($id)) {
            $stmt = $conn->prepare("DELETE FROM product WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(["message" => "Product deleted successfully."]);
        } else {
            echo json_encode(["error" => "Invalid input."]);
        }
    } else {
        echo json_encode(["message" => "Request method not supported."]);
    }
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, '/var/log/php_errors.log'); // 記錄錯誤日誌
    echo json_encode(["error" => $e->getMessage()]);
}
// 關閉連線
$conn = null;
?>