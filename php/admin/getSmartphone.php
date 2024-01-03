<?php 
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1 && isset($_POST['smartphone_id'])){
        $id = $_POST['smartphone_id'];
        include '../conn.php';
        $query = $conn->prepare("SELECT * FROM smartphones WHERE id = ?");
        $query->bind_param("i",$id);
        $query->execute();
        $res = $query->get_result();
        $smartphone = array();
        for($i = 0; $i < $res->num_rows;$i++){
            $smartphone[] = $res->fetch_assoc();
        }
        $query->close();
        echo json_encode($smartphone);
    }
?>