<?php

if (!isset($_SERVER['ENV']) || (isset($_SERVER['ENV']) && $_SERVER['ENV'] !== 'dev')) {
    require_once(__DIR__ . '/../current/vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env');
    $dotenv->load();
}

define('DB_NAME', $_SERVER['DB_NAME']);
define('DB_USER', $_SERVER['DB_USER']);
define('DB_PASSWORD', $_SERVER['DB_PASSWORD']);
define('DB_HOST', $_SERVER['DB_HOST']);
