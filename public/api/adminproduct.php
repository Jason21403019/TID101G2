<?php
header('Access-Control-Allow-Origin: *'); // 注意：生產環境請勿使用 *，要限制允許的來源網域
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT'); 
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');
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
        
            $sql = "SELECT id, brand, name, details, price, stock, content, product_class_id FROM product WHERE 1=1 ";
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
                    $id = isset($data['id']) ? $data['id'] : null;
                    $brand = htmlspecialchars($data['brand']);
                    $name = htmlspecialchars($data['name']);
                    $details = htmlspecialchars($data['details']);
                    $price = intval($data['price']); 
                    $stock = intval($data['stock']); 
                    $subpage_photo = htmlspecialchars($data['subpage_photo']);
                    $picture = isset($data['picture']) && $data['picture'] !== null ? base64_decode($data['picture']) : null;
                    $subpage_photo = isset($data['subpage_photo']) && $data['subpage_photo'] !== null ? base64_decode($data['picture']) : null;
                    $content = htmlspecialchars($data['content']);
                    $product_class_id = htmlspecialchars($data['product_class_id']);
                    $stmt = $conn->prepare("INSERT INTO product (id, brand, name, details, price, stock, subpage_photo, picture, content, product_class_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$id, $brand, $name, $details, $price, $stock, $subpage_photo, $picture, $content, $product_class_id]);
                    echo json_encode(["message" => "Product added successfully.", "id" => $conn->lastInsertId()], 201);
                } else {
                    echo json_encode(["error" => "Invalid input."], 400);
                }
                break;
            
            case 'PUT':
                // 修改商品
                $data = json_decode(file_get_contents("php://input"), true);
                $id = isset($data['id']) ? $data['id'] : ''; 
                $new_id = isset($data['new_id']) ? $data['new_id'] : '';                 
                if (json_last_error() === JSON_ERROR_NONE && !empty($id) && !empty($data)) {
                    // 過濾使用者輸入
                    $brand = htmlspecialchars($data['brand']);
                    $name = htmlspecialchars($data['name']);
                    $details = htmlspecialchars($data['details']);
                    $price = intval($data['price']);
                    $stock = intval($data['stock']);
                    $subpage_photo = isset($data['subpage_photo']) && $data['subpage_photo'] !== null ? base64_decode($data['subpage_photo']) : null;
                    $picture = isset($data['picture']) && $data['picture'] !== null ? base64_decode($data['picture']) : null;
                    $content = htmlspecialchars($data['content']);
                    $product_class_id = htmlspecialchars($data['product_class_id']);
            
                    // 如果圖片為 null，我們不更新圖片欄位
                    if ($picture === null) {
                        $stmt = $conn->prepare("UPDATE product SET brand=?, name=?, details=?, price=?, stock=?, subpage_photo=?, content=?, product_class_id=?, id = CASE WHEN ? != '' THEN ? ELSE id END WHERE id=?");
                        $stmt->execute([$brand, $name, $details, $price, $stock, $subpage_photo, $content, $product_class_id, $new_id, $new_id, $id]);
                    } else {
                        $stmt = $conn->prepare("UPDATE product SET brand=?, name=?, details=?, price=?, stock=?, subpage_photo=?, picture=?, content=?, product_class_id=?, id = CASE WHEN ? != '' THEN ? ELSE id END WHERE id=?");
                        $stmt->execute([$brand, $name, $details, $price, $stock, $subpage_photo, $picture, $content, $product_class_id, $new_id, $new_id, $id]);
                    }
                    
                    echo json_encode(["message" => "Product updated successfully."], 200);
                } else {
                    echo json_encode(["error" => "Invalid input."], 400);
                }
                break;
            

        case 'DELETE':
            // 刪除商品
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            if (!empty($id)) {
                $stmt = $conn->prepare("DELETE FROM product WHERE id = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_STR); 
                $stmt->execute();
                echo json_encode(["message" => "Product deleted successfully."]);
            } else {
                echo json_encode(["error" => "Invalid input."], 400); 
            }
            break;
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()], 500);
}

$conn = null;
?>
