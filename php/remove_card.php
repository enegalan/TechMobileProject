<?php 
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_POST['card_id']) && isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    $card_id = $_POST['card_id'];
    include 'conn.php';
    $query = $conn->prepare("DELETE FROM user_cards WHERE `id` = ? AND `user_id` = ?");
    $query->bind_param("ii",$card_id,$user_id);
    $query->execute();
    $query->close();
}
?>