<?php 

if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
    session_start();
}

$allowedLanguages = ['es', 'en', 'fr'];

if (isset($_GET['lang'])) {
    $selectedLang = $_GET['lang'];
    if (in_array($selectedLang, $allowedLanguages)) {
        $_SESSION['lang'] = $selectedLang;
    }
}

$selectedLang = isset($_SESSION['lang']) ? $_SESSION['lang'] : $allowedLanguages[0];

include_once "lang/{$selectedLang}.php";

?>