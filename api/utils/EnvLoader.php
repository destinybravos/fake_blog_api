<?php

namespace Api\utils;

use Dotenv\Dotenv;

require_once realpath(__DIR__ . './../../vendor/autoload.php');

class EnvLoader
{
    public function env(string $variable, string $alt = null)
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        // Retrive env variable
        $value = $_ENV['USER_NAME'];

        return  $value;
    }
}
