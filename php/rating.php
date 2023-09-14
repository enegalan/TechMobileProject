<?php 
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if(isset($_SESSION['id']) && isset($_POST['rating']) && isset($_POST['smartphone_id'])){
        $id = $_SESSION['id'];
        $smartphone_id = $_POST['smartphone_id'];
        $rating = $_POST['rating'];

        include 'conn.php';
        $query = $conn->prepare("INSERT INTO ratings (user_id, smartphone_id, rating) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE rating = ?");
        $query->bind_param("iidd", $id, $smartphone_id, $rating, $rating);
        $query->execute();
        $query->close();
        echo "Query done";

        //Update Rating on Smartphones table
        $query2 = $conn->prepare("SELECT avg(rating) as ratingAvg FROM ratings WHERE smartphone_id = ?");
        $query2->bind_param("i", $smartphone_id);
        $query2->execute();
        $res2 = $query2->get_result();
        $data2 = array();
        $ratingAvg = 0.0;
        for($i = 0; $i < $res2->num_rows;$i++){
            $data2[] = $res2->fetch_assoc();
            $ratingAvg = $data2[$i]['ratingAvg'];
        }
        $query2->close();

        $query3 = $conn->prepare("UPDATE smartphones SET rating = ? WHERE id = ?");
        $query3->bind_param("di", $ratingAvg, $smartphone_id);
        $query3->execute();
        $query3->close();
    }else echo "Session ID and Rating does not exist";
?>