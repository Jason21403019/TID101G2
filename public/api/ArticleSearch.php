<?php

       header('Content-Type: application/json');
       include("conn.php");

       //---------------------------------------------------
       $id = $_GET["id"];

       // //建立SQL語法
       $sql = "SELECT id, name, content, picture, publisher, publish_date, picture FROM article WHERE id = :id";

       // //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
       $statement = $conn->prepare($sql);
       $statement->bindValue(":id", $id, PDO::PARAM_INT);

       $statement->execute();

       // //抓出全部且依照順序封裝成一個二維陣列
       $row = $statement->fetchAll(PDO::FETCH_ASSOC);

       if ($row) {
              // 將數據轉換為JSON格式並返回
              echo json_encode($row);
          } else {
              // 如果沒有找到數據，返回錯誤訊息
              echo json_encode(['error' => 'No article found for the specified ID']);
          }
          
       // echo json_encode($row);

?>