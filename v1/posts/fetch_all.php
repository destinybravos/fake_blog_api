<?php
header("Access-Control-Allow-Origin: *");

// Include Connect.php
include_once '../utils/connect.php';

// Use the MySQLi object $conn to fetch all posts from the blogposts table
$sql = "SELECT * FROM blogposts";
$result = $conn->query($sql);

$posts = array();

while ($post = $result->fetch_assoc()) {
    // push category into categories array
    $post['category'] = fetPostCategory($post['category_id'], $conn);
    $post['author'] = fetAuthorByID($post['author_id'], $conn);
    array_push($posts, $post);
}

// Set application/json header with status code of 200
header("HTTP/1 200");
header("Content-Type: application/json");
echo json_encode([
    'success' => true,
    'posts' => $posts,
    'message' => 'All posts fetched successfully'
]);

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