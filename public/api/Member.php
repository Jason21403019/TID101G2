<?php
include("conn.php"); 
//---------------------------------------------------

// 建立SQL語法
$sql = "SELECT * FROM TID101_G2.member WHERE id = 'M001'";

try {
    // 執行查詢
    $statement = $conn->query($sql);

    // 檢查查詢是否成功
    if ($statement === false) {
        throw new Exception("Query failed");
    }

    // 抓出全部數據並封裝成一個二維陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    // 將數據轉換成 JSON 格式並輸出
    echo json_encode($data);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
