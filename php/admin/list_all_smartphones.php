<?php 
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1){
        include 'php/conn.php';

        $query = $conn->prepare("SELECT S.id, M.name as manufacturerName, S.title, S.thumbnail_name, S.price, S.rating FROM smartphones S INNER JOIN manufacturers M on S.manufacturer_id = M.id");
        $query->execute();
        $res = $query->get_result();
        $data = array();
        $out = null;
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
                        <button type="button" onclick="editSmartphone(' . $data[$i]['id'] . ')" class="btn-edit">Edit</button>
                        <button type="button" onclick="removeSmartphone(' . $data[$i]['id'] . ')" class="btn-remove">Remove</button>
                    </td>
                </tr>
            ';
        }
        $query->close();
        echo $out;
    }
?>