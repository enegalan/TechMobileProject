<?php
include '../conn.php';

$user_id = $_POST['user_id'];
$cart = $_POST['cart'];

$sql = "UPDATE users SET cart = '$cart' WHERE id = $user_id";

if ($conn->query($sql) === TRUE) {
    echo "Cart updated successfully";
} else {
    echo "Error updating cart";
}

$conn->close();
?>