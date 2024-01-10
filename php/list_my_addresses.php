<?php 
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        include 'conn.php';

        $query = $conn->prepare("SELECT * FROM user_addresses WHERE user_id = ?");
        $query->bind_param("i",$id);
        $query->execute();
        $res = $query->get_result();
        $myAddresses = array();

        for($i = 0; $i < $res->num_rows;$i++){
            $myAddresses[] = $res->fetch_assoc();
            echo '
            <div class="address" address-id="' . $myAddresses[$i]['id'] . '">
                <h3>Address ' . $i + 1 . '</h3>
                <p>' . $myAddresses[$i]['name'] . ' ' . $myAddresses[$i]['surname'] . '</p>
                <p>' . $myAddresses[$i]['address1'] . ' ' . $myAddresses[$i]['address2'] . '</p>
                <p>' . $myAddresses[$i]['city'] . ', ' . $myAddresses[$i]['province'] . ', ' . $myAddresses[$i]['zip'] . '</p>
                <p>' . $myAddresses[$i]['country'] . '</p>
                <p>' . $myAddresses[$i]['phone'] . '</p>
            </div>
            ';
        }

        $query->close();
    }
?>