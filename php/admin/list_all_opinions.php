<?php 
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if (!file_exists('php/conn.php')) {
        include '../conn.php';
    } else {
        include 'php/conn.php';
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1){
        if (isset($_POST['filters'])) {
            $filters = json_decode($_POST['filters']);
            $search = $filters->search != "" ? "%" . $filters->search . "%" : "%";
            $manufacturer = $filters->manufacturer !== "-1" ? "%" . $filters->manufacturer . "%" : "%";
            $date = $filters->date != "" ? "%" . $filters->date . "%" : "%";
            $query = $conn->prepare("SELECT O.id, S.title, U.gravatar, U.username, O.quote, O.date from opinions O 
                INNER JOIN users U on O.user_id = U.id
                INNER JOIN smartphones S on O.smartphone_id = S.id
                INNER JOIN manufacturers M on S.manufacturer_id = M.id
                WHERE (U.username LIKE ? OR S.title LIKE ?) AND date(O.date) LIKE ? AND M.name LIKE ?");
            $query->bind_param("ssss", $search, $search, $date, $manufacturer);
        } else {
            $query = $conn->prepare("SELECT O.id, S.title, U.gravatar, U.username, O.quote, O.date from opinions O INNER JOIN users U on O.user_id = U.id INNER JOIN smartphones S on O.smartphone_id = S.id");
        }
        $query->execute();
        $res = $query->get_result();
        $data = array();
        $out = null;
        if ($res->num_rows > 0) {
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
        } else {
            $out = '<h2 style="position:absolute;">No results found.</h2>';
        }
        $query->close();
        echo $out;
    }
?>