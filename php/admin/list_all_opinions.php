<?php 
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1){
        include 'php/conn.php';

        $query = $conn->prepare("SELECT O.id, S.title, U.gravatar, U.username, O.quote, O.date from opinions O INNER JOIN users U on O.user_id = U.id INNER JOIN smartphones S on O.smartphone_id = S.id");
        $query->execute();
        $res = $query->get_result();
        $data = array();
        $out = null;
        for($i = 0; $i < $res->num_rows;$i++){
            $data[] = $res->fetch_assoc();
            $out .= '
                <tr>
                    <td>' . $data[$i]['id'] . '</td>
                    <td>' . $data[$i]['title'] . '</td>
                    <td>
                        <div class="imgBx"><img src="' . $data[$i]['gravatar'] . '" alt=""></div>
                    </td>
                    <td>' . $data[$i]['username'] . '</td>
                    <td>' . $data[$i]['quote'] . '</td>
                    <td>' . $data[$i]['date'] . '</td>
                    <td>
                        <button type="button" class="btn-remove">Remove</button>
                    </td>
                </tr>
            ';
        }
        $query->close();
        echo $out;
    }
?>