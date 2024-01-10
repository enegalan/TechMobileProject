<?php 
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1){
        function countUsers(){
            include 'php/conn.php';
            $queryUsers = $conn->prepare("SELECT count(id) AS allUsers FROM users");
            $queryUsers->execute();
            $res = $queryUsers->get_result();
            $data = array();
            $count = 0;
            for($i = 0; $i < $res->num_rows;$i++){
                $data[] = $res->fetch_assoc();
                $count += $data[$i]['allUsers'];
            }
            $queryUsers->close();
            return $count;
        }
        function countActiveUsers(){
            include 'php/conn.php';
            $queryActiveUsers = $conn->prepare("SELECT count(id) AS activeUsers FROM users WHERE active = 1");
            $queryActiveUsers->execute();
            $res = $queryActiveUsers->get_result();
            $data = array();
            $count = 0;
            for($i = 0; $i < $res->num_rows;$i++){
                $data[] = $res->fetch_assoc();
                $count += $data[$i]['activeUsers'];
            }
            $queryActiveUsers->close();
            return $count;
        }
        function countInactiveUsers(){
            include 'php/conn.php';
            $queryInactiveUsers = $conn->prepare("SELECT count(id) AS inactiveUsers FROM users WHERE active = 0");
            $queryInactiveUsers->execute();
            $res = $queryInactiveUsers->get_result();
            $data = array();
            $count = 0;
            for($i = 0; $i < $res->num_rows;$i++){
                $data[] = $res->fetch_assoc();
                $count += $data[$i]['inactiveUsers'];
            }
            $queryInactiveUsers->close();
            return $count;
        }
    }
?>