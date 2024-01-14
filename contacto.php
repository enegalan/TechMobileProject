<?php 
	include 'lang/detect_lang.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $lang['contact'] ?> | TechMobile | Eneko Galan</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
	<script src="js/main.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="css/toast.css">

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
						<?= $lang['contact'] ?>
					</span>

					<div class="wrap-input1 validate-input" data-validate="<?= $lang['name'] ?> <?= $lang['required'] ?>">
						<input class="input1" type="text" name="name" placeholder="<?= $lang['name'] ?>">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1 validate-input" data-validate="<?= $lang['valid_email_required'] ?>: ex@abc.xyz">
						<input class="input1" type="text" name="email" placeholder="<?= $lang['email'] ?>">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1 validate-input" data-validate="<?= $lang['valid_subject_required'] ?>">
						<input class="input1" type="text" name="subject" placeholder="<?= $lang['subject'] ?>">
						<span class="shadow-input1"></span>
					</div>

					<div class="wrap-input1 validate-input" data-validate="<?= $lang['message'] ?> <?= $lang['required'] ?>">
						<textarea class="input1" name="message" type="text" cols="1" rows="10" placeholder="<?= $lang['message'] ?>"></textarea>
						<span class="shadow-input1"></span>
					</div>

					<div class="container-contact1-form-btn">
						<button class="contact1-form-btn">
							<span>
								<?= $lang['send_message'] ?>
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
		<button id="darkmode-btn" onclick="toggleColorScheme()"><i class="fas fa-sun fa-2x" id="btn-icon"></i></button>
	</div>
	<script src="js/toast.js"></script>
	<script src="js/browser.js"></script>
	<script src="js/userModal.js"></script>
    <script src="js/mobile_navbar.js"></script>
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
