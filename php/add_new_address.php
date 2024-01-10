<?php 
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['address1']) && isset($_POST['address2']) && isset($_POST['city']) && isset($_POST['country']) && isset($_POST['zip']) && isset($_POST['province']) && isset($_POST['phone'])){
        include 'conn.php';
        $id = $_SESSION['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $zip = $_POST['zip'];
        $province = $_POST['province'];
        $phone = $_POST['phone'];
        
        if(isset($_POST['default'])){
            //Remove all the default addresses
            $query1 = $conn->prepare("UPDATE user_addresses SET `default` = 0 WHERE `default` = 1 AND `user_id` = ?");
            $query1->bind_param("i",$id);
            $query1->execute();
            $query1->close();
            
            //Insert the default address
            $query2 = $conn->prepare("INSERT INTO user_addresses (`user_id`,`name`, `surname`, `address1`, `address2`, `city`, `country`,`zip`,`province`, `phone`, `default`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");
            $query2->bind_param("issssssiss",$id,$name,$surname,$address1,$address2,$city,$country,$zip,$province,$phone);
            $query2->execute();
            $query2->close();
        }else{
            //Insert a new address
            $queryCreateAddress = $conn->prepare("INSERT INTO user_addresses (`user_id`,`name`, `surname`, `address1`, `address2`, `city`, `country`,`zip`,`province`, `phone`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $queryCreateAddress->bind_param("issssssiss",$id,$name,$surname,$address1,$address2,$city,$country,$zip,$province,$phone);
            $queryCreateAddress->execute();
        }
        $conn->close();
    }
    header('location: ../profile.php');
?>