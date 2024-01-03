<?php 

include 'php/conn.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
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
            <a href="#" onclick="toggleSubmenu()" class="menu__link r-link submenu_parent">Cuenta</a>
            <div class="submenu" id="submenu">
                <a href="profile.php">Mi Cuenta</a>
                <a href="cart.php">Carrito</a>
            </div>
        </li>
    ';
    if ($is_admin) {
        $auth_links = '
            <li class="menu__group">
                <a href="#" onclick="toggleSubmenu()" class="menu__link r-link submenu_parent">Cuenta</a>
                <div class="submenu" id="submenu">
                    <a href="profile.php">Mi Cuenta</a>
                    <a href="admin.php">Admin</a>
                    <a href="cart.php">Carrito</a>
                    <a onclick="signOut()" rel="nofollow" style="padding:20px;font-size: 15px;" class="logOut"><i class="fa-solid fa-power-off"></i>Cerrar Sesión</a>
                </div>
            </li>
        ';
    }
} else {
    $auth_links = '
        <li class="menu__group">
            <a href="sign_in.php" class="menu__link r-link">Iniciar sesión</a>
        </li>
    ';
}

echo '

<div class="menu">
    <nav id="main-menu" class="menu__nav">
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
            <a href="index.php" class="menu__link r-link">Inicio</a>
        </li>
        <li class="menu__group">
            <a href="catalogo.php" class="menu__link r-link">Catálogo</a>
        </li>
        <li class="menu__group">
            <a href="contacto.php" class="menu__link r-link">Contacto</a>
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
            <span class="menu__toggle-hint screen-reader">Open menu</span>
        </span>
        </span>
    </button>
</div>

';

?>