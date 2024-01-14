<?php 
    if(isset($_POST['email']) && isset($_POST['password'])){
        $emailOrName = $_POST['email'];
        $hash = hash('sha512', $_POST['password']);
        include '../conn.php';
        $query = $conn->prepare("SELECT * FROM users where (email = ? OR username = ?) and password = ? AND active = 1");
        $query->bind_param("sss",$emailOrName,$emailOrName,$hash);
        $query->execute();
        $res = $query->get_result();
        $rows = $res->num_rows;
        $user = array();
        if($rows > 0){
            for($i = 0; $i < $rows; $i++){
                $user[] = $res->fetch_assoc();
                session_start();
                $_SESSION['id'] = $user[$i]['id'];
                $_SESSION['is_admin'] = $user[$i]['is_admin'];
                $_SESSION['username'] = $user[$i]['username'];
                $_SESSION['email'] = $user[$i]['email'];
                $_SESSION['name'] = $user[$i]['name'];
                $_SESSION['surname'] = $user[$i]['surname'];
                $_SESSION['birthdate'] = $user[$i]['birthdate'];
                $_SESSION['sex'] = $user[$i]['sex'];
                $_SESSION['about'] = $user[$i]['about'];
                if(trim($user[$i]['gravatar']) == "./images/default.jpg"){
                    $_SESSION['gravatar'] = get_gravatar($_SESSION['email']);
                }else{
                    $_SESSION['gravatar'] = $user[$i]['gravatar'];
                }
                $_SESSION['password'] = $user[$i]['password'];
                $_SESSION['country'] = $user[$i]['country'];
                $_SESSION['city'] = $user[$i]['city'];
                $_SESSION['province'] = $user[$i]['province'];
                $_SESSION['phone'] = $user[$i]['phone'];
                $_SESSION['website'] = $user[$i]['website'];
                $_SESSION['facebook'] = $user[$i]['facebook'];
                $_SESSION['twitter'] = $user[$i]['twitter'];
                $_SESSION['instagram'] = $user[$i]['instagram'];
                $_SESSION['github'] = $user[$i]['github'];
                $_SESSION['address1'] = $user[$i]['address1'];
                $_SESSION['address2'] = $user[$i]['address2'];
                $_SESSION['zip'] = $user[$i]['zip'];
                
            }
            echo json_encode($user);
        } else {
            // TODO: translate the error message
            echo json_encode(array('error' => 'This account does not match our records.'));
        }
        $query->close();
    }
    function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
?>