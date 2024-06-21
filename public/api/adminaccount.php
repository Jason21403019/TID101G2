<?php
require_once 'conn.php';

// 獲取 POST 請求體並解析 JSON
$input = json_decode(file_get_contents('php://input'), true);

// 判斷接收的狀態是什麼
$action = $input['action'];

switch ($action) {
  case 'login':
    login($input);
    break;

    // 資料列
  case 'fetch':
    fetchAdmins();
    break;

    // 新增
  case 'create':
    createAdmin($input);;
    break;

  // 編輯
  case 'update':
    updateAdmin($input);
    break;  
//   檢查email
  case 'checkEmail':
    checkEmail($input);
    break;

  default:
    throw new Exception("Invalid action");
    break;
}

$conn = null;


// 管理者登入的function
function login($data)
{
    global $conn;

    $email = $data['email'];
    $password = $data['password'];
    
    // 查詢使用者資料
    $sql = "SELECT id, employee_name, email, phone, job, admin_status FROM administrator WHERE email = :email AND password = :password LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($result) > 0) {
        echo json_encode(['success' => true, 'adminUser' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => '電子郵件或密碼錯誤']);
    }
}

//  總表
function fetchAdmins() {
    global $conn;

    $sql = "SELECT id, employee_name, email, phone, job, admin_status FROM administrator";
    $stmt = $conn->query($sql);
    $stmt->execute();
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($admins) {
        echo json_encode(['success' => true, 'admins' => $admins]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error fetching admins']);
    }
}

// 新增管理者
function createAdmin($data) {
    global $conn;

    try {
        // 查詢當前資料表中 `id` 欄位的最大值
        $sql = "SELECT MAX(id) as max_id FROM administrator";
        $stmt = $conn->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxId = $result['max_id'];

        // 計算新的 `id`
        $newId = $maxId + 1;

        $name = $data['employee_name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = $data['password'];
        $position = $data['job'];
        $status = $data['admin_status'] ? 1 : 0;

        $sql = "INSERT INTO administrator (id, employee_name, email, phone, password, job, admin_status) VALUES (:id, :name, :email, :phone, :password, :position, :status)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $newId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR); // 確保密碼欄位長度足夠
        $stmt->bindParam(':position', $position, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $newAdmin = [
                'id' => $newId,
                'employee_name' => $name,
                'email' => $email,
                'phone' => $phone,
                'job' => $position,
                'admin_status' => $status
            ];
            echo json_encode(['success' => true, 'newAdmin' => $newAdmin]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error creating admin']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Exception: ' . $e->getMessage()]);
    }
}




// 編輯管理者的function
function updateAdmin($data)
{
    global $conn;

    // 更新使用者資料
    $id = $data['id'];
    $name = $data['employee_name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $position = $data['job'];
    $status = $data['admin_status'] ? 1 : 0;
    $currentAdminId = $data['currentAdminId']; // 當前操作用戶的 ID

    
    try {
        // 獲取當前操作的管理者信息
        $query = $conn->prepare("SELECT * FROM administrator WHERE id = :id");
        $query->bindParam(':id', $currentAdminId, PDO::PARAM_INT);
        $query->execute();
        $currentAdmin = $query->fetch(PDO::FETCH_ASSOC);

        // 獲取目標管理者信息
        $query = $conn->prepare("SELECT * FROM administrator WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $targetAdmin = $query->fetch(PDO::FETCH_ASSOC);

        if ($currentAdmin && $targetAdmin) {
            // 不允許停權自己
            if ($currentAdmin['id'] == $targetAdmin['id'] && $status === 0) {
                throw new Exception('您不能停權自己的帳號');
            }

            $roleHierarchy = [
                '員工' => 1,
                '主管' => 2,
                '老闆' => 3
            ];

            if ($roleHierarchy[$currentAdmin['job']] >= $roleHierarchy[$targetAdmin['job']]) {
                // 當前操作的管理者權限高於目標管理者或同級但不是老闆，允許執行操作
                if (!empty($data['password'])) {
                    $password = $data['password'];
                    $sql = "UPDATE administrator SET employee_name = :name, email = :email, phone = :phone, password = :password, job = :position, admin_status = :status WHERE id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                } else {
                    $sql = "UPDATE administrator SET employee_name = :name, email = :email, phone = :phone, job = :position, admin_status = :status WHERE id = :id";
                    $stmt = $conn->prepare($sql);
                }
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                $stmt->bindParam(':position', $position, PDO::PARAM_STR);
                $stmt->bindParam(':status', $status, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $updatedAdmin = [
                        'id' => $id,
                        'employee_name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'job' => $position,
                        'admin_status' => $status
                    ];
                    echo json_encode(['success' => true, 'updatedAdmin' => $updatedAdmin]);
                } else {
                    throw new Exception('Error executing update statement');
                }
            } else {
                // 當前操作的管理者權限不夠，禁止操作
                throw new Exception('您無權停權此用戶');
            }
        } else {
            throw new Exception('用戶不存在');
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error updating admin', 'error' => $e->getMessage()]);
    }
}

// 檢查 Email 是否存在
function checkEmail($data) {
    try {
        $email = $data['email'];
        if (isset($data['id'])) {
            
            $excludeId = $data['id'];
            $exists = checkEmailExists($email, $excludeId);
        }else{

            $exists = checkEmailExists($email);
        }
        echo json_encode(['exists' => $exists]);
    } catch (Exception $e) {

        echo json_encode(['success' => false, 'message' => 'Exception: ' . $e->getMessage()]);
    }
}

// 檢查 Email 是否重複
function checkEmailExists($email, $excludeId = null) {
    global $conn;

    try {
        $sql = "SELECT COUNT(*) as count FROM administrator WHERE email = :email";
        if ($excludeId) {
            $sql .= " AND id != :id";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        if ($excludeId) {
            $stmt->bindParam(':id', $excludeId, PDO::PARAM_INT);
        }
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // boolean
        return $result['count'] > 0;
    } catch (Exception $e) {
        return false;
    }
}
?>
