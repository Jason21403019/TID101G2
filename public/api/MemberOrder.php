<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    //引入資料庫
       include("conn.php");

       //---------------------------------------------------


    //    $keyword = $_POST["keyword"];

       //建立SQL語法
       $sql = "SELECT * FROM TID101_G2.order;";

       try {
       //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
        $statement = $conn->query($sql);
        $statement->execute();


       //抓出全部且依照順序封裝成一個二維陣列
       $data = $statement->fetchAll();

       //將二維陣列取出顯示其值
    //    foreach($data as $index => $row){
    //           echo $row["id"];   //訂單編號
    //           echo " / ";
    //           echo $row["order_date"];    //成立時間
    //           echo " / ";
    //           echo $row["status"];    //訂單狀態
    //           echo " / ";
    //           echo $row["product_details"];    //購買產品
    //           echo " / ";
    //           echo $row["total_amount"];    //總價
    //           echo " / ";
    //           echo $row["payment_status"];    //付款狀態
    //           echo " / ";
    //           echo $row["delivery_status"];    //出貨狀態
    //           echo " / ";
    //           echo "<br>";
    //    }
        echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>