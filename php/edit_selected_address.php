<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

if(isset($_SESSION['id']) && isset($_POST['selected_address'])){
    include 'conn.php';
    
    $user_id = $_SESSION['id'];
    $selectedAddressJSON = $_POST['selected_address'];
    $selectedAddress = json_decode($selectedAddressJSON, true)[0];
    $address_id = $selectedAddress['id'];
    $defaultVal = $selectedAddress['default'];
    $name = $selectedAddress['name'];
    $surname = $selectedAddress['surname'];
    $address1 = $selectedAddress['address1'];
    $address2 = $selectedAddress['address2'];
    $city = $selectedAddress['city'];
    $country = $selectedAddress['country'];
    $zip = $selectedAddress['zip'];
    $province = $selectedAddress['province'];
    $phone = $selectedAddress['phone'];
    if($selectedAddress['default'] == 1){
        //Remove all the default addresses
        $query1 = $conn->prepare("UPDATE user_addresses SET `default` = 0 WHERE `default` = 1 AND `user_id` = ?");
        $query1->bind_param("i",$user_id);
        $query1->execute();
        $query1->close();
        //Update the default selected address
        $query2 = $conn->prepare("UPDATE user_addresses SET `name` = ?, `surname` = ?, `address1` = ?, `address2` = ?, `city` = ?, `country` = ?, `zip` = ?, `province` = ?, `phone` = ?, `default` = 1 WHERE `id` = ? AND `user_id` = ?");
        $query2->bind_param("ssssssissii",$name,$surname,$address1,$address2,$city,$country,$zip,$province,$phone, $address_id, $user_id);
        $query2->execute();
        $query2->close();
    }else{
        //Update the selected address
        $queryUpdateAddress = $conn->prepare("UPDATE user_addresses SET `name` = ?, `surname` = ?, `address1` = ?, `address2` = ?, `city` = ?, `country` = ?, `zip` = ?, `province` = ?, `phone` = ?, `default` = 0 WHERE `id` = ? AND `user_id` = ?");
        $queryUpdateAddress->bind_param("ssssssissii",$name,$surname,$address1,$address2,$city,$country,$zip,$province,$phone, $address_id, $user_id);
        $queryUpdateAddress->execute();
    }
    $conn->close();
}
?>