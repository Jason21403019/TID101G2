<?php
 include("conn.php");

 header("Access-Control-Allow-Origin: *");

$requestData = json_decode(file_get_contents('php://input'), true);
$tabId = $requestData["account"] ?? '';
$accountSearch = '%'.$tabId.'%' ;
// $tabId =$_REQUEST["account"];

// $accountSearch = $account ;
       //---------------------------------------------------

       try {
              // 建立SQL語法
              $sql = "SELECT * FROM product WHERE product_class_id like ?";
          
              // 執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
              $statement = $conn->prepare($sql);
              $statement->bindValue(1,$accountSearch);

              // 执行查询
             $statement->execute();

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
          ?>