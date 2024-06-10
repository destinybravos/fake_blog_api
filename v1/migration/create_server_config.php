<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$data = $_POST;
// DB Type not yet in use
$database_type = $data['db_type']; // MySQL, MongoDB, SQL Server, SQLite etc.

try {
    // Connect to server and create database
    $server_hostname = $data['hostname'];
    $server_username = $data['username'];
    $server_password = $data['password'];
    $db_name = isset($data['db_name']) ? $data['db_name'] : 'fake_blog_api';

    // create the server connection
    $conn = new MySQLi($server_hostname, $server_username, $server_password);

    // Use the $conn mysql object to create a database if not exist
    $sql = "CREATE DATABASE IF NOT EXISTS $db_name";
    $conn->query($sql);

    // Add the database to the $conn object
    // $conn->select_db($db_name);

    
    // Open file system with a new file called connect.php
    if ($connectFile = fopen('../utils/connect.php', "w")) {
        $fileContent = "<?php\n\n";
        $fileContent .= "\$hostname = '$server_hostname';\n";
        $fileContent .= "\$server_username = '$server_username';\n";
        $fileContent .= "\$server_password = '$server_password';\n";
        $fileContent .= "\$database = '$db_name';\n";
        $fileContent .= "\n\n\$conn = new MySQLi(\$hostname, \$server_username, \$server_password, \$database);\n\n?>";
        fwrite($connectFile, $fileContent);
        fclose($connectFile);

        // Return success
        header("HTTP/1 200");
        echo json_encode([
            'success' => true,
            'message' => 'Server Configuration created successfully'
        ]);
    }else{
        header("HTTP/1 500");
        echo json_encode([
            'success' => false,
            'message' => 'Could not create the database configuration files. Try again!'
        ]);
    }
} catch (\Throwable $th) {
    header("HTTP/1 500");
    echo json_encode([
        'success' => false,
        'message' => $th->getMessage()
    ]);
}



?>