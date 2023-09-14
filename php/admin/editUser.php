<?php 
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1){
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        if (empty($_POST['birthdate'])) {
            $birthdate = null;  // O asigna un valor de fecha por defecto si es apropiado
        } else {
            $birthdate = date('Y-m-d', strtotime($_POST['birthdate'])); // Asegura que la fecha esté en el formato correcto (YYYY-MM-DD)
        }
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
        if(!empty($_POST['password'])){
            $password = hash('sha512',$_POST['password']);
            $query = $conn->prepare("UPDATE users SET username = ?, password = ?, email = ?, name = ?, surname = ?, birthdate = ?, sex = ?, about = ?, country = ?, province = ?, city = ?, zip = ?, address1 = ?, address2 = ?, phone = ?, website = ?, facebook = ?, twitter = ?, instagram = ?, github  = ? WHERE id = ?");
            $query->bind_param("sssssssssssissssssssi",$username,$password,$email,$name,$surname,$birthdate,$sex,$about,$country,$province,$city,$zip,$address1,$address2,$phone,$website,$facebook,$twitter,$instagram,$github,$user_id);
            $query->execute();
            $query->close();
            $conn->close();
        }else{
            $query = $conn->prepare("UPDATE users SET username = ?, email = ?, name = ?, surname = ?, birthdate = ?, sex = ?, about = ?, country = ?, province = ?, city = ?, zip = ?, address1 = ?, address2 = ?, phone = ?, website = ?, facebook = ?, twitter = ?, instagram = ?, github  = ? WHERE id = ?");
            $query->bind_param("ssssdsssssissssssssi",$username,$email,$name,$surname,$birthdate,$sex,$about,$country,$province,$city,$zip,$address1,$address2,$phone,$website,$facebook,$twitter,$instagram,$github,$user_id);
            $query->execute();
            $query->close();
            $conn->close();
        }
        
    }
?>