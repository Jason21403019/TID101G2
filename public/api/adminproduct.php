<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

include './conn.php'; // 包含你的資料庫連接文件

try {
    // 判斷請求方法
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'GET') {
        // 撈取資料
        $stmt = $conn->prepare("SELECT id, brand, name, details, price, stock, subpage_photo, picture, content, product_class_id FROM product");
        $stmt->execute();

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
    } else {
        echo json_encode(["message" => "Request method not supported."]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

// 關閉連線
$conn = null;
?>