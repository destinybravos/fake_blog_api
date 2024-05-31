<?php

use Dotenv\Dotenv;


require_once realpath(__DIR__ . '/vendor/autoload.php');

// Looing for .env at the root directory
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrive env variable
$userName = $_ENV['USER_NAME'];

echo $userName;
