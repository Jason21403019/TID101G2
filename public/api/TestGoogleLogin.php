<?php
// 開啟顯示錯誤的設定，方便開發過程中調試
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Cross-Origin-Opener-Policy: same-origin-allow-popups");

error_reporting(E_ALL); // 設置報告所有錯誤

include("conn.php"); // 包含數據庫連接文件

// 函數：通過授權碼獲取訪問令牌
function getAccessToken($code) {
    // 客戶端ID、密鑰和重定向URI，這些都應與Google API控制台中的設置一致
    $client_id = '1044890836835-r8en0b6503kt2ee6fdt1d4oto00a63jb.apps.googleusercontent.com';
    $client_secret = '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';
    $redirect_uri = 'http://localhost:5173/tid101/g2/register';

    // Google OAuth 2.0 令牌請求URL
    $url = 'https://oauth2.googleapis.com/token';
    // 請求數據，包括授權碼和其他必要信息
    $data = array(
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code'
    );

    // cURL 請求選項設置
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        )
    );

    // 初始化 cURL 請求並執行
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    if ($result === false) {
        error_log('Curl error: ' . curl_error($ch)); // 如果cURL請求失敗，記錄錯誤
        return null;
    }

    // 獲取HTTP狀態碼並關閉cURL會話
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // 記錄HTTP狀態碼和響應結果
    error_log('HTTP code: ' . $httpCode);
    error_log('Response: ' . $result);

    // 如果HTTP狀態碼不是200，記錄錯誤
    if ($httpCode !== 200) {
        error_log('HTTP error: ' . $httpCode . ' Response: ' . $result);
        return null;
    }

    // 將結果解析為JSON格式並返回
    return json_decode($result, true);
}

// 函數：通過訪問令牌獲取用戶信息
function getUserInfo($access_token) {
    $url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token;

    // 通過訪問令牌向Google請求用戶信息
    $response = file_get_contents($url);
    if ($response === FALSE) {
        error_log('Failed to retrieve user info.'); // 如果請求失敗，記錄錯誤
        return null;
    }

    // 將結果解析為JSON格式並返回
    return json_decode($response, true);
}

// 函數：生成唯一的會員ID
function generateMemberId() {
    global $conn; // 使用全局的數據庫連接
    $stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM member");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $maxId = $row['max_id'];

    // 如果存在最大ID，生成下一個ID，否則返回"M001"
    if ($maxId) {
        $nextId = intval(substr($maxId, 1)) + 1;
        return "M" . str_pad($nextId, 3, "0", STR_PAD_LEFT);
    } else {
        return "M001";
    }
}

try {
    $conn->beginTransaction();  // 開始數據庫事務

    $postData = file_get_contents("php://input"); // 獲取POST數據
    $data = json_decode($postData, true); // 將POST數據解析為JSON

    // 如果數據無效，返回錯誤信息
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode([
            "success" => false,
            "message" => "Invalid JSON data: " . json_last_error_msg()
        ]);
        exit();
    }

    // 如果數據包含授權碼，進行Google登錄處理
    if (isset($data['code'])) {  
        error_log('Authorization code: ' . $data['code']); // 記錄授權碼
        $accessTokenData = getAccessToken($data['code']); // 獲取訪問令牌
        if ($accessTokenData && isset($accessTokenData['access_token'])) {
            $userInfo = getUserInfo($accessTokenData['access_token']); // 獲取用戶信息
            if ($userInfo && isset($userInfo['email'])) {
                $email = $userInfo['email'];
                $full_name = $userInfo['name'] ?? 'Google User';
                $phone = $userInfo['phone'] ?? 'Not Provided';
                $memberId = generateMemberId();

                // 將用戶信息插入數據庫
                $stmt = $conn->prepare("INSERT INTO member (id, full_name, phone, email) VALUES (:id, :full_name, :phone, :email)");
                $stmt->bindParam(':id', $memberId);
                $stmt->bindParam(':full_name', $full_name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                // 返回成功信息
                echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
            } else {
                error_log('User info: ' . print_r($userInfo, true)); // 記錄用戶信息響應
                error_log('Failed to retrieve user info.'); // 如果用戶信息獲取失敗，記錄錯誤
                echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve user info']);
            }
        } else {
            error_log('Access token data: ' . print_r($accessTokenData, true)); // 記錄訪問令牌數據
            error_log('Failed to retrieve access token.'); // 如果訪問令牌獲取失敗，記錄錯誤
            echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve access token']);
        }
    } else {  // 常規註冊處理
        // 驗證和處理常規註冊數據
        if (!isset($data['password']) || !isset($data['confirmPassword']) || $data['password'] !== $data['confirmPassword']) {
            echo json_encode(["success" => false, "message" => "Invalid or mismatched password"]);
            exit();
        }
        if (strlen($data['password']) > 255) {
            echo json_encode(["success" => false, "message" => "Password is too long"]);
            exit();
        }
        $memberId = generateMemberId();

        // 將用戶信息插入數據庫
        $stmt = $conn->prepare("INSERT INTO member (id, full_name, phone, email, password) VALUES (:id, :full_name, :phone, :email, :password)");
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt->bindParam(':id', $memberId);
        $stmt->bindParam(':full_name', $data['full_name']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        // 返回成功信息
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

    $conn->commit();  // 提交事務
} catch (Exception $e) {
    $conn->rollBack(); // 回滾事務
    error_log('Exception: ' . $e->getMessage()); // 記錄異常錯誤
    echo json_encode(["success" => false, "message" => "Exception: " . $e->getMessage()]); // 返回錯誤信息
}
?>