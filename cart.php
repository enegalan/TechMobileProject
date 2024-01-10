<?php 
    include 'lang/detect_lang.php';
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang['my_cart'] ?> | TechMobile | Eneko Galan</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" href="css/cart.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="productos/redirect.js"></script>
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
    <!--Color Waves-->
    <?php include 'components/color_waves.php' ?>
    <!--Waves Footer-->
    <?php include 'components/waves_footer.php' ?>

    <nav class="breadcrumbs">
        <a href="index.php" class="breadcrumbs__item"><?= $lang['home'] ?></a>
        <a class="breadcrumbs__item is-active"><?= $lang['my_cart'] ?></a>
    </nav>

    <div id="contenidoprincipal" class="wpb_row vc_row-fluid vc_row standard_section">
        <div class="main_cart">
            
        
        <div class="payment_details">
            <h1><?= $lang['payment_info'] ?></h1>
            <div class="details_card">
                <div class="name_address">
                    <div class="first_lastName">
                        <input type="text" placeholder="<?= $lang['name'] ?>" />
                        <input type="text" placeholder="<?= $lang['surname'] ?>" />
                        <input type="text" onkeyup="change()" id="put" placeholder="<?= $lang['address1'] ?>" />
                    </div>
                    <div class="address">
                        <input type="text" onkeyup="change()" id="put" placeholder="<?= $lang['address2'] ?>" />
                        <input type="number" placeholder="<?= $lang['zip'] ?>" min="1" />
                        <input type="text" placeholder="<?= $lang['city'] ?>" />
                        <input type="text" placeholder="<?= $lang['country'] ?>" />
                    </div>
                </div>
                <h1><?= $lang['billing_address'] ?></h1>
                <div class="my_addresses">
                    <?php include 'php/list_default_address.php';?>
                    <?php include 'php/list_my_addresses.php';?>
                </div>
                <div class="proced_payment">
                    <a href=""><?= $lang['proceed_payment'] ?></a>
                </div>
            </div>
        </div>
        <div class="order_summary">
            <h1><?= $lang['order_summary'] ?></h1>
            <div class="summary_card">
                <!--Cart List-->
            </div>
            
            <!--Cart Report-->
            <hr />
            <div class="order_price">
                <p><?= $lang['order'] ?></p>
                <h4>0</h4>
            </div>
            <div class="order_service">
                <p><?= $lang['additional_service'] ?></p>
                <h4>10€</h4>
            </div>
            <div class="order_total">
                <p><?= $lang['total_amount'] ?></p>
                <h4>0</h4>
            </div>
            <div class="proced_payment">
                    <a href=""><?= $lang['proceed_payment'] ?></a>
            </div>

        </div>
    </div>
    </div>

    </div>
    <script src="js/browser.js"></script>
    <script src="js/userModal.js"></script>
    <script src="js/main.js"></script>
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