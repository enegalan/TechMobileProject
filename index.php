
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechMobile | Eneko Galan</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
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
    <div class="head-title">
        <div class="icon-secret-game">
            TechMobile
        </div>
    </div>
    
    <!--Color Waves-->
    <?php include 'components/color_waves.php' ?>
    <!--Waves Footer-->
    <?php include 'components/waves_footer.php' ?>

    <div id="contenidoprincipal index" class="wpb_row vc_row-fluid vc_row standard_section">
        <div class="container">
            <a href="catalogo.php">
                <div class="card" href="catalogo.php">
                    <div class="face face1">
                        <div class="content">
                            <img src="https://img.icons8.com/external-vitaliy-gorbachev-lineal-vitaly-gorbachev/452/external-shop-sales-vitaliy-gorbachev-lineal-vitaly-gorbachev.png">
                            <h3>Catálogo</h3>
                        </div>
                    </div>
                </div>
            </a>
            
            <a href="contacto.php">
                <div class="card">
                    <div class="face face1">
                        <div class="content">
                            <img src="https://img.icons8.com/external-kiranshastry-lineal-kiranshastry/452/external-email-interface-kiranshastry-lineal-kiranshastry.png">
                            <h3>Contacto</h3>
                        </div>
                    </div>
                </div>
            </a>
            
            <a href="faqs.php">
                <div class="card">
                    <div class="face face1">
                        <div class="content">
                            <img src="https://img.icons8.com/external-bearicons-detailed-outline-bearicons/452/external-faq-frequently-asked-questions-faq-bearicons-detailed-outline-bearicons-1.png">
                            <h3>FAQs</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <script src="js/browser.js"></script>
    <script src="js/mobile_navbar.js"></script>
    <script src="js/userModal.js"></script>
    <script src="js/main.js"></script>
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