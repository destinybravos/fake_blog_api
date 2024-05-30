<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../utils/connect.php';

try {
    // create post_category table structure if not exist
    $sqlCategories = "CREATE TABLE IF NOT EXISTS post_category (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category_name VARCHAR(255) NOT NULL
        )";
    $conn->query($sqlCategories);

    // Other Table Structures will come next






    // Return success
    header("HTTP/1 200");
    echo json_encode([
        'success' => true,
        'message' => 'All database table structure created successfuly'
    ]);
} catch (\Throwable $th) {
    header("HTTP/1 500");
    echo json_encode([
        'success' => false,
        'message' => $th->getMessage()
    ]);
}
