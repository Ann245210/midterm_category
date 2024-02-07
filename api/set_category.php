<?php
require_once("../../db_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  if (isset($_POST['category']) and $_POST['category'] == "secondary") { //確定操作的是修改次類別
    if (!isset($_POST['s-id']) or !isset($_POST['s-name'])) { //如果缺少次類別的id或name就重新定向
      header("location: ../secondary_category.php", true, 302);
      exit(1);
    }
    //修改次類別名稱
    $s_id = $_POST['s-id'];
    $s_name = $_POST['s-name'];
    $stmtModify = $conn->prepare("UPDATE secondary_category SET name=? WHERE id = ?");
    $stmtModify->bind_param("si", $s_name, $s_id);
    $responseData = array();
    if ($stmtModify->execute()) {
      // 修改成功
      $responseData['modifySuccess'] = true;
      $responseData['message'] = "修改成功";
    } else {
      // 修改失敗，處理錯誤
      $responseData['message'] = "錯誤：" . $stmtModify->error;
    }

    $stmtModify->close();


  } else { //修改主類別名稱
    $p_id = $_POST['p_id'];
    $p_name = $_POST['p_name'];
    $stmtModify = $conn->prepare("UPDATE primary_category SET name=? WHERE id = ?");
    $stmtModify->bind_param("si", $p_name, $p_id);

    if ($stmtModify->execute()) {
      // 修改成功
      $responseData['modifySuccess'] = true;
      $responseData['message'] = "修改成功";
    } else {
      // 修改失敗，處理錯誤
      $responseData['message'] = "錯誤：" . $stmtModify->error;
      
    }
    $stmtModify->close();

    //取消某個次類別--當取消後欄位會變空的情況
    if (!isset($_POST['states'])) { //如果次類別欄位清空，將原本存在次類別的primary_id設為0
      //將次類別中主類別id為p_id的設為0 (代表從次類別陣列中刪除)
      $stmtModify = $conn->prepare("UPDATE secondary_category SET primary_id = 0 WHERE primary_id = ?");
      $stmtModify->bind_param('i', ...[$p_id]);
    } else {
      //取消某個次類別--當取消後欄位還有值的情況
      $s_id = isset($_POST['states']) ? (array)$_POST['states'] : array(); //確保$s_id是一個數組
      $in  = str_repeat('?,', count($s_id) - 1) . '?'; // 根據s_id陣列長度 產生相應的佔位符 (即使是單一值，count($s_id)也會正確返回1，避免PHP可能將其解析為單一值而不是數組)
      $params = array_merge($s_id, [$p_id]); //合併陣列(包含了所有的次類別id，最後一個元素是主類別id)
      $typeStr = str_repeat('i', count($params)); //指定每個參數都是整數類型
      //將次類別中沒有在s_id中的且主類別id為p_id的設為0 (代表從次類別陣列中刪除)
      $stmtModify = $conn->prepare("UPDATE secondary_category SET primary_id = 0 WHERE id NOT IN ($in) AND primary_id = ?");
      $stmtModify->bind_param($typeStr, ...$params);

      if ($stmtModify->execute()) {
        // 修改成功
        $responseData['deleteSuccess'] = true;
        $responseData['message'] = "修改成功";
      } else {
        // 修改失敗，處理錯誤
        $responseData['message'] = "錯誤：" . $stmtModify->error;
      }

      $stmtModify->close();



      //選取主類別下的次類別
      $params = array_merge([$p_id], $s_id); //合併陣列(包含了第一個是主類別id及所有的次類別id)
      $typeStr = str_repeat('i', count($params));
      //將次類別欄位中在s_id中的項目，把primary_id設為p-id(代表選取新的次類別加入陣列)
      $stmtModify = $conn->prepare("UPDATE secondary_category SET primary_id = ? WHERE id IN ($in)");
      $stmtModify->bind_param($typeStr, ...$params);
    }

    if ($stmtModify->execute()) {
      // 修改成功
      $responseData['modifySuccess'] = true;
      $responseData['message'] = "修改成功";
    } else {
      // 修改失敗，處理錯誤
      $responseData['message'] = "錯誤：" . $stmtModify->error;
    }

    $stmtModify->close();

    // UPDATE secondary_category SET primary_id=0 WHERE id NOT IN (1,2,3) AND primary_id = 2;
    // UPDATE secondary_category SET primary_id=2 WHERE id IN (1,2,3);
    // Convert the data array to JSON and set the appropriate content type
    $jsonData = json_encode($responseData);
    header('Content-Type: application/json');
    echo $jsonData;
  }
}
// Close the database connection
$conn->close();
