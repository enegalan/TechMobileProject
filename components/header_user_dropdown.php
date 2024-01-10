<?php
include 'lang/detect_lang.php';
if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
    session_start();
}
//If the user is logged in
if (isset($_SESSION['id'])) {
    if($_SESSION['is_admin'] == 0){
        echo '
        <ul class="listUser">
            <li><a href="profile.php" rel="nofollow"><i class="fa-solid fa-user"></i>' . $lang['my_account'] . '</a></li>
            <li id="cart"><a href="cart.php" rel="nofollow"><i class="fa-solid fa-cart-shopping" data-cart-value="0"></i>' . $lang['my_cart'] . '</a></li>
            <li><a onclick="signOut()" rel="nofollow" class="logOut"><i class="fa-solid fa-power-off"></i>' . $lang['logout'] . '</a></li>
        </ul>
		';
    }
    //If it is an admin
    else{
        echo '
        <ul class="listUser">
            <li><a href="profile.php" rel="nofollow"><i class="fa-solid fa-user"></i>' . $lang['my_account'] . '</a></li>
            <li><a href="admin.php" rel="nofollow"><i class="fa-solid fa-star"></i>' . $lang['admin_dashboard'] . '</a></li>
            <li id="cart"><a href="cart.php" rel="nofollow"><i class="fa-solid fa-cart-shopping" data-cart-value="0"></i>' . $lang['my_cart'] . '</a></li>
            <li><a onclick="signOut()" rel="nofollow" class="logOut"><i class="fa-solid fa-power-off"></i>' . $lang['logout'] . '</a></li>
        </ul>
		';
    }
} else {
    echo '
        <div class="user-form-title">' . $lang['login'] . '</div>
        <form class="form-horizontal" method="POST">
            <label class="form-icon right">
                <input id="auth_email" name="email" type="text" placeholder="' . $lang['email'] . '">
                <i class="fa-solid fa-user"></i>
            </label>
            <label class="form-icon right">
                <input id="auth_password" name="password" type="password" placeholder="' . $lang['password'] . '">
                <input type="hidden" name="remember_me" value="1">
                <i class="fa-solid fa-lock"></i>
            </label>
            <a class="sign_in_button" onclick="signIn()">' . $lang['login'] . '</a>
            <div class="links">
                <a href="sign_up.php" rel="nofollow">' . $lang['sign_up'] . '</a>
                <a href="" rel="nofollow">' . $lang['forgot_password'] . '</a>
            </div>
        <form>
        ';
}
?>