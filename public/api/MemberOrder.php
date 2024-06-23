<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 引入資料庫
include("conn.php");

// 判斷請求方法
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // GET 請求處理邏輯
    $sql = "SELECT * FROM TID101_G2.order;";

    try {
        // 執行並查詢，會回傳查詢結果的物件，必須使用 fetch、fetchAll...等方式取得資料
        $statement = $conn->query($sql);
        $statement->execute();


        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}  
    //訂單狀態轉換
    elseif ($method === 'POST') {
    // POST 邏輯
    $data = json_decode(file_get_contents("php://input"), true);
    $orderId = $data[$orderId] ?? null;

    if ($orderId === null) {
        http_response_code(400); // Bad Request
        echo json_encode(["message" => "缺少orderId"]);
        exit();
    }

    // 更新訂單狀態
    $sql = "UPDATE TID101_G2.order SET status = 'bbb' WHERE id = :orderId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);

    //執行SQL
    try {
        if ($stmt->execute()) {
            echo json_encode(["$orderId"]);
        } 
        //失敗得話
        else {
            http_response_code(500); // Internal Server Error
            echo json_encode(["message" => "取消訂單失敗"]);
        }
    } catch (PDOException $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(["message" => "取消訂單失敗: " . $e->getMessage()]);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["message" => "不支援的請求方法"]);
}
?>
