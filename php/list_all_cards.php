<?php 
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $query = $conn->prepare("SELECT * FROM user_cards WHERE `user_id` = ?");
        $query->bind_param("i",$id);
        $query->execute();
        $res = $query->get_result();
        $cards = array();
        $out = "";
        if($res->num_rows > 0){
            for($i = 0; $i < $res->num_rows;$i++){
                $cards[] = $res->fetch_assoc();
                $cardNumber = getCardCodeWithAsteriscsAndSpaces($cards[$i]['number']);
                if($cards[$i]['type'] == "visa"){
                    $out .= '
                        <div class="account" id="card-' . $cards[$i]['id'] . '" onclick="selectCard(' . $cards[$i]['id'] . ')">
                            <div class="account-card-type is-visa"></div>
                            <div class="account-number">' . $cardNumber . '</div>
                            <div class="account-expiration">Valid: ' . $cards[$i]['due_month'] . '/'. $cards[$i]['due_year'] . '</div>
                        </div>
                        ';
                }
                if($cards[$i]['type'] == "mastercard"){
                    $out .= '
                        <div class="account" id="card-' . $cards[$i]['id'] . '" onclick="selectCard(' . $cards[$i]['id'] . ')">
                            <div class="account-card-type is-mastercard"></div>
                            <div class="account-number">' . $cardNumber . '</div>
                            <div class="account-expiration">Valid: ' . $cards[$i]['due_month'] . '/'. $cards[$i]['due_year'] . '</div>
                        </div>
                        ';
                }
                if($cards[$i]['type'] == "paypal"){
                    $out .= '
                        <div class="account" id="card-' . $cards[$i]['id'] . '" onclick="selectCard(' . $cards[$i]['id'] . ')">
                            <div class="account-card-type is-paypal"></div>
                            <div class="account-number">' . $cardNumber . '</div>
                            <div class="account-expiration">Valid: ' . $cards[$i]['due_month'] . '/'. $cards[$i]['due_year'] . '</div>
                        </div>
                        ';
                }
                
            }
        }
        $query->close();
        echo $out;
    }
    function getCardCodeWithAsteriscsAndSpaces($card_number){
        $card_number = str_replace(' ', '', $card_number); // Eliminar espacios en blanco existentes
        $cardArray = str_split($card_number);
        $formattedCard = "";
    
        $numAsterisks = count($cardArray) - 4;
        for ($i = 0; $i < count($cardArray); $i++) {
            if ($i < $numAsterisks) {
                $formattedCard .= "*";
            } else {
                $formattedCard .= $cardArray[$i];
            }
    
            if (($i + 1) % 4 == 0 && $i + 1 < count($cardArray)) {
                $formattedCard .= " ";
            }
        }
    
        return $formattedCard;
    }
    
?>