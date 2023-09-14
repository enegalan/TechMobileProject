<?php 
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1){
            include 'php/conn.php';
            $query = $conn->prepare("SELECT * FROM users");
            $query->execute();
            $res = $query->get_result();
            $data = array();
            $out = null;
            for($i = 0; $i < $res->num_rows;$i++){
                $data[] = $res->fetch_assoc();
                $active = "Active";
                if($data[$i]['active'] == 0){
                    $active = "Inactive";
                }
                $out .= '
                        <tr>
                            <td>
                                <div class="imgBx"><img src="' . $data[$i]['gravatar'] . '" alt=""></div>
                            </td>
                            <td>' . $data[$i]['id'] . '</td>
                            <td>' . $data[$i]['username'] . '</td>
                            <td>' . $data[$i]['email'] . '</td>
                            <td>' . $data[$i]['name'] . '</td>
                            <td>' . $data[$i]['surname'] . '</td>
                            <td>' . $data[$i]['phone'] . '</td>
                            <td>' . $data[$i]['birthdate'] . '</td>
                            <td>' . $data[$i]['sex'] . '</td>
                            <td>' . $data[$i]['country'] . '</td>
                            <td>' . $data[$i]['province'] . '</td>
                            <td>' . $data[$i]['city'] . '</td>
                            <td>' . $data[$i]['zip'] . '</td>
                            <td>' . $data[$i]['address1'] . '</td>
                            <td>' . $data[$i]['address2'] . '</td>
                            <td>' . $active . '</td>
                            <td>
                                <button type="button" onclick="editUser(' . $data[$i]['id'] . ')" class="btn-edit">Edit</button>
                                <button type="button" class="btn-remove">Remove</button>
                            </td>
                        </tr>
                ';
            }
            $query->close();
            echo $out;
        }
?>