<?php 
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1){
        $username = $_POST['username'];
        $password = hash('sha512',$_POST['password']);
        $email = $_POST['email'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $birthdate = $_POST['birthdate'];
        $sex = $_POST['sex'];
        $about = $_POST['about'];
        $country = $_POST['country'];
        $province = $_POST['province'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $phone = $_POST['phone'];
        $website = $_POST['website'];
        $facebook = $_POST['facebook'];
        $twitter = $_POST['twitter'];
        $instagram = $_POST['instagram'];
        $github = $_POST['github'];
        

        include '../conn.php';

        $query = $conn->prepare("INSERT INTO users (username, password, email, name, surname, birthdate, sex, about, country, province, city, zip, address1, address2, phone, website, facebook, twitter, instagram, github) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $query->bind_param("sssssssssssissssssss",$username,$password,$email,$name,$surname,$birthdate,$sex,$about,$country,$province,$city,$zip,$address1,$address2,$phone,$website,$facebook,$twitter,$instagram,$github);
        $query->execute();
        $query->close();
        $conn->close();
    }
?>