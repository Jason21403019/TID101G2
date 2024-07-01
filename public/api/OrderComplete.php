<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include './conn.php';  

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['error' => 'Invalid Request Method']);
    exit();
}

$member_id = isset($_GET['member_id']) ? $_GET['member_id'] : null;
// echo json_encode(['member_id' => $member_id]);
// print_r($member_id);

if (empty($member_id)) {
    echo json_encode(['error' => 'No member_id provided']);
    exit();
}

try {
    $sql = "SELECT
    o.`id`,
    o.`subtotal`,
    o.`discount`,
    o.`total_amount`,
    o.`receiver`,
    o.`receiver_phone`,
    o.`receiver_address`,
    p.`id` AS `product_id`,
    p.`brand`,
    p.`name`,
    p.`details`,
    p.`price`,
    od.`quantity`,
    m.`id` AS `member_id`
    FROM `order` AS o
    LEFT JOIN `member` m ON o.`member_id` = m.`id`
    LEFT JOIN `cart` AS c ON c.`member_id` = m.`id`
    LEFT JOIN `order_details` AS od ON o.`id` = od.`order_id`
    LEFT JOIN `product` AS p ON od.`product_id` = p.`id`
    WHERE c.`member_id` = :member_id
    ORDER BY o.`order_date` DESC
    LIMIT 1";

    $stmt = $conn->prepare($sql);
    // error_log("member_id: " . $member_id);
    // error_log("member_id type: " . gettype($member_id));
    
    $stmt->bindParam(':member_id', $member_id, PDO::PARAM_STR);
    $stmt->execute();

    $orderDetails = null;
    $products = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($orderDetails === null) {
            $orderDetails = [
                'order_id' => $row['id'],
                'subtotal' => $row['subtotal'],
                'discount' => $row['discount'],
                'total' => $row['total_amount'],
                'receiverName' => $row['receiver'],
                'receiverPhone' => $row['receiver_phone'],
                'receiverAddress' => $row['receiver_address'],
                'products' => [],
            ];
        }

        $orderDetails['products'][] = [
           'product_id' => $row['product_id'],
            'brand' => $row['brand'],
            'name' => $row['name'],
            'details' => $row['details'],
            'price' => $row['price'],
            'quantity' => $row['quantity']
        ];
    }

    if ($orderDetails === null) {
        echo json_encode(['error' => 'No data found for the provided member ID']);
    } else {
        echo json_encode($orderDetails);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}
?>
