<?php
include 'lang/detect_lang.php';

if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
    session_start();
}

if ($_SESSION['id'] && isset($_POST['id'])) {
    include 'conn.php';
    $data = array();
    //Get user opinion
    $user_opinions_query = $conn->prepare("SELECT O.id, O.user_id, U.username, U.name, U.surname, U.gravatar, O.smartphone_id, O.quote, O.advantages, O.disadvantages, O.recommended, O.date, O.verified, O.media as opinion_quote, O.media, O.recommended, O.verified, S.title, U.username FROM opinions O
                                        INNER JOIN smartphones S on O.smartphone_id = S.id
                                        INNER JOIN users U on O.user_id = U.id WHERE O.user_id = ?");
    $user_opinions_query->bind_param("i", $_SESSION['id']);
    $user_opinions_query->execute();
    $user_opinions_res = $user_opinions_query->get_result();

    while ($row = $user_opinions_res->fetch_assoc()) {
        $data['opinion'][] = $row;
    }

    $opinion = $data['opinion'][0];

    //Get if it's a verified opinion
    $is_verified_dom = $opinion['verified'] ? '<span class="verified_opinion"><b>Opinión verificada</b></span>' : '';

    //Get opinion answers
    $query_opinion_answers = $conn->prepare("SELECT OA.id, OA.quote, OA.date, U.username, U.gravatar FROM opinion_answers OA INNER JOIN users U on OA.user_id = U.id WHERE OA.opinion_id = ?");
    $query_opinion_answers->bind_param("i", $_POST['id']);
    $query_opinion_answers->execute();
    $opinion_answers_res = $query_opinion_answers->get_result();

    $opinions_answers_dom = '';
    if ($opinion_answers_res->num_rows > 0) {
        while ($opinion_answer = $opinion_answers_res->fetch_assoc()) {
            $data['opinion_answers'][] = $opinion_answer;
    
            $opinions_answers_dom .= '
                <div class="opinion_answer" id="' . $opinion_answer['id'] . '">
                    <div class="opinion_answer_reply_section">
                        <span class="opinion_answer_reply" data-id="' . $opinion_answer['id'] . '">
                            <i data-id="' . $opinion_answer['id'] . '" class="fa-solid fa-reply"></i>
                        </span>
                    </div>
                    <div class="opinion_answer_header">
                        <div class="opinion_answer_user">
                            <img class="opinion_answer_user_gravatar" src="' . $opinion_answer['gravatar'] . '">
                            <span class="opinion_answer_user_username"><b>' . $opinion_answer['username'] . '</b></span>
                        </div>
                        <div class="opinion_answer_date">' . date('d/m/Y', strtotime($opinion_answer['date'])) . '</div>
                    </div>
                    <br>
                    <q>' . nl2br($opinion_answer['quote']) . '</q>
                    <br>
                    <div data-id="' . $opinion_answer['id'] . '" class="reply_answer_opinion">
                            <div class="reply_textarea_container">
                                <label for="comment" class="reply_label">' . $lang['comment'] . '</label>
                                <textarea id="comment" minlength="15" placeholder="@' . $opinion_answer['username'] . '" class="reply_textarea">@' . $opinion['username'] . '</textarea>
                                <div class="reply_min_label">* ' . $lang['min'] . ' 15 ' . $lang['chars'] . '</div>
                            </div>
                            <div class="reply_controls">
                                <div>
                                    <button answer-id="' . $opinion_answer['id'] . '" data-id="' . $opinion['id'] . '" class="reply_answer_button">
                                        ' . $lang['comment'] . '
                                    </button>
                                    <button class="reply_cancel_button">
                                        ' . $lang['cancel'] . '
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>';
        }
    }

    echo '
        <div id="op-' . $opinion['id'] . '" class="opinion_contenedor" data-id="' . $opinion['id'] . '">
            <div class="datos_user">
                <div class="opinion_user">
                    <img src="' . $opinion['gravatar'] . '" alt="user-gravatar">
                    <p><b>' . $opinion['username'] . '</b></p>
                </div>
                <div>
                </div>
            </div>
            <div class="contenido">
                <div class="rating_stars_section">
                    <div fill="#FFA90D" class="opinion_stars_background">
                        <div fill="#FFA90D" data-testid="percent-bar" value="' . $opinion['media'] . '" class="opinion_stars"></div>
                    </div>
                </div>
                ' . $is_verified_dom . '
                <p class="opinion_date">' . date('Y/m/d', strtotime($opinion['date'])) . '</p>
                <div class="opinion" data-id="' . $opinion['id'] . '">
                    <q>' . nl2br($opinion['quote']) . '</q>
                    <b>Ventajas:</b>&nbsp;
                    ' . $opinion['advantages'] . '
                    <br>
                    <b>Desventajas:</b>&nbsp;
                    ' . $opinion['disadvantages'] . '
                    <br>
                    <b>¿Recomendaría su compra?</b>&nbsp;
                    ' . ($opinion['recommended'] ? 'Sí' : 'No') . '
                    <br>
                </div>
                
                </div>
                <div class="row">
                    <div class="opinion_answers">
                        ' . $opinions_answers_dom . '
                    </div>
                </div>
            </div>
        </div>
    ';

    $user_opinions_query->close();
    $query_opinion_answers->close();
}
