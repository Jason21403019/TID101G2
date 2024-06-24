<?php
 include("conn.php");



 header("Access-Control-Allow-Origin: *");

$requestData = json_decode(file_get_contents('php://input'), true);
$reserveId = $requestData["id"] ?? '';
$reserveBooking_date = $requestData["booking_date"] ?? '';
$reserveBooking_time = $requestData["booking_time"] ?? '';
$reserveGuest_count = $requestData["guest_count"] ?? '';
$reserveBooking_note = $requestData["booking_note"] ?? '';
$reservemember_id = $requestData["member_id"] ?? '';

// $reserveCar = '%'.$tabId.'%' ;
// $tabId =$_REQUEST["account"];

// $accountSearch = $account ;
       //---------------------------------------------------

       try {
              // 建立SQL語法
              $sql = "INSERT INTO reservation(id, booking_date,booking_time, guest_count,booking_note,member_id) VALUES (?,?,?,?,?,?)";
          
              // 執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
              $statement = $conn->prepare($sql);
              $statement->bindValue(1, $reserveId);
              $statement->bindValue(2, $reserveBooking_date);
              $statement->bindValue(3, $reserveBooking_time);
              $statement->bindValue(4, $reserveGuest_count);
              $statement->bindValue(5, $reserveBooking_note);
              $statement->bindValue(6, $reservemember_id);
         
    
              // 执行查询
             $statement->execute();

              // 抓出全部資料並封裝成一個二維陣列
            //   $data = $statement->fetchAll(PDO::FETCH_ASSOC);
          
            //   // 轉換成 JSON 格式
            //   $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
          
            //   // 輸出 JSON
            //   echo $jsonData;


echo "Insertion successful."; // 或者其他成功訊息
} catch (PDOException $e) {
    // 處理 PDO 例外錯誤
    echo json_encode(array('error' => 'PDO Error: ' . $e->getMessage()));
} catch (Exception $e) {
    // 處理其他類型的錯誤
    echo json_encode(array('error' => 'Error: ' . $e->getMessage()));
}



          ?>