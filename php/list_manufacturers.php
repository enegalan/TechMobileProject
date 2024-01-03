<?php 
    include 'conn.php';
    $query = $conn->prepare("SELECT id, name FROM manufacturers");
    $query->execute();
    $res = $query->get_result();
    $manufacturers = array();
    $rows = $res->num_rows;
    for($i = 0; $i < $rows; $i++){
        $manufacturers[] = $res->fetch_assoc();
    }
?>