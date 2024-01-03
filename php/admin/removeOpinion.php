<?php 

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SESSION['id'] && $_SESSION['is_admin'] && $_POST['opinion_id']) {
    include '../conn.php';
    
    $opinion_id = $_POST['opinion_id'];

    // Delete opinion media
    $query_delete_media = $conn->prepare("DELETE FROM opinion_media WHERE opinion_id = ?");
    $query_delete_media->bind_param("i", $opinion_id);
    $query_delete_media->execute();

    // Delete opinion answers
    $query_delete_answers = $conn->prepare("DELETE FROM opinion_answers WHERE opinion_id = ?");
    $query_delete_answers->bind_param("i", $opinion_id);
    $query_delete_answers->execute();

    // Delete opinion
    $query_delete_opinion = $conn->prepare("DELETE FROM opinions WHERE id = ?");
    $query_delete_opinion->bind_param("i", $opinion_id);
    $query_delete_opinion->execute();


    $query_delete_media->close();
    $query_delete_opinion->close();
}

?>