<?php
 include("conn.php");



 header("Access-Control-Allow-Origin: *");

$requestData = json_decode(file_get_contents('php://input'), true);

$reserveBooking_date = $requestData["booking_date"] ?? '';
$reserveBooking_time = $requestData["booking_time"] ?? '';
$reserveGuest_count = $requestData["guest_count"] ?? '';


// $reserveCar = '%'.$tabId.'%' ;
// $tabId =$_REQUEST["account"];

// $accountSearch = $account ;
       //---------------------------------------------------

       try {
              // 建立SQL語法
              $sql = "DELETE FROM reservation WHERE booking_date = ? AND booking_time = ? AND guest_count = ? ";

              // 執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
              $statement = $conn->prepare($sql);
         
              $statement->bindValue(1, $reserveBooking_date);
              $statement->bindValue(2, $reserveBooking_time);
              $statement->bindValue(3, $reserveGuest_count);
        
         
    
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