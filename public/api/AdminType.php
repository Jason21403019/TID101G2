<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'conn.php';

try {
    $method = $_SERVER['REQUEST_METHOD'];
    $data = json_decode(file_get_contents('php://input'), true);

    switch ($method) {
        case 'GET':
            $stmt = $conn->prepare("SELECT id, note FROM `product_class`");
            $stmt->execute();
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            http_response_code(200);
            echo json_encode($articles);
            break;

        case 'POST':
            if (!isset($data['id']) || !isset($data['note'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input']);
                exit;
            }

            $stmt = $conn->prepare("INSERT INTO product_class (id, note) VALUES (:id, :note)");
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':note', $data['note']);

            if ($stmt->execute()) {
                http_response_code(201);
                echo json_encode(['id' => $data['id'], 'note' => $data['note']]);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to add product class']);
            }
            break;

        case 'PUT':
            if (!isset($data['id']) || !isset($data['note'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input']);
                exit;
            }
            $stmt = $conn->prepare("UPDATE product_class SET note = :note WHERE id = :id");
            $stmt->bindParam(':note', $data['note']);
            $stmt->bindParam(':id', $data['id']);

            if ($stmt->execute()) {
                http_response_code(200);
                echo json_encode(['id' => $data['id'], 'note' => $data['note']]);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to update product class']);
            }
            break;

        case 'DELETE':
            if (!isset($data['id'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input']);
                exit;
            }

            $stmt = $conn->prepare("DELETE FROM product_class WHERE id = :id");
            $stmt->bindParam(':id', $data['id']);

            if ($stmt->execute()) {
                http_response_code(200);
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
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
