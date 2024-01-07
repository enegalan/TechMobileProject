<?php 

    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1 && isset($_POST['id'])){
        $id = $_POST['id'];

        include '../../conn.php';

        $query = $conn->prepare("SELECT * FROM faqs WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $res = $query->get_result();
        $faq = array();

        for($i = 0; $i < $res->num_rows; $i++){
            $faq[] = $res->fetch_assoc();
        }

        $query->close();
        $conn->close();

        echo json_encode($faq);
    }

?>