<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include("conn.php"); 
//---------------------------------------------------

// 建立SQL語法
// $member_id = "M001"; // 假設會員ID從GET參數獲取
$member_id = isset($_GET['id']) ? $_GET['id'] : null;

// 確認會員ID有沒有提供
if (empty($member_id)) {
    echo json_encode(['error' => 'No member ID provided']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // 解析 JSON 資料
    $data = json_decode(file_get_contents("php://input"), true);
    //SQL指令 - 修
    $updateSql = "UPDATE TID101_G2.member SET full_name = :full_name, birth = :birth, email = :email, phone = :phone, address = :address WHERE id = :member_id";
    // 將修改後資料帶入
    try {
        $stmt = $conn->prepare($updateSql);
        $stmt->bindParam(':member_id', $member_id);
        $stmt->bindParam(':full_name', $data['full_name']);
        $stmt->bindParam(':birth', $data['birth']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->execute();

        echo json_encode(['success' => '存入']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }

} 
    // 抓取會員ＩＤ資料
    else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = "SELECT full_name, birth, email, phone, address FROM member WHERE id = :member_id";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':member_id', $member_id, PDO::PARAM_STR);
            $stmt->execute();

            //變陣列
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($data)) {
                echo json_encode(['error' => '沒找到ID ' . htmlspecialchars($member_id)]);
            } else {
                echo json_encode($data);
            }
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
?>
