<?php
    include 'lang/detect_lang.php';
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1){
        if (!file_exists('php/conn.php')) {
            include '../conn.php';
        } else {
            include 'php/conn.php';
        }
        if (isset($_POST['filters'])) {
            $filters = json_decode($_POST['filters']);
            $search = $filters->search != "" ? "%" . $filters->search . "%" : "%";
            $manufacturer = $filters->manufacturer !== "-1" && $filters->manufacturer != "" ? "%" . $filters->manufacturer . "%" : "%";
            $min_price = $filters->min_price != "" ? $filters->min_price : "0";
            $max_price = $filters->max_price != "" ? $filters->max_price : "99999999";
            $rating_low = $filters->rating != "-1" ? ($filters->rating - 1) : "0";
            $rating_great = $filters->rating != "-1" ? ($filters->rating + 1) : "5";
            $query = $conn->prepare("SELECT S.id, M.name as manufacturerName, S.title, S.thumbnail_name, S.price, S.rating FROM smartphones S 
                INNER JOIN manufacturers M on S.manufacturer_id = M.id
                WHERE S.title LIKE ? AND M.name LIKE ? AND S.price BETWEEN ? AND ? AND S.rating BETWEEN ? AND ?
            ");
            $query->bind_param("ssssss", $search, $manufacturer, $min_price, $max_price, $rating_low, $rating_great);
        } else {
            $query = $conn->prepare("SELECT S.id, M.name as manufacturerName, S.title, S.thumbnail_name, S.price, S.rating FROM smartphones S INNER JOIN manufacturers M on S.manufacturer_id = M.id");
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
                        <td>
                            <div class="imgBx"><img src="productos/' . $data[$i]['manufacturerName'] . '/img/catalogo/' . $data[$i]['thumbnail_name'] . '.png"></div>
                        </td>
                        <td>' . $data[$i]['title'] . '</td>
                        <td>' . ucfirst($data[$i]['manufacturerName']) . '</td>
                        <td>' . $data[$i]['price'] . '€</td>
                        <td>' . $data[$i]['rating'] . '</td>
                        <td>
                            <button type="button" onclick="editSmartphone(' . $data[$i]['id'] . ')" class="btn-edit">' . $lang['edit'] . '</button>
                            <button type="button" onclick="removeSmartphone(' . $data[$i]['id'] . ')" class="btn-remove">' . $lang['remove'] . '</button>
                        </td>
                    </tr>
                ';
            }
        } else {
            $out = '<h2 style="position:absolute;">' . $lang['no_results'] . '.</h2>';
        }
        $query->close();
        echo $out;
    }
?>