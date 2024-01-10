<?php 
include 'lang/detect_lang.php';
$search = "%";
if (isset($_GET['search']) && !empty($_GET['search'])) $search = "%" . $_GET['search'] . "%";
?>
<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $lang['catalogue'] ?> | TechMobile | Eneko Galan</title>
	<script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<link rel="stylesheet" type="text/css" href="css/scroll.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
	<script src="https://unpkg.com/scrollreveal"></script>
</head>

<body style="background-color: #26282a">
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
	<div id="contenidoprincipal producto" class="wpb_row vc_row-fluid vc_row standard_section greyBx">
		<nav class="page-header-top-nav" id="#categoriasnav">
			<div class="page-header-top-nav-inside">
				<ul class="snippet-top-level-nav" id="snippet-top-level-nav">
					<?php
					include 'php/list_manufacturers.php';
					for ($i = 0; $i < count($manufacturers); $i++) {
						$url = "manufacturer.php?id=" . $manufacturers[$i]['id'];
						echo "<li><a href='" . $url . "'>" . ucfirst($manufacturers[$i]['name']) . "</a></li>";
					}
					$query->close();
					$conn->close();
					?>
				</ul>
			</div>
		</nav>
		<br>
		<?php
		$smartphones = searchSmartphones($search);
		if (count($smartphones) > 0) {
			for ($i = 0; $i < count($smartphones); $i++) {
				$defaultColor = explode(",", $smartphones[$i]['colors'])[0];
				echo '
				<div class="articulo">
					<div class="logoBx ' . $smartphones[$i]["manufacturer_name"] . '">
						<img src="productos/' . $smartphones[$i]["manufacturer_name"] . '/logo.png">
					</div>
				<div class="imgBx">
					<img class="loading" src="productos/' . $smartphones[$i]["manufacturer_name"] . '/img/catalogo/' . $smartphones[$i]["thumbnail_name"] . '.png">
					<div class="esqueleto"></div>
				</div>
				<div class="contentBx">
					<h2>' . $smartphones[$i]["title"] . '</h2>
					<div class="precioBx">' . $smartphones[$i]["price"] . '€</div>
					<a href="smartphone.php?id=' . $smartphones[$i]["id"] . '&color=' . $defaultColor . '">' . $lang['buy_now'] . '</a>
				</div>
			</div>
			';
			}
		} else {
			echo '<p class="no_results">' . $lang['no_products_available'] . '</p>.';
		}
		?>
		<a href="#" class="cd-top text-replace js-cd-top"><?= $lang['go_top'] ?></a>
		<button id="darkmode-btn" onclick="toggleColorScheme()"><i class="fas fa-sun fa-2x" id="btn-icon"></i></button>
	</div>
	<script src="js/browser.js"></script>
	<script src="js/reveal.js"></script>
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