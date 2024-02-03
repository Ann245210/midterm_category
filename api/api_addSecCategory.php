<?php
require_once("../../db_connect.php");

$secName = $_POST['secName']; // 獲取次類別名稱

$stmtSec = $conn->prepare("INSERT INTO secondary_category (name, valid) VALUES (?, 1)");
$stmtSec->bind_param("s", $secName);

$responseData = [
    'secUpdateSuccess' => false,  // 次類別更新成功標誌
    'errors' => []  // 錯誤資訊陣列
];

if ($stmtSec->execute()) {
    $responseData['secUpdateSuccess'] = true;

} else {
    // 如果插入失敗，記錄錯誤
    $responseData['errors'][] = "新增次類別失敗: " . $stmtSec->error;
}


// Convert the data array to JSON and set the appropriate content type
$jsonData = json_encode($responseData);
// header('Content-Type: application/json');
echo $jsonData;


// 關閉預處理語句
$stmtSec->close();
?>