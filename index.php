<?php 
    include 'lang/detect_lang.php';
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechMobile | Eneko Galan</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/productSlider.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
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
    <!--Waves Footer-->
    <?php include 'components/waves_footer.php' ?>

    <div id="contenidoprincipal index" class="wpb_row vc_row-fluid vc_row standard_section">
        <div class="sliderContainer container">
            <!--Slider-->
            <!-- Slider main container -->
            <div id="header" class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <a href="">
                            <picture>
                                <source media="(max-width: 768px)" srcset="images/banners/es/min/banner1.avif">
                                <img src="images/banners/es/full/banner1.avif"/>
                            </picture>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <picture>
                                <source media="(max-width: 768px)" srcset="images/banners/es/min/banner2.avif">
                                <img src="images/banners/es/full/banner2.avif"/>
                            </picture>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <picture>
                                <source media="(max-width: 768px)" srcset="images/banners/es/min/banner3.avif">
                                <img src="images/banners/es/full/banner3.avif"/>
                            </picture>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <picture>
                                <source media="(max-width: 768px)" srcset="images/banners/es/min/banner4.avif">
                                <img src="images/banners/es/full/banner4.avif"/>
                            </picture>
                        </a>
                    </div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
        <div class="main-index">
            <!--Most recent smartphones-->
            <section id="most-recent">
                <h3><?= $lang['last_products_here'] ?></h3>
                <section id="last-products" class="products-slider">
                    <div class="product-container">
                        <ul class="autoWidth cs-hidden">
                            <!-- Slides -->
                            <?php
                                $smartphones = array_reverse(getAllSmartphones());                            
                                $limit = 16;
                                foreach ($smartphones as $smartphone) {
                                    if ($limit > 0) {
                                        $defaultColor = explode(",", $smartphone['colors'])[0];
                                        echo '
                                        <li class="item-a">
                                            <div class="product-box">
                                                <a href="smartphone.php?id=' . $smartphone["id"] . '&color=' . $defaultColor . '">
                                                    <strong>' . $smartphone['title'] . '</strong>
                                                    <img src="productos/' . $smartphone["manufacturer_name"] . '/img/catalogo/' . $smartphone["thumbnail_name"] . '.png">
                                                    <span class="precioBx">' . $smartphone['price'] . '</span>
                                                </a>
                                            </div>
                                        </li>
                                        ';
                                    }
                                    $limit--;
                                }

                            ?>
                        </ul>
                    </div>

                </section>
            </section>
            <!--Manufacturers-->
            <section id="manufacturer">
                <h3><?= $lang['find_by_manufacturer'] ?></h3>
                <div class="manufacturers_list">
                <?php include 'php/list_manufacturers.php'; 
                    foreach($manufacturers as $manufacturer) {
                        echo '<div class="manufacturer_article articulo"><a href="manufacturer.php?id=' . $manufacturer['id'] . '">' . 
                            '<div style="display:flex;justify-content:center;width:100%;height:50%"><img class="manufacturer_logo" src="productos/' . $manufacturer['name'] . '/logo.png"></div>'
                            . '<div style="display:flex;justify-content:center;align-items:center;width:100%;height:50%;border-top: 1px solid grey;"><span>' . ucfirst($manufacturer['name']) . '</span></div>'
                            . '</a></div>';
                    }
                ?>
                </div>
            </section>
            <!--Newsletters-->
            <section id="newsletters">
                <h3><?= $lang['looking_for_best_smartphones'] ?></h3>
                <p><?= $lang['suscribe_newsletters'] ?></p>
                <form action="" method="POST">
                    <div>
                        <input class="newsletters_input" type="text" placeholder="Correo electrónico">
                        <button class="newsletters_submit" type="submit"><?= $lang['i_suscribe'] ?></button>
                    </div>
                    <div>
                        <input type="checkbox" name="accept_conditions" id="accept_conditions">
                        <label for="accept_conditions"><?= $lang['accept_newsletters_conditions'] ?></label>
                    </div>
                </form>
            </section>
        </div>
        <button id="darkmode-btn" onclick="toggleColorScheme()"><i class="fas fa-sun fa-2x" id="btn-icon"></i></button>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
    <script src="js/swiper.js"></script>
    <script src="js/productSlider.js"></script>
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