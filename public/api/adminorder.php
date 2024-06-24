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
  case 'orderDetails':
    fetchOrderDetails($input['order_id']);
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


function fetchOrderDetails($order_id) {
  global $conn;

  try {
    $sql = "
      SELECT 
          `order`.id AS order_id, 
          `order`.order_date, 
          `order`.status AS order_status, 
          `order`.delivery_status, 
          `order`.payment_method, 
          `order`.delivery_method, 
          `order`.subtotal, 
          `order`.shipping_fee, 
          `order`.discount, 
          `order`.total_amount, 
          `order`.note, 
          `order`.member_id, 
          `member`.full_name AS member_name, 
          `member`.phone AS member_phone, 
          `member`.email AS member_email,
          `order`.payment_status, 
          `order`.receiver, 
          `order`.receiver_phone, 
          `order`.receiver_email, 
          `order`.receiver_address, 
          GROUP_CONCAT(
              JSON_OBJECT(
                  'product_id', `order_details`.product_id,
                  'product_name', `product`.name,
                  'product_brand', `product`.brand,
                  'product_spec', `product`.details,
                  'product_count', `order_details`.count,
                  'product_price', `product`.price
              )
          ) AS products
      FROM 
          `order`
      JOIN 
          `member` ON `order`.member_id = `member`.id
      JOIN 
          `order_details` ON `order`.id = `order_details`.order_id
      JOIN 
          `product` ON `order_details`.product_id = `product`.id
      WHERE 
          `order`.id = :order_id
      GROUP BY 
          `order`.id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_STR);
    $stmt->execute();
    $orderDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($orderDetails) {
        // 將 products 列轉換為 JSON 數組
        $orderDetails['products'] = json_decode('[' . $orderDetails['products'] . ']', true);
        echo json_encode(['success' => true, 'orderDetails' => $orderDetails]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No order details found']);
    }
  } catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage(), 'error' => $e->getMessage()]);
  }
}

?>