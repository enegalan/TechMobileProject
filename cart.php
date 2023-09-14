<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>My Cart | TechMobile | Eneko Galan</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" href="css/cart.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="productos/redirect.js"></script>
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

    <div id="inner-wrap">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" width="100%" height="321.75" viewBox="0 0 960 214.5"
            preserveAspectRatio="xMinYMid meet">
            <defs>
                <linearGradient id="a">
                    <stop stop-color="#00A8DE" />
                    <stop offset="0.2" stop-color="#333391" />
                    <stop offset="0.4" stop-color="#E91388" />
                    <stop offset="0.6" stop-color="#EB2D2E" />
                </linearGradient>
            </defs>
            <path fill="url(#a)"
                d="M2662.6 1S2532 41.2 2435 40.2c-19.6-.2-37.3-1.3-53.5-2.8 0 0-421.3-59.4-541-28.6-119.8 30.6-206.2 75.7-391 73.3-198.8-2-225.3-15-370.2-50-145-35-218 37-373.3 36-19.6 0-37.5-1-53.7-3 0 0-282.7-36-373.4-38C139 26 75 46-1 46v106c17-1.4 20-2.3 37.6-1.2 130.6 8.4 210 56.3 287 62.4 77 6 262-25 329.3-23.6 67 1.4 107 22.6 193 23.4 155 1.5 249-71 380-62.5 130 8.5 209 56.3 287 62.5 77 6 126-18 188-18 61.4 0 247-38 307.4-46 159.3-20 281.2 29 348.4 30 67 2 132.2 6 217.4 7 39.3 0 87-11 87-11V1z" />
            <path fill="#26282a"
                d="M2663.6 73.2S2577 92 2529 89c-130.7-8.5-209.5-56.3-286.7-62.4s-125.7 18-188.3 18c-5 0-10-.4-14.5-.7-52-5-149.2-43-220.7-39-31.7 2-64 14-96.4 30-160.4 80-230.2-5.6-340.4-18-110-12-146.6 20-274 36S820.4 0 605.8 0C450.8 0 356 71 225.2 62.2 128 56 60.7 28-.3 11.2V104c22 7.3 46 14.2 70.4 16.7 110 12.3 147-19.3 275-35.5s350 39.8 369 43c27 4.3 59 8 94 10 13 .5 26 1 39 1 156 2 250-70.3 381-62 130.5 8.2 209.5 56.3 286.7 62 77 6.4 125.8-18 188.3-17.5 5 0 10 .2 14.3.6 52 5 145 49.5 220.7 38.2 32-5 64-15 96.6-31 160.5-79.4 230.3 6 340 18.4 110 12 146.3-20 273.7-36l15.5-2V73l1-.5z" />
            <g fill="none" stroke="#E2E9E9" stroke-width="1">
                <path
                    d="M0 51.4c3.4.6 7.7 1.4 11 2.3 133.2 34 224.3 34 308.6 34 110.2 0 116.7 36.6 229.8 26 113-11 128.7-44 222-42.6C865 73 889 38 1002 27c113-10.8 119.6 25.6 229.8 25.6 84.4 0 175.4 0 308.6 34 133 34.2 277-73 379.4-84.3 204-22.5 283.6 128.7 283.6 128.7" />
                <path
                    d="M0 6C115.7-6 198.3 76.6 308 76.6c109.6 0 131.8-20 223-28.3 114.3-10.2 238.2 0 238.2 0s124 10.2 238.3 0c91-8.2 113.2-28 223-28S1425 103 1541 91c115.8-11.8 153.3-69 269.3-84.6 116-15.5 198.4 71 308 71 109.8 0 131.8-20 223-28 114-10.2 237.7 0 237.7 0s37.4 2.4 82.8 3.7" />
            </g>
        </svg>
    </div>

    <div class="nectar-shape-divider-wrap " data-front="" data-style="mountains" data-position="bottom">
        <svg class="nectar-shape-divider" fill="#2c2f33" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 300"
            preserveAspectRatio="none">
            <path
                d="M 1014 264 v 122 h -808 l -172 -86 s 310.42 -22.84 402 -79 c 106 -65 154 -61 268 -12 c 107 46 195.11 5.94 275 137 z">
            </path>
            <path
                d="M -302 55 s 235.27 208.25 352 159 c 128 -54 233 -98 303 -73 c 92.68 33.1 181.28 115.19 235 108 c 104.9 -14 176.52 -173.06 267 -118 c 85.61 52.09 145 123 145 123 v 74 l -1306 10 z">
            </path>
            <path
                d="M -286 255 s 214 -103 338 -129 s 203 29 384 101 c 145.57 57.91 178.7 50.79 272 0 c 79 -43 301 -224 385 -63 c 53 101.63 -62 129 -62 129 l -107 84 l -1212 12 z">
            </path>
            <path
                d="M -24 69 s 299.68 301.66 413 245 c 8 -4 233 2 284 42 c 17.47 13.7 172 -132 217 -174 c 54.8 -51.15 128 -90 188 -39 c 76.12 64.7 118 99 118 99 l -12 132 l -1212 12 z">
            </path>
            <path
                d="M -12 201 s 70 83 194 57 s 160.29 -36.77 274 6 c 109 41 184.82 24.36 265 -15 c 55 -27 116.5 -57.69 214 4 c 49 31 95 26 95 26 l -6 151 l -1036 10 z">
            </path>
        </svg>
    </div>

    <nav class="breadcrumbs">
        <a href="index.php" class="breadcrumbs__item">Inicio</a>
        <a href="catalogo.php" class="breadcrumbs__item is-active">Mi Carrito</a>
    </nav>

    <div id="contenidoprincipal" class="wpb_row vc_row-fluid vc_row standard_section">
        <div class="main_cart">
            
        
        <div class="payment_details">
            <h1>Payment Information</h1>
            <div class="details_card">
                <div class="name_address">
                    <div class="first_lastName">
                        <input type="text" placeholder="First Name" />
                        <input type="text" placeholder="Last Name" />
                        <input type="text" onkeyup="change()" id="put" placeholder="Address1" />
                    </div>
                    <div class="address">
                        <input type="text" onkeyup="change()" id="put" placeholder="Address2" />
                        <input type="number" placeholder="ZIP" min="1" />
                        <input type="text" placeholder="City" />
                        <input type="text" placeholder="Country" />
                    </div>
                </div>
                <h1>Billing Address</h1>
                <div class="my_addresses">
                    <?php include 'php/list_default_address.php';?>
                    <?php include 'php/list_my_addresses.php';?>
                </div>
                <div class="proced_payment">
                    <a href="">Procced to payment</a>
                </div>
            </div>
        </div>
        <div class="order_summary">
            <h1>Order Summary</h1>
            <div class="summary_card">
                <!--Cart List-->
            </div>
            
            <!--Cart Report-->
            <hr />
            <div class="order_price">
                <p>Order summary</p>
                <h4>0</h4>
            </div>
            <div class="order_service">
                <p>Additional Service</p>
                <h4>10€</h4>
            </div>
            <div class="order_total">
                <p>Total Amount</p>
                <h4>0</h4>
            </div>

        </div>
    </div>
    </div>

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