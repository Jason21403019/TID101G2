<?php
       include("conn.php");
       //---------------------------------------------------

       //建立SQL語法
       $sql = "SELECT * FROM TID101_G2.member;";

       //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
       $statement = $conn->query($sql);
       $statement->execute();

       //抓出全部且依照順序封裝成一個二維陣列
       $data = $statement->fetchAll();

       //將二維陣列取出顯示其值
       foreach($data as $index => $row){
	       echo $row["id"];   //會員編號
	       echo " / ";
	       echo $row["full_name"];    //會員名稱
	       echo " / ";
	       echo $row["birth"];    //會員生日
           echo " / ";
	       echo $row["email"];   //會員信箱
           echo " / ";
	       echo $row["phone"];    //會員電話
           echo " / ";
	       echo $row["address"];   //會員地址
              echo "<br>";
       }

?>