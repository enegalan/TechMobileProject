<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
//If the user is logged in
if (isset($_SESSION['id'])) {
    if($_SESSION['is_admin'] == 0){
        echo '
        <ul class="listUser">
            <li><a href="profile.php" rel="nofollow"><i class="fa-solid fa-user"></i>Mi Cuenta</a></li>
            <li id="cart"><a href="cart.php" rel="nofollow"><i class="fa-solid fa-cart-shopping" data-cart-value="0"></i>Mi Carrito</a></li>
            <li><a onclick="signOut()" rel="nofollow" class="logOut"><i class="fa-solid fa-power-off"></i>CERRAR SESION</a></li>
        </ul>
		';
    }
    //If it is an admin
    else{
        echo '
        <ul class="listUser">
            <li><a href="profile.php" rel="nofollow"><i class="fa-solid fa-user"></i>Mi Cuenta</a></li>
            <li><a href="admin.php" rel="nofollow"><i class="fa-solid fa-star"></i>Panel de administración</a></li>
            <li id="cart"><a href="cart.php" rel="nofollow"><i class="fa-solid fa-cart-shopping" data-cart-value="0"></i>Mi Carrito</a></li>
            <li><a onclick="signOut()" rel="nofollow" class="logOut"><i class="fa-solid fa-power-off"></i>CERRAR SESION</a></li>
        </ul>
		';
    }
} else {
    echo '
        <div class="user-form-title">INICIAR SESIÓN</div>
        <form class="form-horizontal" method="POST">
            <label class="form-icon right">
                <input id="auth_email" name="email" type="text" placeholder="E-Mail">
                <i class="fa-solid fa-user"></i>
            </label>
            <label class="form-icon right">
                <input id="auth_password" name="password" type="password" placeholder="Contraseña">
                <input type="hidden" name="remember_me" value="1">
                <i class="fa-solid fa-lock"></i>
            </label>
            <a class="sign_in_button" onclick="signIn()">INICIAR SESIÓN</a>
            <div class="links">
                <a href="sign_up.php" rel="nofollow">Registrate</a>
                <a href="" rel="nofollow">¿Olvidaste tu contraseña?</a>
            </div>
        <form>
        ';
}
?>