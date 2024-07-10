<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include("conn.php"); 

$member_id = isset($_GET['id']) ? $_GET['id'] : null;

// 確認會員ID有沒有提供
if (empty($member_id)) {
    echo json_encode(['error' => 'No member ID provided']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 解析 JSON 資料
    $data = json_decode(file_get_contents("php://input"), true);
    
    // 数据验证
    if (empty($data['fullName']) || empty($data['email']) || empty($data['phone']) || empty($data['address'])) {
        echo json_encode(['error' => 'All fields are required']);
        exit;
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['error' => 'Invalid email format']);
        exit;
    }

    //SQL指令 - 修
    $updateSql = "UPDATE member SET full_name = :full_name, email = :email, phone = :phone, address = :address WHERE id = :member_id";
    
    // 將修改後資料帶入
    try {
        $stmt = $conn->prepare($updateSql);
        $stmt->bindParam(':member_id', $member_id);
        $stmt->bindParam(':full_name', $data['fullName']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->execute();

        echo json_encode(['success' => '存入']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
}
?>
