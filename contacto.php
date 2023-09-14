<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<title>Contacto | TechMobile | Eneko Galan</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
	<script src="js/main.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', 'UA-23581568-13');
	</script>
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
		<div class="contact1">
			<div class="container-contact1">
				<div class="contact1-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="contact1-form validate-form">
					<span class="contact1-form-title">
						Contacto
					</span>

					<div class="wrap-input1 validate-input" data-validate="Nombre requerido">
						<input class="input1" type="text" name="name" placeholder="Nombre">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1 validate-input" data-validate="Correo válido requerido: ex@abc.xyz">
						<input class="input1" type="text" name="email" placeholder="Email">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1 validate-input" data-validate="Asunto válido requerido">
						<input class="input1" type="text" name="subject" placeholder="Asunto">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1 validate-input" data-validate="Mensaje requerido">
						<textarea class="input1" name="message" type="text" cols="1" rows="10" placeholder="Mensaje"></textarea>
						<span class="shadow-input1"></span>
					</div>

					<div class="container-contact1-form-btn">
						<button class="contact1-form-btn">
							<span>
								Mandar mensaje
								<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</form>
			</div>
		</div>
		<script>
			$('.js-tilt').tilt({
				scale: 1.1
			})
		</script>
	</div>
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
