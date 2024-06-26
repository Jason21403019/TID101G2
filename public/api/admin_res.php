<?php
include 'conn.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    try {
        if ($id) {
            $stmt = $conn->prepare("SELECT reservation.id, reservation.booking_date, reservation.booking_time, reservation.guest_count, reservation.booking_note, reservation.member_id, member.full_name, member.email, member.phone FROM reservation JOIN member ON reservation.member_id = member.id WHERE reservation.id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($product) {
                echo json_encode($product);
            } else {
                echo json_encode(["message" => "記錄未找到。"]);
            }
        } else {
            $stmt = $conn->prepare("SELECT reservation.id, reservation.booking_date, reservation.booking_time, reservation.guest_count, reservation.booking_note, reservation.member_id, member.full_name, member.email, member.phone FROM reservation JOIN member ON reservation.member_id = member.id");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($products) {
                echo json_encode($products);
            } else {
                echo json_encode(["message" => "沒有記錄。"]);
            }
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }

    $conn = null;
}
?>