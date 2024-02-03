<?php
require_once("../../db_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  if(isset($_POST['category']) and $_POST['category'] == "secondary") {
    if(!isset($_POST['s-id']) or !isset($_POST['s-name'])) {
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
    // header('Content-Type: application/json');
    header("location: ../secondary_category.php", true, 302);
    exit(0);

  } else {
    $p_id = $_POST['p-id'];
    if(!isset($_POST['states'])) {
      header("location: ../primary_category.php", true, 302);
      exit(1);
    }
    $s_id = $_POST['states'];
    // $s_id_str = "(";
  
    // for ($i = 0; $i < count($s_id)-1; $i++) { 
    //   $s_id_str .= $s_id[$i] . ", ";
    // }
    // $s_id_str .= $s_id[count($s_id)-1] . ")";

    $in  = str_repeat('?,', count($s_id) - 1) . '?';

    $params = array_merge($s_id, [$p_id]);
    $typeStr = str_repeat('i', count($params));

    $stmtModify = $conn->prepare("UPDATE secondary_category SET primary_id = 0 WHERE id NOT IN ($in) AND primary_id = ?");
    $stmtModify->bind_param($typeStr, ...$params);
    if ($stmtModify->execute()) {
      // 修改成功
      $responseData['modifySuccess'] = true;
    } else {
        // 修改失敗，處理錯誤
        echo "錯誤：".$stmtModify->error;
    }
    $stmtModify->close();

    $params = array_merge([$p_id], $s_id);
    $typeStr = str_repeat('i', count($params));

    $stmtModify = $conn->prepare("UPDATE secondary_category SET primary_id = ? WHERE id IN ($in)");
    $stmtModify->bind_param($typeStr, ...$params);
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
