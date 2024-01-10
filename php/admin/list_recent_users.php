<?php 
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1){
        include 'php/conn.php';
        $queryRecentUsers = $conn->prepare("SELECT * FROM users 
        WHERE EXTRACT(YEAR FROM joining_date) = EXTRACT(YEAR FROM CURRENT_DATE) 
        AND EXTRACT(MONTH FROM joining_date) IN 
        (EXTRACT(MONTH FROM CURRENT_DATE), EXTRACT(MONTH FROM CURRENT_DATE) - 1)");
        $queryRecentUsers->execute();
        $res = $queryRecentUsers->get_result();
        $data = array();
        $out = null;
        for($i = 0; $i < $res->num_rows;$i++){
            $data[] = $res->fetch_assoc();
            
            $out .= '
                <table>
                    <tr>
                        <td>
                            <div class="imgBx"><img src="' . $data[$i]['gravatar'] . '"></div>
                        </td>
                        <td>
                            <h4>' . $data[$i]['name'] . '<br> <span>' . $data[$i]['country'] . '</span></h4>
                        </td>
                    </tr>
                </table>
            ';
        }

        echo $out;
    }
?>