<?php
require_once("../../db_connect.php");

$priName = $_POST['priName']; // 獲取主類別名稱
$checkedIds = []; // 獲取被選中的 checkbox 的值数组(primary_id)
$secIds = []; // 獲取被選中的 checkbox 的 sec_id 数组

if(isset($_POST['checkedIds']))
    $checkedIds = $_POST['checkedIds'];
if(isset($_POST['secIds']))
    $secIds = $_POST['secIds'];


$stmtPri = $conn->prepare("INSERT INTO primary_category (name, valid) VALUES (?, 1)");
$stmtPri->bind_param("s", $priName);

$responseData = [
    'priInsertSuccess' => false, // 主類別插入成功標誌
    'secUpdateSuccess' => false,  // 次級類別更新成功標誌
    'errors' => []  // 錯誤資訊陣列
];

if ($stmtPri->execute()) {
    $responseData['priInsertSuccess'] = true;
    $last_id = $conn->insert_id; // 新插入的 primary_id

    // 遍歷 secIds 陣列，為每個 secId 更新 primary_id
    foreach ($secIds as $secId) {
        $stmtUpdate = $conn->prepare("UPDATE secondary_category SET primary_id = ? WHERE id = ?");
        $stmtUpdate->bind_param("ii", $last_id, $secId);

        if (!$stmtUpdate->execute()) {
            // 如果更新失敗，記錄錯誤並將 secUpdateSuccess 標誌設置為 false
            $responseData['secUpdateSuccess'] = false;
            $responseData['errors'][] = "更新錯誤: ID $secId - " . $stmtUpdate->error;
        }else {
            $responseData['secUpdateSuccess'] = true;
        }
        $stmtUpdate->close();
    }
} else {
    // 如果插入失敗，記錄錯誤
    $responseData['errors'][] = "插入主類別失敗: " . $stmtPri->error;
}

// Convert the data array to JSON and set the appropriate content type
$jsonData = json_encode($responseData);
echo $jsonData;

// 關閉預處理語句
$stmtPri->close();

?>