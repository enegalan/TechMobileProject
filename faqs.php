﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>FAQs | TechMobile | Eneko Galan</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<body>
    <!--HEADER-->
	<header id="nav-wrapper">
		<div class="menu" id="show-menu">
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
		<!--Menu Bars (Mobile)-->
		<div id="icon-menu">
			<i class="fas fa-bars"></i>
		</div>
	</header>
	<!--Search input-->
	<div id="ctn-bars-search">
		<input type="text" id="inputSearch" placeholder="¿Qué deseas buscar?">
	</div>
	<!--Search Box Results-->
	<ul id="box-search">
		<?php
		include 'php/list_smartphones.php';
		?>
	</ul>
	<div id="cover-ctn-search"></div>
    <!--------->
    <!--Color Waves-->
    <?php include 'components/color_waves.php' ?>
    <!--Waves Footer-->
    <?php include 'components/waves_footer.php' ?>


    <div id="contenidoprincipal" class="wpb_row vc_row-fluid vc_row standard_section " style="padding-top: 8%;padding-bottom: 0px;display: inline-flex;position: absolute;flex-wrap: wrap;justify-content: center;width: 100%;">
        <h1 class="faqs-title">FAQS</h1>
        <div class="accordion">

            <!--List FAQs-->
            <?php include 'php/list_faqs.php'?>

        </div>
    </div>
    <script src="js/faqs.js"></script>
    <script src="js/browser.js"></script>
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