<?php 
    include 'lang/detect_lang.php';
    if(session_status() !== PHP_SESSION_ACTIVE && !headers_sent()){
        session_start();
    }
    if(isset($_SESSION['id'])){
        header('location: index.php');
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang['sign_in'] ?> | TechMobile | Eneko Galan</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/sign_up.css">
    <link rel="stylesheet" href="css/toast.css">
</head>

<body>
    <div id="preload-view">
            <div class="loader"></div>
    </div>
    <!--HEADER-->
	<header id="nav-wrapper">
		<div class="main_menu" id="show-menu">
			<nav id="nav">
				<div class="nav left">
					<span class="gradient skew">
						<h1 class="logo un-skew"><a href="index.php">TechMobile</a></h1>
					</span>
				</div>
				<div class="nav right">
					<!--Header Links-->
					<?php include 'components/header_links.php';?>
                    <!-- Dropdown Menu -->
                    <nav class="c-dropdown js-dropdown">
                        <div class="user-form">
                            <?php include 'components/header_user_dropdown.php'; ?>
                        </div>
                    </nav>
					<!--Search Icon-->
					<a id="ctn-icon-search" class="nav-link menu-default menu-exception">
						<span class="nav-link-span">
							<span class="u-nav">
								<i class="fas fa-search" id="icon-search" aria-hidden="true"></i>
							</span>
						</span>
					</a>
				</div>
			</nav>
		</div>
	</header>
    <!--Navbar menu (Mobile)-->
    <?php include 'components/mobile_navbar.php'; ?>
	<!--Search input-->
	<div id="ctn-bars-search">
		<input type="text" id="inputSearch" placeholder="<?= $lang['what_you_want_to_search'] ?>">
	</div>
	<!--Search Box Results-->
	<ul id="box-search">
		<?php
		include 'php/list_smartphones.php';
        listAllSmartphones();
		?>
	</ul>
	<div id="cover-ctn-search"></div>
    <!--------->

    <?php include 'components/color_waves.php' ?>
    <?php include 'components/waves_footer.php' ?>

    <div id="contenidoprincipal sign-up" class="wpb_row vc_row-fluid vc_row standard_section">
        <div class="container">
            <div class="sign_up_modal">
                <div class="sign_up_form">
                    <h1><?= $lang['sign_in'] ?></h1>

                    <div class="row">
                        <div>
                            <label for="sign_in_email"><?= $lang['email'] ?></label>
                            <input type="text" name="email" placeholder="<?= $lang['email'] ?>" id="sign_in_email">
                        </div>
                    </div>

                    <div class="row">
                        <div>
                            <label for="sign_in_password"><?= $lang['password'] ?></label>
                            <input type="password" name="password" placeholder="Password" id="sign_in_password">
                        </div>
                    </div>

                    <span class="btn-sign-up" onclick="signIn('#sign_in_email', '#sign_in_password')"><?= $lang['sign_in'] ?></span>
                    <span style="margin:auto;"><?= $lang['dont_have_account'] ?> <a style="color:#e5397d;" href="sign_up.php"><?= $lang['here'] ?>.</span>
                </div>
            </div>
        </div>
        <button id="darkmode-btn" onclick="toggleColorScheme()"><i class="fas fa-sun fa-2x" id="btn-icon"></i></button>
    </div>
    <script src="js/toast.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <script src="js/browser.js"></script>
    <script src="js/mobile_navbar.js"></script>
    <script src="js/userModal.js"></script>
    <?php 
        if(isset($_SESSION['id'])){
            echo '<script src="js/cart.js"></script>';
        }
    ?>
    <script src="js/auth.js"></script>
</body>
</html>
<!--
███████╗███╗░░██╗███████╗██╗░░██╗░█████╗░
██╔════╝████╗░██║██╔════╝██║░██╔╝██╔══██╗
█████╗░░██╔██╗██║█████╗░░█████═╝░██║░░██║
██╔══╝░░██║╚████║██╔══╝░░██╔═██╗░██║░░██║
███████╗██║░╚███║███████╗██║░╚██╗╚█████╔╝
╚══════╝╚═╝░░╚══╝╚══════╝╚═╝░░╚═╝░╚════╝░
-->