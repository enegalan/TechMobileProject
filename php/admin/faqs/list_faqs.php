<?php 
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    if(isset($_SESSION['id']) && $_SESSION['is_admin'] === 1){

        include(__DIR__ . '/../../conn.php');
        if (isset($_POST['filters'])) {
            $filters = json_decode($_POST['filters']);
            $search = $filters->search != "" ? "%" . $filters->search . "%" : "%";
            $date = $filters->date != "" ? "%" . $filters->date . "%" : "%";
            $query = $conn->prepare("SELECT F.id, F.question, F.answer, F.date, U.username as username FROM faqs F 
                INNER JOIN users U on F.user_id = U.id
                WHERE (F.question LIKE ? OR F.answer LIKE ? OR U.username LIKE ?) 
                AND date(F.date) LIKE ?
            ");
            $query->bind_param("ssss", $search, $search, $search, $date);
        } else {
            $query = $conn->prepare("SELECT F.id, F.question, F.answer, F.date, U.username as username FROM faqs F INNER JOIN users U on F.user_id = U.id");
        }
        $query->execute();
        $res = $query->get_result();
        $faqs = array();

        for($i = 0; $i < $res->num_rows; $i++){
            $faqs[] = $res->fetch_assoc();
            echo '
                <tr>
                    <td>' . $faqs[$i]['id'] . '</td>
                    <td>' . $faqs[$i]['question'] . '</td>
                    <td>' . $faqs[$i]['answer'] . '</td>
                    <td>' . $faqs[$i]['username'] . '</td>
                    <td>' . $faqs[$i]['date'] . '</td>
                    <td>
                        <button onclick="editFAQ(' . $faqs[$i]['id'] . ')" type="button" class="btn-edit">Edit</button>
                        <button onclick="deleteFAQ(' . $faqs[$i]['id'] . ')" type="button" class="btn-remove">Remove</button>
                    </td>
                </tr>
            ';
        }

        $query->close();
        $conn->close();
    }
?>