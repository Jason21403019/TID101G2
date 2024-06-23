<?php
require_once 'conn.php';

// 獲取 POST 請求體並解析 JSON
$input = json_decode(file_get_contents('php://input'), true);

// 檢查 JSON 是否成功解析以及 action 是否存在
if (is_null($input) || !isset($input['action'])) {
  echo json_encode(['success' => false, 'message' => 'Invalid input or missing action']);
  exit();
}

// 判斷接收的狀態是什麼
$action = $input['action'];

switch ($action) {
  case 'fetch':
    fetchOrders();
    break;
  default:
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
    break;
}

function fetchOrders() {
  global $conn;

  try {
    $sql = "
      SELECT 
        `order`.id, 
        `order`.order_date, 
        `member`.full_name, 
        `order`.receiver, 
        `order`.status, 
        `order`.payment_status
      FROM `order`
      JOIN `member` ON `order`.member_id = `member`.id";
    
    $stmt = $conn->query($sql);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($orders) {
      echo json_encode(['success' => true, 'orders' => $orders]);
  } else {
      echo json_encode(['success' => false, 'message' => 'No orders found']);
  }
  } catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error fetching orders: ' . $e->getMessage()]);
  }
}


