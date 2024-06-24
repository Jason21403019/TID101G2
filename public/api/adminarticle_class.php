<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 處理 OPTIONS 請求
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'conn.php';

// 獲取請求方法
$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

try {
    switch ($method) {
        case 'GET':
            // 讀取數據
            if ($id) {
                $stmt = $conn->prepare("SELECT id, note FROM article_class WHERE id = ?");
                $stmt->execute([$id]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($product) {
                    echo json_encode($product);
                } else {
                    echo json_encode(["message" => "記錄未找到。"]);
                }
            } else {
                $stmt = $conn->prepare("SELECT id, note FROM article_class");
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($products) {
                    echo json_encode($products);
                } else {
                    echo json_encode(["message" => "沒有記錄。"]);
                }
            }
            break;

        case 'POST':
            // 新增數據
            $data = json_decode(file_get_contents('php://input'), true);
            if (!empty($data['id']) && !empty($data['note'])) {
                $stmt = $conn->prepare("INSERT INTO article_class (id, note) VALUES (?, ?)");
                $stmt->execute([$data['id'], $data['note']]);
                echo json_encode(["message" => "記錄添加成功。"]);
            } else {
                echo json_encode(["message" => "無效輸入。"]);
            }
            break;

        case 'PUT':
            // 更新數據
            $data = json_decode(file_get_contents('php://input'), true);
            if (!empty($data['id']) && !empty($data['note'])) {
                $stmt = $conn->prepare("UPDATE article_class SET note = ? WHERE id = ?");
                $stmt->execute([$data['note'], $data['id']]);
                echo json_encode(["message" => "記錄更新成功。"]);
            } else {
                echo json_encode(["message" => "無效輸入。"]);
            }
            break;

        default:
            echo json_encode(["message" => "不支援的請求方法。"]);
            break;
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

// 關閉連接
$conn = null;
?>