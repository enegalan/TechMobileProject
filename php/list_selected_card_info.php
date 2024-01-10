<?php 
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id']) && $_POST['card_id']){
        $user_id = $_SESSION['id'];
        $card_id = $_POST['card_id'];
        include 'conn.php';
        $query = $conn->prepare("SELECT * FROM user_cards WHERE `id` = ? AND `user_id` = ?");
        $query->bind_param("ii",$card_id, $user_id);
        $query->execute();
        $res = $query->get_result();
        $card = array();
        $out = "";
        for($i = 0; $i < $res->num_rows;$i++){
            $card[] = $res->fetch_assoc();
        }
        $query->close();
        echo json_encode($card);
        
    }
?>