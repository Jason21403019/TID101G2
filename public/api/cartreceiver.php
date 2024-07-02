<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("conn.php"); 

// include './conn.php';  // 確保包含你的數據庫連接檔

// $member_id = "M001";  // 從GET請求中獲取會員ID

// 準備SQL語句
$member_id = isset($_GET['id'])? $_GET['id'] : null;
// echo json_encode(['received_id' => $member_id]);

if(empty($member_id)){
    echo json_encode(['error' => 'No member_id']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT full_name, email, phone, address FROM member WHERE id = :member_id";
    try{
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':member_id', $member_id, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(empty($data)){
            echo json_encode(['error' => 'No data found'. htmlspecialchars($member_id)]);

        } else {
            echo json_encode($data);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error fetching data: ' . $e->getMessage()]);
    }catch (Exception $e) {
        echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
    }

}


?>
