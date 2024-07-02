<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 引入資料庫
include("conn.php");

$method = $_SERVER['REQUEST_METHOD'];
// 設定id抓取
$member_id = $_GET['member_id'] ?? 'default_member_id';

// ＳＱＬ指令
if ($method === 'GET') {
    $sql = "SELECT o.id, o.order_date, o.status, p.`name`, o.total_amount, o.payment_status, o.delivery_status, o.member_id
            FROM `order` o
            JOIN order_details od ON o.id = od.order_id
            JOIN product p ON od.product_id = p.id
            WHERE o.member_id = :member_id;";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':member_id', $member_id, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        $stmt->closeCursor();
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} elseif ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $orderId = $data['orderId'] ?? null;

    if ($orderId === null) {
        echo json_encode(["message" => "缺少orderId"]);
        exit();
    }

    $sql = "UPDATE `order` SET status = '已取消' WHERE id = :orderId";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        echo json_encode(["message" => "訂單已取消", "orderId" => $orderId]);
    } catch (PDOException $e) {
        echo json_encode(["message" => "取消訂單失敗: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["message" => "不支援的請求方法"]);
}
?>
