<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');

try {
    $dotenv->load();
} catch (\Throwable $e) {
    echo "Error loading environment variables: " . $e->getMessage();
}

$conn = mysqli_connect(getenv('DB_HOST'),getenv('DB_USER'),getenv('DB_PASSWORD'),getenv('DB_SCHEMA'));
if(!$conn){
    echo "Error database connection";
    die;
}
?>