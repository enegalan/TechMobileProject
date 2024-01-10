<?php
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id']) && isset($_POST['card_name']) && isset($_POST['card_number']) && isset($_POST['card_cvv']) && isset($_POST['card_due_month']) && isset($_POST['card_due_year'])){
        $user_id = $_SESSION['id'];
        $card_name = $_POST['card_name'];
        $card_number = $_POST['card_number'];
        $card_cvv = $_POST['card_cvv'];
        $card_due_month = $_POST['card_due_month'];
        $card_due_year = $_POST['card_due_year'];
        $type = getCardType($card_number);

        include 'conn.php';
        $query = $conn->prepare("INSERT INTO user_cards (`user_id`,`name`,`number`,`cvv`,`due_month`,`due_year`,`type`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("ississs",$user_id, $card_name, $card_number, $card_cvv, $card_due_month, $card_due_year, $type);
        $query->execute();
        $query->close();
        header('location: ../profile.php');
    }
    function getCardType($cardNumber) {
        // Eliminar espacios y guiones del número de tarjeta
        $cardNumber = preg_replace('/\D/', '', $cardNumber);
    
        // Verificar si el número es de Visa
        if (preg_match('/^4\d{12}(?:\d{3})?$/', $cardNumber)) {
            return 'visa';
        }
    
        // Verificar si el número es de Mastercard
        if (preg_match('/^5[1-5]\d{14}$/', $cardNumber)) {
            return 'mastercard';
        }
    
        // Si no es Visa ni Mastercard, devolver 'paypal'
        return 'paypal';
    }
?>