<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../utils/connect.php';
include_once './../utils/save_users.php';


try {
    // Populate the users table with some dummy user data
    foreach($users as $user) {
        $username = $user['username'];
        $name = $user['name'];
        $email = $user['email'];
        $phone = $user['phone'];
        $website = $user['website'];
        $avatar = $user['avatar'];
        if (!userEmailExists($email, $conn)) {
            $insert_sql = "INSERT INTO users(username,fullname,email,phone,website,avatar) 
                    VALUES ('$username','$name','$email','$phone','$website','$avatar')";
            $conn->query($insert_sql);
        }
    }
    $conn->close();

    // Return success
    header("HTTP/1 200");
    echo json_encode([
        'success' => true,
        'message' => 'All Users (Authors) created successfully'
    ]);
} catch (\Throwable $th) {
    header("HTTP/1 500");
    echo json_encode([
        'success' => false,
        'message' => $th->getMessage()
    ]);
}


function userExists($username, $conn) {
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

function userEmailExists($email, $conn) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}