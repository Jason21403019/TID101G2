<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Cross-Origin-Opener-Policy: same-origin-allow-popups");

error_reporting(E_ALL);

include("conn.php");


function getAccessToken($code) {
    $client_id = '1044890836835-i5b1nlnsolrl5gk7oaknhgatt8solpid.apps.googleusercontent.com';
    $client_secret = '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';
    // $redirect_uri = 'http://localhost:5173/tid101/g2/';

    $url = 'https://oauth2.googleapis.com/token';
    $data = array(
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        // 'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code'
    );

    $options = array(
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($data),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded'
        )
    );
    
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    if ($result === false) {
        error_log('Curl error: ' . curl_error($ch));
        return null;
    }
    
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    error_log('HTTP code: ' . $httpCode); // Log HTTP status code
    error_log('Response: ' . $result); // Log response
    
    if ($httpCode !== 200) {
        error_log('HTTP error: ' . $httpCode . ' Response: ' . $result);
        return null;
    }
    
    return json_decode($result, true);
}
    
function getUserInfo($access_token) {
    $url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token;
    
    $response = file_get_contents($url);
    if ($response === FALSE) {
        error_log('Failed to retrieve user info.');
        return null;
    }

    return json_decode($response, true);
}

function generateMemberId() {
    global $conn;
    $stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM member");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $maxId = $row['max_id'];

    if ($maxId) {
        $nextId = intval(substr($maxId, 1)) + 1;
        return "M" . str_pad($nextId, 3, "0", STR_PAD_LEFT);
    } else {
        return "M001";
    }
}

try {
    $conn->beginTransaction();  // 开始事务

    $postData = file_get_contents("php://input");
    $data = json_decode($postData, true);

    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode([
            "success" => false,
            "message" => "Invalid JSON data: " . json_last_error_msg()
        ]);
        exit();
    }

    if (isset($data['code'])) {  // Google 登录处理
        error_log('Authorization code: ' . $data['code']); // Log for the authorization code
        $accessTokenData = getAccessToken($data['code']);
        if ($accessTokenData && isset($accessTokenData['access_token'])) {
            $userInfo = getUserInfo($accessTokenData['access_token']);
            if ($userInfo && isset($userInfo['email'])) {
                $email = $userInfo['email'];
                $full_name = $userInfo['name'] ?? 'Google User';
                $phone = $userInfo['phone'] ?? 'Not Provided';
                $memberId = generateMemberId();

                $stmt = $conn->prepare("INSERT INTO member (id, full_name, phone, email) VALUES (:id, :full_name, :phone, :email)");
                $stmt->bindParam(':id', $memberId);
                $stmt->bindParam(':full_name', $full_name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
            } else {
                error_log('User info: ' . print_r($userInfo, true)); // Log user info response
                error_log('Failed to retrieve user info.');
                echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve user info']);
            }
        } else {
            error_log('Access token data: ' . print_r($accessTokenData, true)); // Log access token data
            error_log('Failed to retrieve access token.');
            echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve access token']);
        }
    } else {  // 常规注册处理
        if (!isset($data['password']) || !isset($data['confirmPassword']) || $data['password'] !== $data['confirmPassword']) {
            echo json_encode(["success" => false, "message" => "Invalid or mismatched password"]);
            exit();
        }
        if (strlen($data['password']) > 255) {
            echo json_encode(["success" => false, "message" => "Password is too long"]);
            exit();
        }
        $memberId = generateMemberId();

        $stmt = $conn->prepare("INSERT INTO member (id, full_name, phone, email, password) VALUES (:id, :full_name, :phone, :email, :password)");
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt->bindParam(':id', $memberId);
        $stmt->bindParam(':full_name', $data['full_name']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        echo json_encode(["success" => true, "message" => "User registered"]);

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
    }

    $conn->commit();  // 提交事务
} catch (Exception $e) {
    $conn->rollBack();
    error_log('Exception: ' . $e->getMessage());
    echo json_encode(["success" => false, "message" => "Exception: " . $e->getMessage()]);
}
?>