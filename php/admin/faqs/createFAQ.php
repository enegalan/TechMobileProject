<?php 

    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1 && isset($_POST['question']) && isset($_POST['answer'])){
        $user_id = $_SESSION['id'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        include '../../conn.php';

        $query = $conn->prepare("INSERT INTO faqs (question, answer, user_id) VALUES (?, ?, ?)");
        $query->bind_param("ssi", $question, $answer, $user_id);
        $query->execute();
        $query->close();
        $conn->close();
    }

?>