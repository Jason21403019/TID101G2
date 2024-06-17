<?php
header('Content-Type: application/json');

include 'conn.php';
try {
    // 撈取資料
    $stmt = $conn->prepare("SELECT id, note FROM product_class");
    $stmt->execute();

    // 設定 fetch 模式
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $users = $stmt->fetchAll();

    // 檢查資料是否存在
    if (empty($users)) {
        echo json_encode(["message" => "No records found."]);
    } else {
        echo json_encode($users);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

// 關閉連線
$conn = null;
?>