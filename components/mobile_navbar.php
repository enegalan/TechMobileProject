<?php

include 'lang/detect_lang.php';

include 'php/conn.php';

if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
    session_start();
}

$authenticated = false;

if (isset($_SESSION['id'])) {
    $authenticated = true;
    $user_id = $_SESSION['id'];
    $is_admin = $_SESSION['is_admin'] ?? false;
}
$auth_links = '';
$admin_links = '';
if ($authenticated) {
    $auth_links = '
        <li class="menu__group">
            <a href="#" onclick="toggleSubmenu()" class="menu__link r-link submenu_parent">' . $lang['account'] . '</a>
            <div class="submenu" id="submenu">
                <a href="profile.php">' . $lang['my_account'] . '</a>
                <a href="cart.php">' . $lang['cart'] . '</a>
            </div>
        </li>
    ';
    if ($is_admin) {
        $auth_links = '
            <li class="menu__group">
                <a href="#" onclick="toggleSubmenu()" class="menu__link r-link submenu_parent">' . $lang['account'] . '</a>
                <div class="submenu" id="submenu">
                    <a href="profile.php">' . $lang['my_account'] . '</a>
                    <a href="admin.php">' . $lang['admin'] . '</a>
                    <a href="cart.php">' . $lang['cart'] . '</a>
                    <a onclick="signOut()" rel="nofollow" style="padding:20px;font-size: 15px;" class="logOut"><i class="fa-solid fa-power-off"></i>' . $lang['logout'] . '</a>
                </div>
            </li>
        ';
    }
} else {
    $auth_links = '
        <li class="menu__group">
            <a href="sign_in.php" class="menu__link r-link">' . $lang['login'] . '</a>
        </li>
    ';
}

echo '

<div class="menu">
    <nav id="main-menu" class="menu__nav">
        <div style="position: absolute;top: 100px;left: 20px;">
            <ul style="list-style:none;display:flex; gap: 25px; align-items:center">
                <li>
                    <a href="?lang=es">
                        <img style="width: 3rem;border-radius:0.6rem;" src="images/flags/es.png"/>
                    </a>
                </li>
                <li>
                    <a href="?lang=en">
                        <img style="width: 3rem;border-radius:0.6rem" src="images/flags/en.png"/>
                    </a>
                </li>
                <li>
                    <a href="?lang=fr">
                        <img style="width: 3rem;border-radius:0.6rem" src="images/flags/fr.png"/>
                    </a>
                </li>
                <li>
                    <label class="switch">
                        <input type="checkbox" checked onChange="toggleColorScheme();" id="input">
                        <span class="sliderdark round"></span>
                    </label>
                </li>
            </ul>
        </div>
        <div style="position: absolute;top: 45px;right: 75px;">
            <div class="search-box">
                <form method="GET" action="catalogo.php" id="searching_form">
                    <input type="text" placeholder=" " name="search" pattern=".*\S.*" autocomplete="off" minlength="1">
                    <button type="reset"></button>
                </form>
            </div>
        </div>
        <ul class="menu__list r-list">
        <li class="menu__group">
            <a href="index.php" class="menu__link r-link">' . $lang['home'] . '</a>
        </li>
        <li class="menu__group">
            <a href="catalogo.php" class="menu__link r-link">' . $lang['catalogue'] . '</a>
        </li>
        <li class="menu__group">
            <a href="contacto.php" class="menu__link r-link">' . $lang['contact'] . '</a>
        </li>
        <li class="menu__group">
            <a href="faqs.php" class="menu__link r-link">FAQs</a>
        </li>
        ' . $auth_links . '
        </ul>
    </nav>
    <button class="menu__toggle r-button" type="button" aria-controls="main-menu">
        <span class="menu__hamburger m-hamburger">
        <span class="m-hamburger__label">
            <span class="menu__toggle-hint screen-reader">' . $lang['open_menu'] . '</span>
        </span>
        </span>
    </button>
</div>

';

?>