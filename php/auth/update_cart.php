<?php
include '../conn.php';
include '../../lang/detect_lang.php';

$user_id = $_POST['user_id'];
$cart = $_POST['cart'];

$sql = "UPDATE users SET cart = '$cart' WHERE id = $user_id";

if ($conn->query($sql) === TRUE) {
    echo $lang['cart_update'];
} else {
    echo $lang['error_cart_update'];
}

$conn->close();
?>