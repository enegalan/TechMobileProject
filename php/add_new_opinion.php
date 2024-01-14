<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
    session_start();
}

if ($_SESSION['id'] && isset($_POST['ratings'])) {
    $ratings = json_decode($_POST['ratings'], true);

    $user_id = $_SESSION['id'];
    $smartphone_id = $ratings['smartphone_id'];
    $media = $ratings['media'];
    $recommended = $ratings['recommended'];
    $opinion = $ratings['opinion'];
    $advantages = $ratings['advantages'];
    $disadvantages = $ratings['disadvantages'];

    include 'conn.php';
    // Create new opinion
    $query_create_opinion = $conn->prepare("INSERT INTO opinions (user_id, smartphone_id, quote, media, advantages, disadvantages, recommended) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query_create_opinion->bind_param("sssssss", $user_id, $smartphone_id, $opinion, $media, $advantages, $disadvantages, $recommended);
    $query_create_opinion->execute();

    // Get opinion_id
    $opinion_id = $conn->insert_id;

    if (isset($_FILES['files'])) {
        $files = $_FILES['files'];
        // Foreach file create a new opinion_media row
        foreach ($files['name'] as $key => $file_name) {
            $file_tmp = $files['tmp_name'][$key];

            if (!empty($file_name) && !empty($file_tmp)) {
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                $hashed_name = sha1(uniqid()) . '.' . $file_extension;

                $path = 'images/opinions/' . $opinion_id . '/' . $hashed_name;

                $query_create_opinion_media = $conn->prepare("INSERT INTO opinion_media (opinion_id, path) VALUES (?, ?)");
                $query_create_opinion_media->bind_param("ss", $opinion_id, $path);
                $query_create_opinion_media->execute();

                // Upload file to /images/opinions folder
                if (!file_exists('../images/opinions/' . $opinion_id)) {
                    mkdir('../images/opinions/' . $opinion_id, 0777, true);
                }

                move_uploaded_file($file_tmp, '../' . $path);
            }

        }
    }
    $query_create_opinion->close();
    $query_create_opinion_media->close();
}