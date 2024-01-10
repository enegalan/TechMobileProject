<?php 

    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1 && isset($_POST['id']) ){
        $id = $_POST['id'];

        include '../../conn.php';

        $query = $conn->prepare("DELETE FROM faqs WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $query->close();
        $conn->close();
    }

?>