<?php 
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1 && isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    include '../conn.php';
    $query = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $query->bind_param("i",$user_id);
    $query->execute();
    $res = $query->get_result();
    $data = array();
    for($i = 0; $i < $res->num_rows; $i++){
        $data[] = $res->fetch_assoc();
    }
    $query->close();
    $conn->close();
    echo json_encode($data);
}
?>