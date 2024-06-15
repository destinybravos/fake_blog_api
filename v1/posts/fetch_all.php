<?php
header("Access-Control-Allow-Origin: *");

// Include Connect.php
include_once '../utils/connect.php';

// Use the MySQLi object $conn to fetch all posts from the blogposts table
$sql = "SELECT * FROM blogposts ";

if (isset($_GET['category'])) {
    $catId = fetchCategoryIdByName($_GET['category'], $conn);
    if (!is_null($catId)) {
        $sql .= "WHERE category_id='$catId' ";
    }
}

if (isset($_GET['exempt']) && !is_null($_GET['exempt'])) {
    $exempt = $_GET['exempt'];
    if (isset($_GET['category']) && (isset($catId) && !is_null($catId))) {
        $sql .= "AND id!=$exempt ";
    }else{
        $sql .= "WHERE id!=$exempt ";
    }
}

$sql .= "ORDER BY created_at DESC ";

if (isset($_GET['limit']) && !is_null($_GET['limit'])) {
    $limit = $_GET['limit'];
    $sql .= "LIMIT $limit ";
}



$result = $conn->query($sql);

$posts = array();

try {
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
} catch (\Throwable $th) {
    header("HTTP/1 500");
    header("Content-Type: application/json");
    echo json_encode([
        'success' => false,
        'posts' => null,
        'message' => $th->getMessage()
    ]);
}

function fetPostCategory($catId, $conn) {
    // Fetch Category using id
    $sql = "SELECT id, category_name FROM post_category WHERE id = $catId";
    $result = $conn->query($sql);
    $category = $result->fetch_assoc();
    return $category;
}

function fetchCategoryIdByName($category, $conn) {
    // Fetch Category using id
    $sql = "SELECT * FROM post_category WHERE category_name='$category'";
    $result = $conn->query($sql);
    if($result->num_rows == 0){
        return null;
    }
    $category = $result->fetch_assoc();
    return $category['id'];
}

function fetAuthorByID($user_id, $conn) {
    // Fetch User by the user_id
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $author = $result->fetch_assoc();
    return $author;
}