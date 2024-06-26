<?php
header('Content-Type: application/json');
include './conn.php';  // 包含您的PDO連接設定文件

try {
    // $pdo = new PDO( $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = json_decode(file_get_contents("php://input"), true);

    $order_id = date('YmdHis') . bin2hex(random_bytes(5)); // 生成唯一訂單編號
    $order_date = date('Y-m-d H:i:s'); // 訂單日期
    $status = '未處理';
    $delivery_status = '未出貨';
    $delivery_method = '宅配';
    $payment_method = '信用卡';
    $payment_status = '已付款';

    // $order_id = $data['order_id'];
    // $order_date = $data['order_date'];
    // $status = $data['status'];
    // $delivery_status = $data['delivery_status'];
    // $delivery_method = $data['delivery_method'];
    // $payment_method = $data['payment_method'];
    // $payment_status = $data['payment_status'];
    // $subtotal = $data['subtotal'];
    // $shippingFee = $data['shippingFee'];
    // $discount = $data['discount'];
    // $totalAmount = $data['totalAmount'];
    // $receiver = $data['receiver'];
    // $receiverPhone = $data['receiverPhone'];
    // $receiverAddress = $data['receiverAddress'];
    // $receiverEmail = $data['receiverEmail'];

    $order_id = '123475869873648574';
    $order_date = '2048-01-01';
    $status = '未處理';
    $delivery_status = '未出貨';
    $delivery_method = '宅配';
    $payment_method = '信用卡';
    $payment_status = '已付款';
    $subtotal = '5,250';
    $shippingFee = '250';
    $discount = '-250';
    $totalAmount = '5,250';
    $receiver = '吸盤魔偶';
    $receiverPhone = '0948884984';
    $receiverAddress = '真心鎮 小智家';
    $receiverEmail = 'pokemon@gmail.com';
    $member_id = 'M001';

    $stmt = $conn->prepare("INSERT INTO `order` (id, order_date, status, delivery_status, delivery_method, payment_method, payment_status, subtotal, shipping_fee, discount, total_amount, receiver, receiver_phone, receiver_address, receiver_email, note, member_id) 
    VALUES ( $order_id, $order_date, $status, $delivery_status, $delivery_method, $payment_method, $payment_status,$subtotal , $shippingFee, $discount, $totalAmount, $receiver, $receiverPhone, $receiverAddress, $receiverEmail, null, $member_id");
    
  

    $stmt->execute([
        // $order_id, $order_date, $status, $delivery_status, $delivery_method, $payment_method, $payment_status,
        // $data['subtotal'], $data['shippingFee'], $data['discount'], $data['totalAmount'],
        // $data['receiver'], $data['receiverPhone'], $data['receiverAddress'], $data['receiverEmail'], '',
        // 'M001' // 這裡假設member_id已知，實際應用中可能需要動態獲取
    ]);

    // echo json_encode(['success' => true, 'message' => 'Order submitted successfully', 'order_id' => $order_id]);
    } catch (PDOException $e) {
    // echo json_encode(['success' => false, 'message' => 'Failed to submit order: ' . $e->getMessage()]);
    }

?>

