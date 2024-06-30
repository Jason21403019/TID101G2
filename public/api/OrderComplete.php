<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include './conn.php';

if (!isset($_GET['order_id']) || !isset($_GET['member_id'])) {
    echo json_encode(['error' => 'Missing order_id or member_id']);
    exit;
}



// 获取订单ID和会员ID，这些ID应该由前端以某种方式传递，如通过GET或POST请求
$order_id = $_GET['order_id'];  // 确保前端传递了订单ID
$member_id = $_GET['member_id'];  // 或使用其他安全方式获取

// 扩展SQL语句以包含订单信息
$sql = "SELECT o.id as order_id, o.receiver_name, o.receiver_phone, o.receiver_address, p.name, p.details, p.price, c.count FROM `order o`
        JOIN cart c ON o.member_id = c.member_id
        JOIN product p ON c.product_id = p.id
        WHERE o.id = ? AND c.member_id = ?";

$stmt = $conn->prepare($sql);
$stmt->execute([$order_id, $member_id]);

// 获取查询结果
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 整理返回的数据格式
$order_details = [
    'orderInfo' => [
        'orderId' => $results[0]['order_id'],
        'receiverName' => $results[0]['receiver_name'],
        'receiverPhone' => $results[0]['receiver_phone'],
        'receiverAddress' => $results[0]['receiver_address'],
    ],
    'products' => array_map(function($item) {
        return [
            'name' => $item['name'],
            'details' => $item['details'],
            'price' => $item['price'],
            'count' => $item['count'],
        ];
    }, $results)
];

echo json_encode($order_details);
?>
