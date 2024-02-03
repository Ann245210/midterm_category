<?php
require_once("../../db_connect.php");

$priId = $_GET['id']; // 獲取主類別id
$category = "primary_category";
if(isset($_GET['category'])){
    if($_GET['category']=="secondary_category")
        $category = "secondary_category";
}
$stmtDelete = $conn->prepare("UPDATE " . $category . " SET valid = 0 WHERE id = ?");
$stmtDelete->bind_param("i", $priId);
$responseData = [
    'deleteSuccess' => false, // 主類別插入成功標誌
];
if ($stmtDelete->execute()) {
    // 刪除成功
    $responseData['deleteSuccess'] = true;
} else {
    // 刪除失敗，處理錯誤
    echo "錯誤：".$stmtDelete->error;
}

// Convert the data array to JSON and set the appropriate content type
$jsonData = json_encode($responseData);
// header('Content-Type: application/json');
echo $jsonData;


// 關閉預處理語句
// $stmtPri->close();
// $stmtUpdate->close();


?>