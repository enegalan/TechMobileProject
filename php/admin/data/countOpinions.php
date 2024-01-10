<?php 
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    
    if (isset($_SESSION['id']) && $_SESSION['is_admin'] === 1) {
        

        // Don't know why doesn't includes the connection in previous line
        // So this can be a temporal patch at the moment
        if ($conn === null) {
            include_once './../../conn.php';
        }
        
        function getCountOpinions() {
            include 'php/conn.php';
            $queryOpinions = $conn->prepare("SELECT count(id) AS allOpinions FROM opinions");
            $queryOpinions->execute();
            $res = $queryOpinions->get_result();
            $data = $res->fetch_assoc();
            $count = $data['allOpinions'];
        
            $queryOpinions->close();
            
            echo $count;
        }

        function getCountOpinionsMonth() {
            include 'php/conn.php';
            $currentMonth = date('n');  // Obtener el número del mes actual

            $queryOpinions = $conn->prepare("SELECT count(id) AS allOpinions FROM opinions WHERE MONTH(date) = ?");
            $queryOpinions->bind_param("i", $currentMonth);
            $queryOpinions->execute();
            $res = $queryOpinions->get_result();
            $data = $res->fetch_assoc();
            $count = $data['allOpinions'];
            
            $queryOpinions->close();
            
            echo $count;
        }

        
    }

?>