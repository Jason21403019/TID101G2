<?php
// 設置 CORS 標頭
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 處理 OPTIONS 預檢請求
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// 包含資料庫連接檔案
include 'conn.php'; // 確保這裡的路徑正確

try {
    // 獲取請求方法
    $method = $_SERVER['REQUEST_METHOD'];

    // 獲取請求數據
    $data = json_decode(file_get_contents('php://input'), true);

    switch ($method) {
        case 'GET':
            // 讀取邏輯
            $stmt = $conn->prepare("SELECT `id`, `note` FROM `product_class`");
            $stmt->execute();
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($articles);
            break;

        case 'POST':
            // 新增邏輯
            if (!isset($data['id']) || !isset($data['note'])) {
                echo json_encode(['error' => 'Invalid input']);
                exit;
            }

            $stmt = $conn->prepare("INSERT INTO product_class (id, note) VALUES (:id, :note)");
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':note', $data['note']);

            if ($stmt->execute()) {
                echo json_encode(['id' => $data['id'], 'note' => $data['note']]);
            } else {
                echo json_encode(['error' => 'Failed to add product class']);
            }
            break;

        case 'PUT':
            // 更新邏輯
            if (!isset($data['id']) || !isset($data['note'])) {
                echo json_encode(['error' => 'Invalid input']);
                exit;
            }
            $stmt = $conn->prepare("UPDATE product_class SET note = :note WHERE id = :id");
            $stmt->bindParam(':note', $data['note']);
            $stmt->bindParam(':id', $data['id']);

            if ($stmt->execute()) {
                echo json_encode(['id' => $data['id'], 'note' => $data['note']]);
            } else {
                echo json_encode(['error' => 'Failed to update product class']);
            }
            break;

        case 'DELETE':
            // 刪除邏輯
            if (!isset($data['id'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input']);
                exit;
            }

            $stmt = $conn->prepare("DELETE FROM product_class WHERE id = :id");
            $stmt->bindParam(':id', $data['id']);

            if ($stmt->execute()) {
                echo json_encode(['message' => 'Product class deleted successfully']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to delete product class']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>