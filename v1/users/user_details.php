<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Include Connect.php
include_once '../utils/connect.php';

$data = $_POST;

if (isset($data['user_id']) || $data['email']) {
    // Get data from post request
    $user_id = isset($data['user_id']) ? $data['user_id'] : null;
    $email = isset($data['email']) ? $data['email'] : null;

    if (isset($data['user_id']) && $data['email']) {
        $sql = "SELECT * FROM users WHERE id='$user_id' AND email='$email'";
    }elseif(isset($data['user_id'])){
        $sql = "SELECT * FROM users WHERE id='$user_id'";
    }else{
        $sql = "SELECT * FROM users WHERE email='$email'";
    }
    
    // Run Query
    $result = $conn->query($sql);

    $user = $result->fetch_assoc();

    // Set application/json header with status code of 200
    header("HTTP/1 200");
    echo json_encode([
        'success' => false,
        'user' => $user,
        'message' => 'User details fetched successfully'
    ]);
}else{
    header("HTTP/1 422");
    echo json_encode([
        'success' => false,
        'user' => null,
        'message' => 'Missing or Invalid user id and/or email credentials.'
    ]);
}