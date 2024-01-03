<?php
    function searchSmartphones($search) {
        include "conn.php";
        $query = $conn->prepare("SELECT S.id, S.title, S.subtitle1, S.subtitle2, M.name AS manufacturer_name, S.price, S.description, S.rating, S.width, S.height, S.thick, S.weight, S.display, S.chip, S.camera, S.os, S.storage, S.colors, S.thumbnail_name, S.model, S.image_count, S.stock FROM smartphones S
            INNER JOIN manufacturers M on S.manufacturer_id = M.id 
            WHERE S.title LIKE ?");
        $query->bind_param("s", $search);
        $query->execute();
        $res = $query->get_result();
        $rows = $res->num_rows;
        $smartphones = array();
        for($i = 0; $i < $rows; $i++){
            $smartphones[] = $res->fetch_assoc();
        }
        $query->close();
        return $smartphones;
    }

    function getAllSmartphones() {
        include "conn.php";
        var_dump('getting all smartphones');
        $query = $conn->prepare("SELECT S.id, S.title, S.subtitle1, S.subtitle2, M.name AS manufacturer_name, S.price, S.description, S.rating, S.width, S.height, S.thick, S.weight, S.display, S.chip, S.camera, S.os, S.storage, S.colors, S.thumbnail_name, S.model, S.image_count, S.stock FROM smartphones S INNER JOIN manufacturers M on S.manufacturer_id = M.id");
        $query->execute();
        $res = $query->get_result();
        $rows = $res->num_rows;
        $smartphones = array();
        for($i = 0; $i < $rows; $i++){
            $smartphones[] = $res->fetch_assoc();
        }
        $query->close();
        return $smartphones;
    }

    function listAllSmartphones() {
        $smartphones = getAllSmartphones();
        for($i = 0; $i < count($smartphones); $i++) {
            $defaultColor = explode(",", $smartphones[$i]['colors'])[0];
            $url = "smartphone.php?id=" . $smartphones[$i]["id"] . "&color=" . $defaultColor;
            echo '<li><a href="' . $url . '"><i class="fas fa-search"></i>' . $smartphones[$i]["title"] . '</a></li>';
        }
    }
?>