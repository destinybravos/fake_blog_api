<?php
header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

// Include Connect.php
include_once '../utils/connect.php';

$post_id = $_POST['post_id'];

if (isset($post_id) && $post_id != null) {
    
    // Use the MySQLi object $conn to fetch all posts from the blogposts table
    $sql = "SELECT * FROM blogposts WHERE id='$post_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        $post['category'] = fetPostCategory($post['category_id'], $conn);
        $post['author'] = fetAuthorByID($post['author_id'], $conn);

        // Set application/json header with status code of 200
        header("HTTP/1 200");
        echo json_encode([
            'success' => true,
            'post' => $post,
            'message' => 'All posts fetched successfully'
        ]);
    } else {
        header("HTTP/1 404");
        echo json_encode([
            'success' => false,
            'post' => null,
            'message' => 'Post/article not found.'
        ]);
    }
} else {
    header("HTTP/1 422");
    echo json_encode([
        'success' => false,
        'post' => null,
        'message' => 'Post ID required but not found.'
    ]);
}

function fetPostCategory($catId, $conn) {
    // Fetch Category using id
    $sql = "SELECT id, category_name FROM post_category WHERE id = $catId";
    $result = $conn->query($sql);
    $category = $result->fetch_assoc();
    return $category;
}

function fetAuthorByID($user_id, $conn) {
    // Fetch User by the user_id
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $author = $result->fetch_assoc();
    return $author;
}