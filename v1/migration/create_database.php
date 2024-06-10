<?php 

include "connect.php";

// Use the $conn mysql object to create a database if not exist
$sql = "CREATE DATABASE IF NOT EXISTS fake_blog_api";
$conn->query($sql);

// Add the database to the $conn object
$conn->select_db("fake_blog_api");