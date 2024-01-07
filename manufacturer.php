<?php
	include 'lang/detect_lang.php';
    if(isset($_GET['id'])){
        include 'php/conn.php';
        $id = $_GET['id'];
        $query1 = $conn->prepare("SELECT id, name FROM manufacturers WHERE id = ? LIMIT 1");
        $query1->bind_param("i",$id);
        $query1->execute();
        $res = $query1->get_result();
        $manufacturer = array();
        $rows = $res->num_rows;
        for($i = 0; $i < $rows; $i++){
            $manufacturer[] = $res->fetch_assoc();
        }

        $query2 = $conn->prepare("SELECT S.id, S.title, S.subtitle1, S.subtitle2, M.name AS manufacturer_name, S.price, S.description, S.rating, S.width, S.height, S.thick, S.weight, S.display, S.chip, S.camera, S.os, S.storage, S.colors, S.thumbnail_name, S.model FROM smartphones S INNER JOIN manufacturers M on S.manufacturer_id = M.id where M.id = ?");
        $query2->bind_param("i",$id);
        $query2->execute();
        $res2 = $query2->get_result();
		$rows = $res2->num_rows;
		$m_smartphones = array();
		if($rows > 0){
			for($i = 0; $i < $rows; $i++){
				$m_smartphones[] = $res2->fetch_assoc();
			}
		}
    }
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= ucfirst($manufacturer[0]['name'])?> | TechMobile | Eneko Galan</title>
	<script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<link rel="stylesheet" type="text/css" href="css/scroll.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
	<script src="https://unpkg.com/scrollreveal"></script>
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
	<div id="contenidoprincipal producto" class="wpb_row vc_row-fluid vc_row standard_section greyBx">
		<nav class="page-header-top-nav" id="#categoriasnav">
			<div class="page-header-top-nav-inside">
				<ul class="snippet-top-level-nav" id="snippet-top-level-nav">
					<?php
						include 'php/list_manufacturers.php';
						for ($i = 0; $i < count($manufacturers); $i++) {
							if($_GET['id'] == $manufacturers[$i]['id']){
								$url= "#";
							}else{
								$url = "manufacturer.php?id=" . $manufacturers[$i]['id'];
							}
							echo "<li><a href='" . $url . "'>" . ucfirst($manufacturers[$i]['name']) . "</a></li>";
						}
						$query->close();
					?>
				</ul>
			</div>
		</nav>

		<?php
			if ($m_smartphones) {
				for ($i = 0; $i < count($m_smartphones); $i++) {
					$defaultColor = explode(",", $m_smartphones[$i]['colors'])[0];
						echo '
						<div class="articulo">
							<div class="logoBx ' . $m_smartphones[$i]["manufacturer_name"] . '">
								<img src="productos/' . $m_smartphones[$i]["manufacturer_name"] . '/logo.png">
							</div>
						<div class="imgBx">
							<img class="loading" src="productos/' . $m_smartphones[$i]["manufacturer_name"] . '/img/catalogo/' . $m_smartphones[$i]["thumbnail_name"] . '.png">
							<div class="esqueleto"></div>
						</div>
						<div class="contentBx">
							<h2>' . $m_smartphones[$i]["title"] . '</h2>
							<div class="precioBx">' . $m_smartphones[$i]["price"] . '€</div>
							<a href="smartphone.php?id=' . $m_smartphones[$i]["id"] . '&color=' . $defaultColor . '">' . $lang['buy_now'] . '</a>
						</div>
					</div>
					';
				}
			} else {
				echo '<p class="no_results">' . $lang['no_products_available'] . '</p>.';
			}
			$conn->close();
		?>
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