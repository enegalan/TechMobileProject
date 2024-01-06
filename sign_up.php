<?php 
    if(session_status() !== PHP_SESSION_ACTIVE){
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
    <title>Sign Up | TechMobile | Eneko Galan</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/sign_up.css">
</head>

<body>
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
		<input type="text" id="inputSearch" placeholder="¿Qué deseas buscar?">
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
                    <h1>Sign Up</h1>

                    <div class="row">
                        <div>
                            <label for="sign_up_name">Name</label>
                            <input type="text" placeholder="Name" id="sign_up_name">
                        </div>
                        <div>
                            <label for="sign_up_surname">Surname</label>
                            <input type="text" placeholder="Surname" id="sign_up_surname">
                        </div>
                    </div>

                    <div class="row">
                        <div>
                            <label for="sign_up_username">Username</label>
                            <input type="text" placeholder="Username" id="sign_up_username">
                        </div>
                        <div>
                            <label for="sign_up_email">Email</label>
                            <input type="text" placeholder="Email" id="sign_up_email">
                        </div>
                        <div>
                            <label for="sign_up_birthdate">Birthdate</label>
                            <input type="date" placeholder="Birthdate" id="sign_up_birthdate">
                        </div>
                    </div>

                    <div class="row">
                        <div>
                            <label for="sign_up_password">Password</label>
                            <input type="password" placeholder="Password" id="sign_up_password">
                        </div>
                        <div>
                            <label for="sign_up_password2">Repeat Password</label>
                            <input type="password" placeholder="Repeat Password" id="sign_up_password2">
                        </div>
                    </div>

                    <span class="btn-sign-up" onclick="signUp()">Sign Up</span>
                    <span style="margin:auto;">Already have an account? Click <a style="color:#e5397d;" href="sign_in.php">here.</span>
                </div>
            </div>
        </div>
    </div>
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
