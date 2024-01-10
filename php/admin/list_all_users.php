<?php
include 'lang/detect_lang.php';
if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
    session_start();
}
if (!file_exists('php/conn.php')) {
    include '../conn.php';
} else {
    include 'php/conn.php';
}
if (isset($_SESSION['id']) && $_SESSION['is_admin'] === 1) {

    if (isset($_POST['filters'])) {
        $filters = json_decode($_POST['filters']);
        $search = $filters->search != "" ? "%" . $filters->search . "%" : "%";
        $birthdate = $filters->birthdate !== "" ? "%" . $filters->birthdate . "%" : "%";
        $joining_date = $filters->joining_date != "" ? "%" . $filters->joining_date . "%" : "%";
        $status = $filters->status != -1 ? $filters->status : "%";
        $query = $conn->prepare("SELECT * FROM users WHERE
                    (username LIKE ? OR
                    email LIKE ? OR
                    name LIKE ? OR
                    surname LIKE ? OR
                    phone LIKE ? OR
                    country LIKE ? OR
                    province LIKE ? OR
                    city LIKE ? OR
                    zip LIKE ? OR
                    address1 LIKE ? OR
                    address2 LIKE ?) AND
                    birthdate LIKE ? AND
                    joining_date LIKE ? AND
                    active LIKE ?");
        $query->bind_param("ssssssssssssss",
            $search, $search, $search, $search, $search,
            $search, $search, $search, $search, $search,
            $search, $birthdate, $joining_date, $status);

    } else {
        $query = $conn->prepare("SELECT * FROM users");
    }
    $query->execute();
    $res = $query->get_result();
    $data = array();
    $out = null;
    if ($res->num_rows > 0) {
        for ($i = 0; $i < $res->num_rows; $i++) {
            $data[] = $res->fetch_assoc();
            $active = $lang['active'];
            if ($data[$i]['active'] == 0) {
                $active = $lang['inactive'];
            }
            $out .= '
                            <tr>
                                <td>
                                    <div class="imgBx"><img src="' . $data[$i]['gravatar'] . '"></div>
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
                                    <button type="button" onclick="editUser(' . $data[$i]['id'] . ')" class="btn-edit">' . $lang['edit'] . '</button>
                                    <button data-id="' . $data[$i]['id'] . '" type="button" class="btnUserStatus btn-remove">' . ($data[$i]['active'] == 1 ? $lang['inactive'] : $lang['active']) . '</button>
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
