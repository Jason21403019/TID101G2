<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("conn.php");

try {
    $conn->beginTransaction();  // 開始事務
    
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
    
    // 準備和綁定
    $stmt = $conn->prepare("INSERT INTO member (id,password, full_name, birth, phone, email, address
     ) VALUES (:id, :password, :full_name, :birth, :phone, :email, :address)");

    $stmt2 = $conn->prepare("INSERT INTO coupon (id, name, discount, status, member_id ) VALUES (:id, :name, :discount, :status, :member_id ) ;");

    $stmt3 = $conn->prepare("INSERT INTO coupon (id, name, discount, status, member_id ) VALUES (:id, :name, :discount, :status, :member_id ) ;");
    
    // 設置會員參數並綁定
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
    $stmt->execute();
    
     // 插入兩張優惠券
     $couponNames = ['折扣五百元', '貼心免運券'];
     $discounts = [500, 250];
     $status = 1; 
 
     foreach ($couponNames as $index => $name) {
         $randomNumber = rand(1, 10000);
         $couponId = "ilove" . $randomNumber;
         $stmt2->bindParam(':id', $couponId);
         $stmt2->bindParam(':name', $name);
         $stmt2->bindParam(':discount', $discounts[$index], PDO::PARAM_INT);
         $stmt2->bindParam(':status', $status, PDO::PARAM_INT);
         $stmt2->bindParam(':member_id', $memberId);
         $stmt2->execute();
     }
    
    $conn->commit();  // 提交事務
    echo json_encode(["success" => true,"member_id"=>$memberId]); 

    $stmt->closeCursor();
    $conn = null;

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Exception: " . $e->getMessage()]);
}
?>