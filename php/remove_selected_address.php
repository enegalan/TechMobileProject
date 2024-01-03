<?php 
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_POST['address_id']) && isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    $address_id = $_POST['address_id'];
    include 'conn.php';
    $query = $conn->prepare("DELETE FROM user_addresses WHERE `id` = ? AND `user_id` = ?");
    $query->bind_param("ii",$address_id,$user_id);
    $query->execute();
    $query->close();
}
?>