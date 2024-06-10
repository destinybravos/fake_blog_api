<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Include Connect.php
include_once '../utils/connect.php';

// Use the MySQLi object $conn to fetch all categories from the post_category table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$users = array();

while ($user = $result->fetch_assoc()) {
    // push category into categories array
    array_push($users, $user);
}

// Set application/json header with status code of 200
header("HTTP/1 200");
echo json_encode([
    'success' => true,
    'users' => $users,
    'message' => 'All users fetched successfully'
]);