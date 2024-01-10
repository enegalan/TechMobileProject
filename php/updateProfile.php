<?php
    include 'lang/detect_lang.php';
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['username']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['birthdate']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['about'])){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $birthdate = $_POST['birthdate'];
        $about = $_POST['about'];

        $id = $_SESSION['id'];
        $current_name = $_SESSION['name'];
        $current_surname = $_SESSION['surname'];
        $current_username = $_SESSION['username'];
        $current_phone = $_SESSION['phone'];
        $current_email = $_SESSION['email'];
        $current_birthdate = $_SESSION['birthdate'];
        $current_password = $_SESSION['password'];
        $current_about = $_SESSION['about'];
        
        if($_POST['password'] != "" && $_POST['password'] != " "){
            $password = hash('sha512',$_POST['password']);
            $confirm_password = hash('sha512',$_POST['confirm_password']);
            if ($password !== $confirm_password) {
                // Las contraseñas no coinciden, muestra un mensaje de error
                echo $lang['error_passwords_not_validated']  . "<br><br>";
                header('Location: ../profile.php');
                exit; // Detener el procesamiento del formulario
            }
        }else{
            $password = $current_password;
        }

        if ($name === $current_name || $name === "") {
            $name = $current_name;
        }
        
        if ($surname === $current_surname || $surname === "") {
            $surname = $current_surname;
        }
        
        if ($username === $current_username || $username === "") {
            $username = $current_username;
        }
        
        if ($phone === $current_phone || $phone === "") {
            $phone = $current_phone;
        }
        
        if ($email === $current_email || $email === "") {
            $email = $current_email;
        }
        
        if ($birthdate === $current_birthdate || $birthdate === "") {
            $birthdate = $current_birthdate;
        }
        if ($password === $current_password || $password === "") {
            $password = $current_password;
        }
        if($about === $current_about || $about === ""){
            $about = $current_about;
        }
        
        include 'conn.php';
        $query = $conn->prepare("UPDATE users SET `name` = ?, `surname` = ?, `username` = ?, `phone` = ?, `email` = ?, `birthdate` = ?, `password` = ?, `about` = ? WHERE id = ?");
        $query->bind_param("ssssssssi", $name, $surname, $username, $phone, $email, $birthdate, $password, $about, $id);
        $query->execute();

        $query->close();
        $conn->close();
        header('location: ../profile.php');
    }
?>