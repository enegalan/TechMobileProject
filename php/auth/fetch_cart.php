<?php
include '../conn.php';

$user_id = $_GET['user_id'];

$sql = "SELECT cart FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cart = $row['cart'];
    echo $cart;
} else {
    echo "[]";
}

$conn->close();
?>