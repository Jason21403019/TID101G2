<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("conn.php"); 
// include './conn.php';  

$member_id = isset($_GET['id']) ? $_GET['id'] : null;

if (empty($member_id)) {
    echo json_encode(['error' => 'No member_id']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT 
            cart.id, 
            cart.product_id, 
            cart.count, 
            product.name, 
            product.price AS unitPrice, 
            product.stock, 
            product.details, 
            product.picture 
        FROM cart 
        JOIN product ON cart.product_id = product.id 
        WHERE cart.member_id = :member_id";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':member_id', $member_id, PDO::PARAM_STR);
        $stmt->execute();

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($items)) {
            echo json_encode(['error' => 'No data found for member_id: ' . htmlspecialchars($member_id)]);
        } else {
            echo json_encode($items);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error fetching data: ' . $e->getMessage()]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
    }
}

$conn = null;




?>

   







   







   





