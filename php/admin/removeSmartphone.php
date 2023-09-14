<?php
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1 && isset($_POST['smartphone_id'])){
            $id = $_POST['smartphone_id'];
            include '../conn.php';
            $query = $conn->prepare("DELETE FROM smartphones WHERE id = ?");
            $query->bind_param("i",$id);
            $query->execute();
            $query->close();
        }
?>