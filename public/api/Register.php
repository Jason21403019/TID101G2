<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("conn.php");

try {
    // 獲取原始的 POST 資料
    $postData = file_get_contents("php://input");
    $data = json_decode($postData, true);
    
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode([
            "success" => false, 
            "message" => "Invalid JSON data: " . json_last_error_msg()
        ]);
        exit();
    }
    if (strlen($data['password']) > 255) {
        echo json_encode(["success" => false, "message" => "Password is too long"]);
        exit();
    }
    
    // 簡單驗證
    if ($data['password'] !== $data['confirmPassword']) {
        echo json_encode(["success" => false, "message" => "Passwords do not match"]);
        exit();
    }
    
    // 生成會員ID (例如: "M001")
    $stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM member");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $maxId = $row['max_id'];
    
    if ($maxId) {
        $nextId = intval(substr($maxId, 1)) + 1;
        $memberId = "M" . str_pad($nextId, 3, "0", STR_PAD_LEFT);
    } else {
        $memberId = "M001";
    }
    $birth = isset($data['birth']) && $data['birth'] !== '' ? $data['birth'] : '1987-01-01';
    $address = isset($data['address']) ? $data['address'] : null;
    $two_fifty = isset($data['two_fifty']) ? $data['two_fifty'] : 1;
    $five_hundred = isset($data['five_hundred']) ? $data['five_hundred'] : 1;
    
    // 準備和綁定
    $stmt = $conn->prepare("INSERT INTO member (id,password, full_name, birth, phone, email, address, two_fifty, five_hundred
     ) VALUES (:id, :password, :full_name, :birth, :phone, :email, :address, :two_fifty, :five_hundred)");
    
    // 設置參數並綁定
    $full_name = $data['full_name'];
    $phone = $data['phone'];
    $email = $data['email'];
    $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
    
    $stmt->bindParam(':id', $memberId);
    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $data['password']); 
    $stmt->bindParam(':birth', $birth, $birth === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, $address === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmt->bindParam(':two_fifty', $two_fifty);
    $stmt->bindParam(':five_hundred', $five_hundred);
    $stmt->execute();
    
    echo json_encode(["success" => true,"member_id"=>$memberId]); 

    $stmt->closeCursor();
    $conn = null;

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Exception: " . $e->getMessage()]);
}
?>