<?php
    include('conn.php');

    $query = $conn->prepare("SELECT id, question, answer FROM faqs");
    $query->execute();
    $res = $query->get_result();
    $faqs = array();

    for($i = 0; $i < $res->num_rows; $i++){
        $faqs[] = $res->fetch_assoc();
        echo '
            <div class="accordion-item">
                <button id="accordion-button-' . $faqs[$i]['id'] . '" aria-expanded="false">
                    <span class="accordion-title">' . $faqs[$i]['question'] . '</span>
                    <span class="icon" aria-hidden="true"></span>
                </button>
                <div class="accordion-content">
                    <p>
                    ' . $faqs[$i]['answer'] . '
                    </p>
                </div>
            </div>
        ';
    }

    $query->close();
    $conn->close();
?>