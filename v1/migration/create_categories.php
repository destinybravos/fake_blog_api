<?php

// Use the mysqli connection object $conn to create post_category table if not exist
$sql = "CREATE TABLE IF NOT EXISTS post_category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
    )";
$conn->query($sql);

// Populate the post_category table with some dummy category
$dummy_categories = array("Technology", "Food", "Travel", "Stock Market", "Politics", "Automobile");
foreach($dummy_categories as $category) {
    $insert_sql = "INSERT INTO post_category (category_name) VALUES ('$category')";
    $conn->query($insert_sql);
}