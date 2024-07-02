<?php
require_once 'conn.php';

// 獲取 POST 請求體並解析 JSON
$input = json_decode(file_get_contents('php://input'), true);

// 確認解析的JSON數據
file_put_contents('php://stderr', "接收到的輸入: " . print_r($input, true) . "\n", FILE_APPEND);

if (json_last_error() !== JSON_ERROR_NONE) {
  file_put_contents('php://stderr', "JSON 錯誤: " . json_last_error_msg() . "\n", FILE_APPEND);
  echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
  exit;
}

// 判斷接收的狀態是什麼
$action = $input['action'];

switch ($action) {
  // 資料列
  case 'fetch':
    fetchMembers();
    break;
  case 'search':
    searchMembers($input['field'], $input['query']);
    break;
  default:
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
    break;
}
$conn = null;



function fetchMembers() {
  global $conn;

  try {
    $sql = "SELECT id, full_name, birth,phone, email, address FROM member";
    $stmt = $conn->query($sql);
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($members) {
        echo json_encode(['success' => true, 'members' => $members]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No members found']);
    }
  } catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error fetching members: ' . $e->getMessage()]);
  }
}

function searchMembers($field, $query) {
  global $conn;

  try {
    // 保護查詢，防止SQL注入
    $allowedFields = ['id', 'full_name', 'phone', 'email'];
    if (!in_array($field, $allowedFields)) {
      echo json_encode(['success' => false, 'message' => 'Invalid field']);
      return;
    }

    $sql = "SELECT id, full_name, phone, email, address FROM member WHERE $field LIKE :query";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
      throw new Exception($conn->errorInfo()[2]);
    }
    $searchQuery = '%' . $query . '%';
    $stmt->bindParam(':query', $searchQuery, PDO::PARAM_STR);
    $stmt->execute();
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($members) {
      echo json_encode(['success' => true, 'members' => $members]);
    } else {
      echo json_encode(['success' => false, 'message' => 'No members found']);
    }
  } catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error searching members: ' . $e->getMessage()]);
  }
}
?>
