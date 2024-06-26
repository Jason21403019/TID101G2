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

// ＳＱＬ指令 - 查
if ($method === 'GET') {
    $sql = "SELECT o.id, o.order_date, o.status, p.`name`, o.total_amount, o.payment_status, o.delivery_status, o.member_id
            FROM `order` o
            JOIN order_details od ON o.id = od.order_id
            JOIN product p ON od.product_id = p.id
            WHERE o.member_id = :member_id;";

    try {
        $stmt = $conn->prepare($sql);
        // 綁定會員ID到SQL語句
        $stmt->bindParam(':member_id', $member_id, PDO::PARAM_STR);
        $stmt->execute();
        // 把資料抓出來 封裝成一個二維陣列
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // 轉 JSON
        echo json_encode($data);
        // 關閉游標，釋放資源
        $stmt->closeCursor();
    } catch (PDOException $e) {
        // 有問題就報錯
        echo json_encode(['error' => $e->getMessage()]);
    }

} 
    //訂單狀態 更改
    elseif ($method === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
        //抓訂單 id
        $orderId = $data['orderId'] ?? null;

        // 如果id 是空值就報錯
        if ($orderId === null) {

            echo json_encode(["message" => "缺少orderId"]);
            exit();
        }

        // SQL指令- 修
        $sql = "UPDATE `order` SET status = '已取消' WHERE id = :orderId";

        try {
            $stmt = $conn->prepare($sql);
            // 綁定orderId到SQL語句
            $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $stmt->execute();
            // 成功
            echo json_encode(["message" => "訂單已取消", "orderId" => $orderId]);
        } catch (PDOException $e) {
            //錯誤
            echo json_encode(["message" => "取消訂單失敗: " . $e->getMessage()]);
        }
    } else {
        // 若HTTP方法不是GET或POST，返回不支持的請求方法
        echo json_encode(["message" => "不支援的請求方法"]);
    }
?>
