<?php

       include("conn.php");

       //---------------------------------------------------


       // $keyword = $_POST["keyword"];

       //建立SQL語法
       $sql = "SELECT * FROM TID101_G2.article";

       //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
       $statement = $pdo->query($sql);

       $statement->execute();


       //抓出全部且依照順序封裝成一個二維陣列
       $data = $statement->fetchAll();

       //將二維陣列取出顯示其值
       foreach($data as $index => $row){
              echo $row["id"];   //欄位名稱
              echo " / ";
              echo $row["name"];    //欄位名稱
              echo " / ";
              echo $row["content"];    //欄位名稱
              echo "<br>";
       }
       // echo json_encode($data );
?>