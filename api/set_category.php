<?php
require_once("../../db_connect.php");
//修改類別
$p = isset($_GET["p"]) ? (int)$_GET["p"] : 1;

$p = 1;
$search = "";
$orderString = "";

if (isset($_GET["p"])) {
    $p = $_GET["p"];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  if(isset($_POST['category']) and $_POST['category'] == "secondary") { //確定操作的是修改次類別
    if(!isset($_POST['s-id']) or !isset($_POST['s-name'])) { //如果缺少次類別的id或name就重新定向
      header("location: ../secondary_category.php", true, 302);
      exit(1);
    }
    $s_id = $_POST['s-id'];
    $s_name = $_POST['s-name'];
    $stmtModify = $conn->prepare("UPDATE secondary_category SET name=? WHERE id = ?");
    $stmtModify->bind_param("si", $s_name, $s_id);
    
    if ($stmtModify->execute()) {
      // 修改成功
      $responseData['modifySuccess'] = true;
    } else {
        // 修改失敗，處理錯誤
        echo "錯誤：".$stmtModify->error;
    }

    $stmtModify->close();
    // Convert the data array to JSON and set the appropriate content type
    $jsonData = json_encode($responseData);
    
    header("location: ../secondary_category.php", true, 302);
    exit(0);

  } else { //修改主類別名稱
    $p_id = $_POST['p-id'];
    $p_name = $_POST['p-name'];
    $stmtModify = $conn->prepare("UPDATE primary_category SET name=? WHERE id = ?");
    $stmtModify->bind_param("si", $p_name, $p_id);

    if ($stmtModify->execute()) {
      // 修改成功
      $responseData['modifySuccess'] = true;
    } else {
        // 修改失敗，處理錯誤
        echo "錯誤：".$stmtModify->error;
    }
    
    if(!isset($_POST['states'])) {
      //將次類別中沒有在s_id中的且主類別id為p-id的設為0 (代表從次類別陣列中刪除)
      $stmtModify = $conn->prepare("UPDATE secondary_category SET primary_id = 0 WHERE primary_id = ?");
      $stmtModify->bind_param('i', ...[$p_id]);
    } else {
      //取消某個次類別
      $s_id = $_POST['states']; //主類別下的次類別id
      $in  = str_repeat('?,', count($s_id) - 1) . '?'; //根據s_id陣列長度 產生相應的佔位符
      $params = array_merge($s_id, [$p_id]); //合併陣列(包含了所有的次類別id，最後一個元素是主類別id)
      $typeStr = str_repeat('i', count($params)); //指定每個參數都是整數類型
      //將次類別中沒有在s_id中的且主類別id為p-id的設為0 (代表從次類別陣列中刪除)
      $stmtModify = $conn->prepare("UPDATE secondary_category SET primary_id = 0 WHERE id NOT IN ($in) AND primary_id = ?");
      $stmtModify->bind_param($typeStr, ...$params);

      $stmtModify->close();
  
      //選取主類別下的次類別
      $params = array_merge([$p_id], $s_id); //合併陣列(包含了第一個是主類別id及所有的次類別id)
      $typeStr = str_repeat('i', count($params));
      //將次類別欄位中在s_id中的項目，把p-id的設為p-id(代表選取新的次類別加入陣列)
      $stmtModify = $conn->prepare("UPDATE secondary_category SET primary_id = ? WHERE id IN ($in)");
      $stmtModify->bind_param($typeStr, ...$params);
    }

    if ($stmtModify->execute()) {
      // 修改成功
      $responseData['modifySuccess'] = true;
    } else {
        // 修改失敗，處理錯誤
        echo "錯誤：".$stmtModify->error;
    }

    $stmtModify->close();

    // UPDATE secondary_category SET primary_id=0 WHERE id NOT IN (1,2,3) AND primary_id = 2;
    // UPDATE secondary_category SET primary_id=2 WHERE id IN (1,2,3);
    // Convert the data array to JSON and set the appropriate content type
    $jsonData = json_encode($responseData);
    
    header("location: ../primary_category.php", true, 302);
    exit(0);
  }
} 
// Close the database connection
$conn->close();
