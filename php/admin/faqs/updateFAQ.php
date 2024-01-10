<?php 

    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1 && isset($_POST['id']) && isset($_POST['question']) && isset($_POST['answer'])){
        $user_id = $_SESSION['id'];
        $id = $_POST['id'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        include '../../conn.php';

        $query = $conn->prepare("UPDATE faqs SET question = ?, answer = ?, user_id = ? WHERE id = ?");
        $query->bind_param("ssii", $question, $answer, $user_id, $id);
        $query->execute();
        $query->close();
        $conn->close();
    }

?>