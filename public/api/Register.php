<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("conn.php");
function getAccessToken($code) {
    $client_id = '
    1044890836835-59gl5r2o3efhla80sosf9lab07uulbj8.apps.googleusercontent.com';
    $client_secret = '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';
    $redirect_uri = 'http://localhost:5173/tid101/g2/';

    $url = 'https://oauth2.googleapis.com/token';
    $data = array(
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code'
    );

    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        return null;
    }

    return json_decode($result, true);
}
function getUserInfo($access_token) {
    $url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token;

    $response = file_get_contents($url);
    if ($response === FALSE) {
        return null;
    }

    return json_decode($response, true);
}

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
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $code = $input['code'];
    
        if ($code) {
            $accessTokenData = getAccessToken($code);
            if ($accessTokenData && isset($accessTokenData['access_token'])) {
                $userInfo = getUserInfo($accessTokenData['access_token']);
                if ($userInfo && isset($userInfo['email'])) {
                    // 在這裡執行用戶註冊或更新操作
                    // 您可能還需要檢查資料庫中是否已經存在這個電子郵件
                    echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve user info']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve access token']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No authorization code provided']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
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