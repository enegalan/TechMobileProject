<?php 
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_POST['address_id']) && isset($_SESSION['id'])){
        $address_id = $_POST['address_id'];
        $user_id = $_SESSION['id'];
        include 'conn.php';
        $query = $conn->prepare("SELECT * FROM user_addresses WHERE id = ? AND user_id = ?");
        $query->bind_param("ii",$address_id,$user_id);
        $query->execute();
        $res = $query->get_result();
        $selectedAddress = array();
        for($i = 0; $i < $res->num_rows;$i++){
            $selectedAddress[] = $res->fetch_assoc();
        }
        $query->close();
        echo json_encode($selectedAddress);
    }
?>