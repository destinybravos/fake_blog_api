<?php
header("Access-Control-Allow-Origin: *");

// Include Connect.php
include_once '../utils/connect.php';

// Use the MySQLi object $conn to fetch all categories from the post_category table
$sql = "SELECT * FROM post_category";
$result = $conn->query($sql);

$categories = array();

while ($category = $result->fetch_assoc()) {
    // push category into categories array
    array_push($categories, $category);
}

// Set application/json header with status code of 200
header("HTTP/1 200");
header("Content-Type: application/json");

echo json_encode($categories);