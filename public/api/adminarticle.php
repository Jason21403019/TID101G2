<?php
header('Content-Type: application/json');

include 'conn.php';

try {
    // 撈取資料
    $stmt = $conn->prepare("SELECT id,name,publisher,publish_date,content,picture,article_status,article_class_id FROM article");
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
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

// 關閉連線
$conn = null;
?>