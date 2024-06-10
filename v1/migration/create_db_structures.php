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

    // create post_category table structure if not exist
    $sqlUsers = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        fullname VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(255),
        website VARCHAR(255),
        avatar VARCHAR(255),
        created_at DATETIME DEFAULT(CURRENT_TIMESTAMP),
        updated_at DATETIME DEFAULT(CURRENT_TIMESTAMP)
        )";
    $conn->query($sqlUsers);

    // Create table for blogposts
    // create blogposts table structure if not exist
    $sqlBlogposts = "CREATE TABLE IF NOT EXISTS blogposts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        author_id INT,
        category_id INT,
        poster_image VARCHAR(1000),
        created_at DATETIME DEFAULT(CURRENT_TIMESTAMP),
        updated_at DATETIME DEFAULT(CURRENT_TIMESTAMP),
        FOREIGN KEY (author_id) REFERENCES users(id),
        FOREIGN KEY (category_id) REFERENCES post_category(id)
        )";
        $conn->query($sqlBlogposts);

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
