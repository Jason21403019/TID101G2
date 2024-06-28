<?php
header('Access-Control-Allow-Origin: *'); // 注意：生產環境請勿使用 *，要限制允許的來源網域
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT'); 
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

include './conn.php'; // 包含你的資料庫連接文件

$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($method) {
        case 'OPTIONS':
            http_response_code(200);
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
            exit();
        
        case 'GET':
            // 查詢商品
            $category = isset($_GET['category']) ? $_GET['category'] : '';
            $name = isset($_GET['name']) ? $_GET['name'] : '';

            $sql = "SELECT id, brand, name, details, price, stock, subpage_photo, picture, content, product_class_id FROM product WHERE 1=1 ";
            $params = [];

            if ($category) {
                $sql .= " AND product_class_id = ? ";
                $params[] = $category;
            }
            if ($name) {
                $sql .= " AND name LIKE ? ";
                $params[] = "%$name%";
            }

            $stmt = $conn->prepare($sql);
            $stmt->execute($params);

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // 處理圖片 BLOB 字段
            foreach ($products as &$product) {
                if (!empty($product['picture'])) {
                    $product['picture'] = base64_encode($product['picture']);
                }
            }

            if (empty($products)) {
                echo json_encode(["message" => "No records found."]);
            } else {
                echo json_encode($products);
            }
            break;

        case 'POST':
            // 新增商品
            $data = json_decode(file_get_contents("php://input"), true);

            if (json_last_error() === JSON_ERROR_NONE && !empty($data)) {
                // 过滤用户输入
                $id = isset($data['id']) ? intval($data['id']) : '';
                $brand = htmlspecialchars($data['brand']);
                $name = htmlspecialchars($data['name']);
                $details = htmlspecialchars($data['details']);
                $price = intval($data['price']); 
                $stock = intval($data['stock']); 
                $subpage_photo = htmlspecialchars($data['subpage_photo']);
                $picture = base64_decode($data['picture']); 
                $content = htmlspecialchars($data['content']);
                $product_class_id = htmlspecialchars($data['product_class_id']);

                $stmt = $conn->prepare("INSERT INTO product (brand, name, details, price, stock, subpage_photo, picture, content, product_class_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$brand, $name, $details, $price, $stock, $subpage_photo, $picture, $content, $product_class_id]);
                echo json_encode(["message" => "Product added successfully.", "id" => $conn->lastInsertId()], 201); // 使用 201 Created 状态码，并返回新增商品的 ID
            } else {
                echo json_encode(["error" => "Invalid input."], 400); // 使用 400 Bad Request 状态码
            }
            break;

        case 'PUT':
            // 修改商品
            $data = json_decode(file_get_contents("php://input"), true);
            $id = isset($data['id']) ? intval($data['id']) : ''; 

            if (json_last_error() === JSON_ERROR_NONE && !empty($id) && !empty($data)) {
                // 过滤用户输入
                $brand = htmlspecialchars($data['brand']);
                $name = htmlspecialchars($data['name']);
                $details = htmlspecialchars($data['details']);
                $price = intval($data['price']); 
                $stock = intval($data['stock']); 
                $subpage_photo = htmlspecialchars($data['subpage_photo']);
                $picture = base64_decode($data['picture']); 
                $content = htmlspecialchars($data['content']);
                $product_class_id = htmlspecialchars($data['product_class_id']);

                $stmt = $conn->prepare("UPDATE product SET brand=?, name=?, details=?, price=?, stock=?, subpage_photo=?, picture=?, content=?, product_class_id=? WHERE id=?");
                $stmt->execute([$brand, $name, $details, $price, $stock, $subpage_photo, $picture, $content, $product_class_id, $id]);

                echo json_encode(["message" => "Product updated successfully."], 200); 
            } else {
                echo json_encode(["error" => "Invalid input."], 400); 
            }
            break;

        case 'DELETE':
            // 刪除商品
            $data = json_decode(file_get_contents("php://input"), true);
            $id = isset($data['id']) ? intval($data['id']) : '';

            if (json_last_error() === JSON_ERROR_NONE && !empty($id)) {
                $stmt = $conn->prepare("DELETE FROM product WHERE id = ?");
                $stmt->execute([$id]);
                echo json_encode(["message" => "Product deleted successfully."], 204); // 使用 204 No Content 状态码
            } else {
                echo json_encode(["error" => "Invalid input."], 400); 
            }
            break;

        default:
            echo json_encode(["message" => "Request method not supported."], 405); 
            break;
    }
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, '/var/log/php_errors.log'); 
    echo json_encode(["error" => "Database error."], 500); 
}

$conn = null;
?>
