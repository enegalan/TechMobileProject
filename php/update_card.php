<?php 
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_POST['card_id']) && isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    $card_id = $_POST['card_id'];
    $card_name = $_POST['card_name'];
    $card_number = $_POST['card_number'];
    $card_cvv = $_POST['card_cvv'];
    $card_due_year = $_POST['card_due_year'];
    $card_due_month = $_POST['card_due_month'];
    $type = getCardType($card_number);

    include 'conn.php';
    $query = $conn->prepare("UPDATE user_cards SET `name` = ?, `number` = ?, `cvv` = ?, `due_year` = ?, `due_month` = ?, `type` = ? WHERE `id` = ? AND `user_id` = ?");
    $query->bind_param("ssisssii",$card_name, $card_number, $card_cvv, $card_due_year, $card_due_month, $type, $card_id, $user_id);
    $query->execute();
    $query->close();
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