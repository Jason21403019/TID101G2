<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include("conn.php"); 
//---------------------------------------------------

// 建立SQL語法
// $member_id = "M001"; // 假設會員ID從GET參數獲取
$member_id = isset($_GET['id']) ? $_GET['id'] : null;

// 確認會員ID有沒有提供
if (empty($member_id)) {
       echo json_encode(['error' => 'No member ID provided']);
       exit;
   }

   $sql = "SELECT * FROM TID101_G2.member WHERE id = :member_id";

   try {
       $stmt = $conn->prepare($sql);
       $stmt->bindParam(':member_id', $member_id, PDO::PARAM_STR);
       $stmt->execute();
   
       
       $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
       if (empty($data)) {
           echo json_encode(['error' => 'No data found for Member ID: ' . htmlspecialchars($member_id)]);
       } else {
           echo json_encode($data);
       }
   
   } catch (PDOException $e) {
       echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
   } catch (Exception $e) {
       echo json_encode(['error' => $e->getMessage()]);
   }
?>
