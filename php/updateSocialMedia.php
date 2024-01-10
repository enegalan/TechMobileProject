<?php 
if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
    session_start();
}
if(isset($_POST['website']) && isset($_POST['facebook']) && isset($_POST['twitter']) && isset($_POST['instagram']) && isset($_POST['github']) ){
    $website = $_POST['website'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $github = $_POST['github'];
    
    $id = $_SESSION['id'];
    $current_website = $_SESSION['website'];
    $current_facebook = $_SESSION['facebook'];
    $current_twitter = $_SESSION['twitter'];
    $current_instagram = $_SESSION['instagram'];
    $current_github = $_SESSION['github'];
    if($website === $current_website || $website === ""){
        $website = $current_website;
    }
    if($facebook === $current_facebook || $facebook === ""){
        $facebook = $current_facebook;
    }
    if($twitter === $current_twitter || $twitter === ""){
        $twitter = $current_twitter;
    }
    if($instagram === $current_instagram || $instagram === ""){
        $instagram = $current_instagram;
    }
    if($github === $current_github || $github === ""){
        $github = $current_github;
    }
    include 'conn.php';
    $query = $conn->prepare("UPDATE users SET `website` = ?, `facebook` = ?, `twitter` = ?, `instagram` = ?, `github` = ? WHERE id = ?");
    $query->bind_param("sssssi", $website, $facebook, $twitter, $instagram, $github, $id);
    $query->execute();

    $query->close();
    $conn->close();
    header('location: ../profile.php');
}
?>