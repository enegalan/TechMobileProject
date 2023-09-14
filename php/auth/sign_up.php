<?php 
    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['birthdate']) && isset($_POST['password'])){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $birthdate = $_POST['birthdate'];
        $password = hash('sha512', $_POST['password']);

        include '../conn.php';
        $query = $conn->prepare("INSERT INTO users (name, surname, username, email, birthdate, password) VALUES (?,?,?,?,?,?)");
        $query->bind_param("ssssss",$name, $surname, $username, $email, $birthdate, $password);
        $query->execute();

        $query->close();
        echo "INSERT INTO succesfull";
    }
?>