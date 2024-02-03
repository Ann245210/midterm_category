<?php
require_once("../../db_connect.php");

// Assume default page 1, and 6 items per page
$p = isset($_GET["p"]) ? (int)$_GET["p"] : 1;
$perpage = 6;
$startIndex = ($p - 1) * $perpage;

$p = 1;
$search = "";
$orderString = "";

if (isset($_GET["p"])) {
    $p = $_GET["p"];
}

$startIndex = ($p - 1) * $perpage;

if (isset($_GET["search"])) {
    // Escape the input to prevent SQL Injection
    $search = "AND name LIKE '%" . $conn->real_escape_string($_GET["search"]) . "%'"; //建立模糊字串，並對字符串進行轉義，避免 SQL 注入
}

if (isset($_GET["order"])) {
    $order = $_GET["order"];
    if ($order == 1) {
      $orderString = "ORDER BY id ASC";
    }
    if ($order == 2) {
      $orderString = "ORDER BY id DESC";
    }
    if ($order == 3) {
      $orderString = "ORDER BY name ASC";
    }
    if ($order == 4) {
      $orderString = "ORDER BY name DESC";
    }
  }


$sql = "SELECT * FROM primary_category WHERE valid = 1 $search $orderString LIMIT $startIndex , $perpage";
$result = $conn->query($sql);
$sqlAll = "SELECT * FROM primary_category WHERE valid = 1 $search $orderString";
$resultAll = $conn->query($sqlAll);
$categoryTotalCount = $resultAll->num_rows; //類別總數量

$pageCount = ceil($categoryTotalCount / $perpage); //有幾頁

// Check if the query was successful
if (!$result) {
    // Set the HTTP response code to 500 (Internal Server Error) and output an error message
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']); // More detailed error information should be logged
    exit;
}

$data = [];
while($row = $result->fetch_assoc()) {
    $p_id = $row['id'];
    $sqlId = "SELECT * FROM secondary_category WHERE valid = 1 AND primary_id = ?";
    $stmtId = $conn->prepare($sqlId);
    $stmtId->bind_param("i", $p_id);
    $stmtId->execute();
    $resultId = $stmtId->get_result();
    $secCategories = [];
    while($secRow = $resultId->fetch_assoc()) {
        $secCategories[] = $secRow; // 將次類別的每一行加入數組
    }
    $row['sec_id'] = $secCategories; // 將次類別數組賦值給對應的鍵
    $data[] = $row;
}

$sql = "SELECT * FROM secondary_category WHERE valid = 1";
$result = $conn->query($sql);
$sec_data = [];

while($row = $result->fetch_assoc()) {
    $sec_data[] = $row;
}

$myArray = array(
    "data" => $data,
    "pageCount" => $pageCount,
    "totalCount" => $categoryTotalCount,
    "sec_data" => $sec_data,
);


// Convert the data array to JSON and set the appropriate content type
$jsonData = json_encode($myArray);
header('Content-Type: application/json');
echo $jsonData;


// Close the database connection
$conn->close();
