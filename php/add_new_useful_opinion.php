<?php 

if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
    session_start();
}

if ($_SESSION['id'] && isset($_POST['id'])) {
    include 'conn.php';

    $opinion_id = $_POST['id'];
    $user_id = $_SESSION['id'];

    // Check if the user has already voted for this opinion
    $check_query = $conn->prepare("SELECT * FROM useful_opinions WHERE opinion_id = ? AND user_id = ?");
    $check_query->bind_param("ss", $opinion_id, $user_id);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        // User has already voted, delete the previous vote
        $delete_query = $conn->prepare("DELETE FROM useful_opinions WHERE opinion_id = ? AND user_id = ?");
        $delete_query->bind_param("ss", $opinion_id, $user_id);
        $delete_query->execute();
        $delete_query->close();
    } else {
        // User has not voted, insert the vote
        $insert_query = $conn->prepare("INSERT INTO useful_opinions (opinion_id, user_id) VALUES (?, ?)");
        $insert_query->bind_param("ss", $opinion_id, $user_id);
        $insert_query->execute();
        $insert_query->close();
    }

    $check_query->close();
}
?>