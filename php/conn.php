<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');

try {
    $dotenv->load();
} catch (\Throwable $e) {
    echo "Error loading environment variables: " . $e->getMessage();
}

$conn = mysqli_connect($_ENV['DB_HOST'],$_ENV['DB_USER'],$_ENV['DB_PASSWORD'],$_ENV['DB_SCHEMA']);
if(!$conn){
    echo "Error database connection";
    die;
}
?>