<?php 

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SESSION['id'] && $_SESSION['is_admin'] && isset($_POST['id'])) {
    $user_id = $_POST['id'];
    include '../conn.php';

    // Get actual user status
    $current_status_query = $conn->prepare("SELECT active FROM users WHERE id = ?");
    $current_status_query->bind_param("i", $user_id);
    $current_status_query->execute();
    $current_status_result = $current_status_query->get_result();

    if ($current_status_result->num_rows > 0) {
        $row = $current_status_result->fetch_assoc();
        $current_status = $row['active'];

        if ($current_status == 0) {
            $update_query = $conn->prepare("UPDATE users SET active = 1 WHERE id = ?");
        } elseif ($current_status == 1) {
            $update_query = $conn->prepare("UPDATE users SET active = 0 WHERE id = ?");
        }

        $update_query->bind_param("i", $user_id);
        $update_query->execute();
    }

    $update_query->close();
    $current_status_query->close();
}

?>