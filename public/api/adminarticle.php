<?php
header('Content-Type: application/json');

include 'conn.php';

// 確認使用者的請求方式
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'OPTIONS':
        // 處理預檢請求
        http_response_code(200);
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        exit();

    case 'GET':
        // GET 請求 - 讀取資料
        try {
            $stmt = $conn->prepare("SELECT id, name, publisher, publish_date, content, picture, picture2, picture3, article_status, article_class_id FROM article");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $products = $stmt->fetchAll();

            // foreach ($products as &$product) {
            //     if (!empty($product['picture'])) {
            //         $product['picture'] = base64_encode($product['picture']);
            //     }
            //     if (!empty($product['picture2'])) {
            //         $product['picture2'] = base64_encode($product['picture2']);
            //     }
            //     if (!empty($product['picture3'])) {
            //         $product['picture3'] = base64_encode($product['picture3']);
            //     }
            // }

            if (empty($products)) {
                echo json_encode(["message" => "No records found."]);
            } else {
                echo json_encode($products);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
        break;

    case 'POST':
        // POST 請求 - 新增資料
        try {
            $data = json_decode(file_get_contents("php://input"), true);

            // 檢查是否有收到必要的欄位
            if (
                isset($data['id'], $data['name'], $data['publisher'], $data['publish_date'], $data['article_status'], $data['article_class_id'])) {
                $id = $data['id'];
                $name = $data['name'];
                $publisher = $data['publisher'];
                $publish_date = $data['publish_date'];
                $content = isset($data['content']) ? $data['content'] : null; // 檢查是否有內容
                $picture = isset($data['picture']) ? base64_decode($data['picture']) : null; // 檢查是否有圖片
                $picture2 = isset($data['picture2']) ? base64_decode($data['picture2']) : null; // 檢查是否有圖片
                $picture3 = isset($data['picture3']) ? base64_decode($data['picture3']) : null; // 檢查是否有圖片
                $article_class_id = $data['article_class_id'];

                // 使用預處理語句來插入資料
                $stmt = $conn->prepare("INSERT INTO article (id, name, publisher, publish_date, content, picture, picture2, picture3, article_class_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindValue(1, $id);
                $stmt->bindValue(2, $name);
                $stmt->bindValue(3, $publisher);
                $stmt->bindValue(4, $publish_date);
                $stmt->bindValue(5, $content);
                $stmt->bindValue(6, $picture);
                $stmt->bindValue(7, $picture2);
                $stmt->bindValue(8, $picture3);
                $stmt->bindValue(9, $article_class_id);

                if ($stmt->execute()) {
                    echo json_encode(["message" => "Article created successfully."]);
                } else {
                    echo json_encode(["error" => "Failed to create article."]);
                }
            } else {
                echo json_encode(["error" => "Missing required fields."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
        break;

    case 'PUT':
        // PUT 請求 - 更新資料
        try {
            $data = json_decode(file_get_contents("php://input"), true);

            // 檢查是否有收到必要的欄位
            if (isset($data['id'], $data['name'], $data['publisher'], $data['publish_date'], $data['article_class_id'])) {
                $id = $data['id'];
                $name = $data['name'];
                $publisher = $data['publisher'];
                $publish_date = $data['publish_date'];
                $content = isset($data['content']) ? $data['content'] : null; // 檢查是否有內容
                $picture = isset($data['picture']) ? base64_decode($data['picture']) : null; // 檢查是否有圖片
                $picture2 = isset($data['picture2']) ? base64_decode($data['picture2']) : null; // 檢查是否有圖片
                $picture3 = isset($data['picture3']) ? base64_decode($data['picture3']) : null; // 檢查是否有圖片
                $article_class_id = $data['article_class_id'];

                // 使用預處理語句來更新資料
                $stmt = $conn->prepare("UPDATE article SET name = ?, publisher = ?, publish_date = ?, content = ?, picture = ?, picture2 = ?, picture3 = ?, article_class_id = ? WHERE id = ?");
                $stmt->bindValue(1, $name);
                $stmt->bindValue(2, $publisher);
                $stmt->bindValue(3, $publish_date);
                $stmt->bindValue(4, $content);
                $stmt->bindValue(5, $picture);
                $stmt->bindValue(6, $picture2);
                $stmt->bindValue(7, $picture3);
                $stmt->bindValue(8, $article_class_id);
                $stmt->bindValue(9, $id);

                if ($stmt->execute()) {
                    echo json_encode(["message" => "Article updated successfully."]);
                } else {
                    echo json_encode(["error" => "Failed to update article."]);
                }
            } else {
                echo json_encode(["error" => "Missing required fields."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
        break;

    case 'DELETE':
        // DELETE 請求 - 刪除資料
        try {
            $id = isset($_GET['id']) ? $_GET['id'] : null;

            // 檢查是否有收到 ID
            if ($id) {
                // 使用預處理語句來刪除資料
                $stmt = $conn->prepare("DELETE FROM article WHERE id = ?");
                $stmt->bindValue(1, $id);

                if ($stmt->execute()) {
                    echo json_encode(["message" => "Article deleted successfully."]);
                } else {
                    echo json_encode(["error" => "Failed to delete article."]);
                }
            } else {
                echo json_encode(["error" => "Missing article ID."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(["error" => "Invalid request method"]);
}

// 關閉連線
$conn = null;
?>