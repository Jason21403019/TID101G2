<?php
header('Content-Type: application/json');
// include './conn.php';  
include("conn.php"); 

// 從POST請求中讀取JSON數據
$data = json_decode(file_get_contents('php://input'), true);

// print_r($data);
// 檢查數據完整性
if (!isset($data['receiver'], $data['total_amount'], $data['receiver_phone'], $data['receiver_email'], $data['receiver_address'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    date_default_timezone_set('Asia/Taipei'); // 設置為台灣時區
    // 生成唯一訂單編號和設定其他訂單詳細資料
    $order_id = date('YmdHis');
    $order_date = date('Y-m-d');
    $status = '未處理';
    $delivery_status = '未出貨';
    $delivery_method = '宅配';
    $payment_method = '信用卡';
    $payment_status = '已付款';
    $subtotal = $data['subtotal'];
    $shipping_fee = $data['shipping_fee'];
    $discount = $data['discount'];
    $total_amount = $data['total_amount'];
    $receiver = $data['receiver'];
    $receiver_phone = $data['receiver_phone'];
    $receiver_address = $data['receiver_address'];
    $receiver_email = $data['receiver_email'];
    $member_id = $data['member_id'];  // 假設這也從前端接收
    $note = isset($data['note']) ? $data['note'] : '';

    // 插入數據到數據庫
    $stmt = $conn->prepare("INSERT INTO `order` (id, order_date, status, delivery_status, delivery_method, payment_method, payment_status, subtotal, shipping_fee, discount, total_amount, receiver, receiver_phone, receiver_address, receiver_email, note, member_id) VALUES (:order_id, :order_date, :status, :delivery_status, :delivery_method, :payment_method, :payment_status, :subtotal, :shipping_fee, :discount, :total_amount, :receiver, :receiver_phone, :receiver_address, :receiver_email, :note, :member_id)");

    $stmt->execute([
        'order_id' => $order_id,
        'order_date' => $order_date,
        'status' => $status,
        'delivery_status' => $delivery_status,
        'delivery_method' => $delivery_method,
        'payment_method' => $payment_method,
        'payment_status' => $payment_status,
        'subtotal' => $subtotal,
        'shipping_fee' => $shipping_fee,
        'discount' => $discount,
        'total_amount' => $total_amount,
        'receiver' => $receiver,
        'receiver_phone' => $receiver_phone,
        'receiver_address' => $receiver_address,
        'receiver_email' => $receiver_email,
        'note' => $note,
        'member_id' => $member_id
    ]);

        echo json_encode(['success' => true, 'message' => 'Order submitted successfully', 'order_id' => $order_id]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Failed to submit order: ' . $e->getMessage()]);
    }
?>


