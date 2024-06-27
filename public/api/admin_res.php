<?php
include 'conn.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    $memberId = isset($_GET['memberId']) ? intval($_GET['memberId']) : null;
    $fullName = isset($_GET['fullName']) ? $_GET['fullName'] : null;
    $phone = isset($_GET['phone']) ? $_GET['phone'] : null;
    $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
    $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;

    try {
        $query = "SELECT reservation.id, reservation.booking_date, reservation.booking_time, reservation.guest_count, reservation.booking_note, reservation.member_id, member.full_name, member.email, member.phone FROM reservation JOIN member ON reservation.member_id = member.id WHERE 1=1";
        $params = [];

        if ($memberId) {
            $query .= " AND reservation.member_id = ?";
            $params[] = $memberId;
        }

        if ($fullName) {
            $query .= " AND member.full_name LIKE ?";
            $params[] = "%$fullName%";
        }

        if ($phone) {
            $query .= " AND member.phone LIKE ?";
            $params[] = "%$phone%";
        }

        if ($startDate && $endDate) {
            $query .= " AND reservation.booking_date BETWEEN ? AND ?";
            $params[] = $startDate;
            $params[] = $endDate;
        }

        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($products) {
            echo json_encode($products);
        } else {
            echo json_encode(["message" => "沒有記錄。"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }

    $conn = null;
}
?>