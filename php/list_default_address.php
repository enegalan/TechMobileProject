<?php
include 'lang/detect_lang.php';
if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
    session_start();
}
if(isset($_SESSION['id'])){
    include 'conn.php';
    $id = $_SESSION['id'];
    $query = $conn->prepare("SELECT * FROM user_addresses where user_id = ? and `default` = 1 LIMIT 1");
    $query->bind_param("i",$id);
    $query->execute();
    $res = $query->get_result();
    $defaultAddress = array();
    $html = "";
    if($res->num_rows > 0){
        for($i = 0; $i < $res->num_rows; $i++){
            $defaultAddress[] = $res->fetch_assoc();
            $html = '
            <div class="default_address">
                <h3>' . $lang['saved_address'] . '</h3>
                <p>' . $defaultAddress[$i]['name'] . ' ' . $defaultAddress[$i]['surname'] . '</p>
                <p>' . $defaultAddress[$i]['address1'] . ' ' . $defaultAddress[$i]['address2'] . '</p>
                <p>' . $defaultAddress[$i]['city'] . ', ' . $defaultAddress[$i]['province'] . ', ' . $defaultAddress[$i]['zip'] . '</p>
                <p>' . $defaultAddress[$i]['country'] . '</p>
                <p>' . $defaultAddress[$i]['phone'] . '</p>
            </div>
            ';
        }
        echo $html;
    }
    
    $query->close();
}
?>