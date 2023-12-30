<?php 

//It would be cool to restringe users to be logged to see opinions (as a boolean option to set true/false)

if($_GET['id']){
    include 'conn.php';
    $smartphone_id = $_GET['id'];
    $opinions_query = $conn->prepare("SELECT O.id, O.user_id, U.username, U.name, U.surname, U.gravatar, O.smartphone_id, O.rating_id, O.quote, O.advantages, O.disadvantages, O.recommended, O.date, O.verified, O.media FROM opinions O INNER JOIN users U on O.user_id = U.id WHERE smartphone_id = ?");
    $opinions_query->bind_param("i", $smartphone_id);
    $opinions_query->execute();
    $opinions_result = $opinions_query->get_result();


    $opinions = array();
    if ($opinions_result->num_rows > 0) {
        for($i = 0; $i < $opinions_result->num_rows; $i++){
            $opinions[] = $opinions_result->fetch_assoc();
            $opinion = $opinions[$i];
            //Get each opinion media
            $media_query = $conn->prepare("SELECT id, path FROM opinion_media WHERE opinion_id = ?");
            $media_query->bind_param("i",$opinion['id']);
            $media_query->execute();
            $media_result = $media_query->get_result();
            $medias = array();
            $id_aux = 0;
            while ($media = $media_result->fetch_assoc()) {
                $medias[] = $media;
                $media_dom[] = '<img aria-selected="" src="' . $media['path'] . '">';
                if ($id_aux === 0) {
                    $opinion_media_slider_dom[0] = '<span value="0" aria-selected="" id="media_slider_first"></span>';
                } else if ($id_aux === count($media)) {
                    $opinion_media_slider_dom[$id_aux] = '<span value="' . (count($media_dom) - 1 ) .'" aria-selected="" id="media_slider_last"></span>';
                } else {
                    $opinion_media_slider_dom[$id_aux] = '<span value="' . $id_aux . '" aria-selected=""></span>';
                }
                $id_aux++;
            }
            
            //Get if it's a verified opinion
            $is_verified_dom = $opinion['verified'] ? '<span class="verified_opinion"><b>Opinión verificada</b></span>' : '';
    
            //Get useful opinions count value
            $useful_opinion_value = 0;        //Get useful opinions count value
            $useful_opinion_query = $conn->prepare("SELECT count(*) as useful_count FROM useful_opinions WHERE opinion_id = ?");
            $useful_opinion_query->bind_param("i", $opinion['id']);
            $useful_opinion_query->execute();
            $useful_opinion_result = $useful_opinion_query->get_result();
            if ($useful_opinion_result->num_rows > 0) {
                // Fetch the result as an associative array
                $useful_opinion_data = $useful_opinion_result->fetch_assoc();
            
                // Get the useful opinions count value
                $useful_opinion_value = $useful_opinion_data['useful_count'];
            }
    
            $useful_opinion_query->close();
    
    
            //Get each opinion answers
            // TODO: When 5 opinions reached, make a button to show all of them
            $opinion_answers_query = $conn->prepare("SELECT OA.id, OA.quote, OA.date, U.username FROM opinion_answers OA INNER JOIN users U on OA.user_id = U.id WHERE OA.opinion_id = ?");
            $opinion_answers_query->bind_param("i", $opinion['id']);
            $opinion_answers_query->execute();
            $opinion_answers_result = $opinion_answers_query->get_result();
            $opinions_answers_dom = '';
            while ($opinion_answer = $opinion_answers_result->fetch_assoc()) {
                // Concatenate the HTML for each opinion answer
                $opinions_answers_dom .= '
                    <div class="opinion_answer" id="' . $opinion_answer['id'] . '">
                        <div class="opinion_answer_reply_section">
                            <span class="opinion_answer_reply">
                                <i class="fa-solid fa-reply"></i>
                            </span>
                        </div>
                        <div class="opinion_answer_header">
                            <div class="opinion_answer_user">
                                <img class="opinion_answer_user_gravatar" src="images/users/default.jpg">
                                <span class="opinion_answer_user_username"><b>' . $opinion_answer['username'] . '</b></span>
                            </div>
                            <div class="opinion_answer_date">' . date('d/m/Y', strtotime($opinion_answer['date'])) . '</div>
                        </div>
                        <br>
                        <q>' . nl2br($opinion_answer['quote']) . '</q>
                        <br>
                    </div>';
            }
            $opinion_answers_query->close();
    
    
            echo '
                <div id="op-' . $opinion['id'] . '" class="opinion_contenedor" data-id="' . $opinion['id'] . '">
                    <div class="datos_user">
                        <div class="opinion_user">
                            <img src="' . $opinion['gravatar'] . '" alt="user-gravatar">
                            <p><b>' . $opinion['username'] . '</b></p>
                        </div>
                        <div class="opinion_media">
                            <div class="media_container">
                            ' . implode('', $media_dom) . '
                            </div>
                            <div class="media_slider_controller">
                                <span id="media_slider_controller_previous">
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                                <span id="media_slider_controller_next">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                        <div class="opinion_media_slider">
                            ' . implode('', $opinion_media_slider_dom) . '
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
                            <q>' . nl2br($opinion['quote']) .'</q>
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
                        <div class="opinion_buttons">
                            <span class="useful_opinion">
                                <a class="useful_opinion_a" href="#">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.75026 0C6.33127 0 5.9567 0.261199 5.81189 0.654363L3.47455 7H1C0.447715 7 0 7.44772 0 8V15C0 15.5523 0.447715 16 1 16H4H11.8932H11.8933C12.5172 16 13.1219 15.7917 13.6149 15.4101C14.1075 15.0288 14.4608 14.4963 14.6245 13.8959L14.6246 13.8957L15.8979 9.22924L15.898 9.22908C16.0134 8.80559 16.0311 8.36101 15.9498 7.92967C15.8685 7.4983 15.6902 7.09063 15.4274 6.73875C15.1647 6.38679 14.8243 6.09988 14.432 5.90176C14.0395 5.7036 13.6064 5.60003 13.1667 5.6H13.1666H9.58376V1.93333C9.58376 1.42631 9.38609 0.936517 9.02866 0.572626C8.67064 0.208127 8.18121 0 7.66701 0H6.75026ZM3 14V9H2V14H3ZM5 8.64498L7.4476 2H7.58376V6.6C7.58376 7.15228 8.03148 7.6 8.58376 7.6H13.1665H13.1666C13.2921 7.60002 13.4165 7.62951 13.5304 7.68705C13.6445 7.74463 13.7456 7.82913 13.8249 7.93531C13.9042 8.04156 13.9592 8.16633 13.9845 8.30011C14.0097 8.43387 14.0041 8.5718 13.9685 8.70276L13.9684 8.70292L12.6951 13.3694L12.695 13.3696C12.6443 13.5555 12.5361 13.716 12.3907 13.8285C12.2456 13.9408 12.0708 14 11.8932 14H11.8932H5V8.64498Z"
                                            fill="#333333">
                                        </path>
                                    </svg>
                                    Opinión útil (<span id="useful_ipinion_value">' . $useful_opinion_value . '</span>)
                                </a>
                            </span>
                            <span class="answer_opinion_span">
                                <div class="answer_opinion" onclick="">Responder</div>
                            </span>
                        </div>
                        <div class="row">
                            <div class="opinion_answers">
                                ' . $opinions_answers_dom . '
                            </div>
                        </div>
                    </div>
                </div>
                ';
        }
    } else {
        echo 'No hay opiniones de usuario.';
    }
    if ($opinions_result->num_rows > 0) $media_query->close();
    if ($opinions_result->num_rows > 0) $opinions_query->close();
}

?>