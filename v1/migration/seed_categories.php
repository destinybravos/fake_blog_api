<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../utils/connect.php';

try {
    // Populate the post_category table with some dummy category
    $dummy_categories = array("Technology", "Food", "Travel", "Stock Market", "Politics", "Automobile", "Entertainment");
    foreach($dummy_categories as $category) {
        if (!categoryExists($category, $conn)) {
            $insert_sql = "INSERT INTO post_category (category_name) VALUES ('$category')";
            $conn->query($insert_sql);
        }
    }
    $conn->close();

    // Return success
    header("HTTP/1 200");
    echo json_encode([
        'success' => true,
        'message' => 'All Categories created successfully'
    ]);
} catch (\Throwable $th) {
    header("HTTP/1 500");
    echo json_encode([
        'success' => false,
        'message' => $th->getMessage()
    ]);
}


function categoryExists($category, $conn){
    // Check if the category already exists
    $check_sql = "SELECT * FROM post_category WHERE category_name = '$category'";
    $result = $conn->query($check_sql);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
