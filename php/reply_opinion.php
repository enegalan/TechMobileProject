<?php 

if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
    session_start();
}
if ($_SESSION['id'] && isset($_POST['opinion_id']) && isset($_POST['comment'])) {
    $user_id = $_SESSION['id'];
    $opinion_id = $_POST['opinion_id'];
    $comment = $_POST['comment'];

    include 'conn.php';

    $query = $conn->prepare("INSERT INTO opinion_answers (opinion_id, user_id, quote) VALUES (?, ?, ?)");
    $query->bind_param("iis", $opinion_id, $user_id, $comment);
    $query->execute();

    $query->close();
}

?>