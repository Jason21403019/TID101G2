<?php
 include("conn.php");

 header("Access-Control-Allow-Origin: *");
//  header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//  header('Content-Type: application/json; charset=UTF-8');
       //---------------------------------------------------

       try {
              // 建立SQL語法
              $sql = "SELECT r.id ,r.booking_date,r.booking_time,r.guest_count,r.booking_note,m.full_name 
FROM TID101_G2.reservation as r join TID101_G2.member as m on r.member_id = m.id;";
          
              // 執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
              $statement = $conn->query($sql);
          
              // 抓出全部資料並封裝成一個二維陣列
              $data = $statement->fetchAll(PDO::FETCH_ASSOC);
          
              // 轉換成 JSON 格式
              $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
          
              // 輸出 JSON
              echo $jsonData;
          } catch (PDOException $e) {
              // 處理 PDO 例外錯誤
              echo json_encode(array('error' => 'PDO Error: ' . $e->getMessage()));
          } catch (Exception $e) {
              // 處理其他類型的錯誤
              echo json_encode(array('error' => 'Error: ' . $e->getMessage()));
          }
       //將二維陣列取出顯示其值
       // foreach($data as $index => $row){
	//        echo $row["id"];   //欄位名稱
	//        echo " / ";
	//        echo $row["brand"];    //欄位名稱
	//        echo " / ";
	//        echo $row["name"];    //欄位名稱
       //     echo " / ";
	//        echo $row["details"];    //欄位名稱
       //     echo " / ";
	//        echo $row["price"];    //欄位名稱
       //     echo " / ";
	//        echo $row["name"];    //欄位名稱
       //     echo " / ";
	//        echo $row["stock"];    //欄位名稱
       //     echo " / ";
	//        echo $row["subpage_photo"];    //欄位名稱
       //     echo " / ";
	//        echo $row["picture"];    //欄位名稱
       //     echo " / ";
	//        echo $row["content"];    //欄位名稱
       //     echo " / ";
	//        echo $row["product_class_id"];    //欄位名稱
       //        echo "<br>";
       // }

?>