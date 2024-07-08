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
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["success" => false, "message" => "無效的 JSON 數據"]);
        exit();
    }

    $orderId = $data['orderId'] ?? null;
    $newStatus = $data['newStatus'] ?? null;

    if ($orderId === null || $newStatus === null) {
        echo json_encode(["success" => false, "message" => "缺少orderId或newStatus"]);
        exit();
    }

    if ($newStatus !== '已取消' && $newStatus !== '退換貨中') {
        echo json_encode(["success" => false, "message" => "不支援的訂單狀態"]);
        exit();
    }

    $sql = "UPDATE `order` SET status = :newStatus WHERE id = :orderId";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo json_encode(["success" => true, "message" => "訂單狀態已更新為{$newStatus}", "orderId" => $orderId]);
        } else {
            echo json_encode(["success" => false, "message" => "未找到訂單或狀態未變更"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "更新訂單狀態失敗: " . $e->getMessage()]);
    }
}

?>
