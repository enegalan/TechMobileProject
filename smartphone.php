<?php 
    include 'lang/detect_lang.php';

    //Get Smartphone data via GET ?id and ?color
    if(isset($_GET['id']) && isset($_GET['color'])){
        include 'php/conn.php';
        $id = $_GET['id'];
        $color = $_GET['color'];
        $product_query = $conn->prepare("SELECT S.id, S.title, S.subtitle1, S.subtitle2, S.image_count, S.manufacturer_id, M.name AS manufacturer_name, S.price, S.description, S.width, S.height, S.thick, S.weight, S.display, S.chip, S.camera, S.os, S.storage, S.colors, S.thumbnail_name, S.model FROM smartphones S INNER JOIN manufacturers M ON S.manufacturer_id = M.id WHERE S.id = ? LIMIT 1");
        $product_query->bind_param("i",$id);
        $product_query->execute();
        $product_res = $product_query->get_result();
        $rows = $product_res->num_rows;
        for($i = 0; $i < $rows; $i++){
            $smartphone = $product_res->fetch_assoc();
        }
        
        /* 
            Get statistics
        */

        // Get global avg and count
        $stats_global_query = $conn->prepare("SELECT AVG(media) as avg, COUNT(*) as count FROM opinions WHERE smartphone_id = ?");
        $stats_global_query->bind_param("i", $smartphone['id']);
        $stats_global_query->execute();
        $stats_global_res = $stats_global_query->get_result();
        $stats_global_data = $stats_global_res->fetch_assoc();
        $global_avg = $stats_global_data['avg'] > 0 ? $stats_global_data['avg'] : 0;
        $global_count = $stats_global_data['count'] > 0 ? $stats_global_data['count'] : 0;

        // Get global recommended percentage and count
        $stats_global_recommended_query = $conn->prepare("SELECT COUNT(recommended) AS recommended_count FROM opinions WHERE smartphone_id = ?");
        $stats_global_recommended_query->bind_param("i", $smartphone['id']);
        $stats_global_recommended_query->execute();
        $stats_global_recommended_res = $stats_global_recommended_query->get_result();
        $stats_global_recommended_data = $stats_global_recommended_res->fetch_assoc();
        $global_recommended_count = $stats_global_recommended_data['recommended_count'];
        if ($global_count > 0) {
            $global_recommended_percentage = ($global_recommended_count * 100) / $global_count;
        } else {
            $global_recommended_percentage = 0;
        }

        // Get 5 stars rated count
        $stats_global_5_query = $conn->prepare("SELECT COUNT(*) as count FROM opinions WHERE smartphone_id = ? AND media BETWEEN 4.1 AND 5");
        $stats_global_5_query->bind_param("i", $smartphone['id']);
        $stats_global_5_query->execute();
        $stats_global_5_res = $stats_global_5_query->get_result();
        $stats_global_5_data = $stats_global_5_res->fetch_assoc();
        $global_5_count = $stats_global_5_data['count'];

        // Get 4 stars rated count
        $stats_global_4_query = $conn->prepare("SELECT COUNT(*) as count FROM opinions WHERE smartphone_id = ? AND media BETWEEN 3.1 AND 4");
        $stats_global_4_query->bind_param("i", $smartphone['id']);
        $stats_global_4_query->execute();
        $stats_global_4_res = $stats_global_4_query->get_result();
        $stats_global_4_data = $stats_global_4_res->fetch_assoc();
        $global_4_count = $stats_global_4_data['count'];

        // Get 3 stars rated count
        $stats_global_3_query = $conn->prepare("SELECT COUNT(*) as count FROM opinions WHERE smartphone_id = ? AND media BETWEEN 2.1 AND 3");
        $stats_global_3_query->bind_param("i", $smartphone['id']);
        $stats_global_3_query->execute();
        $stats_global_3_res = $stats_global_3_query->get_result();
        $stats_global_3_data = $stats_global_3_res->fetch_assoc();
        $global_3_count = $stats_global_3_data['count'];

        // Get 2 stars rated count
        $stats_global_2_query = $conn->prepare("SELECT COUNT(*) as count FROM opinions WHERE smartphone_id = ? AND media BETWEEN 1.1 AND 2");
        $stats_global_2_query->bind_param("i", $smartphone['id']);
        $stats_global_2_query->execute();
        $stats_global_2_res = $stats_global_2_query->get_result();
        $stats_global_2_data = $stats_global_2_res->fetch_assoc();
        $global_2_count = $stats_global_2_data['count'];

        // Get 1 stars rated count
        $stats_global_1_query = $conn->prepare("SELECT COUNT(*) as count FROM opinions WHERE smartphone_id = ? AND media BETWEEN 0 AND 1");
        $stats_global_1_query->bind_param("i", $smartphone['id']);
        $stats_global_1_query->execute();
        $stats_global_1_res = $stats_global_1_query->get_result();
        $stats_global_1_data = $stats_global_1_res->fetch_assoc();
        $global_1_count = $stats_global_1_data['count'];
    }else{
        header('location: catalogo.php');
    }
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $smartphone['title']?> | TechMobile | Eneko Galan</title>
    <link rel="stylesheet" type="text/css" href="productos/style-productos.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="productos/scripts-productos.js"></script>
    <script src="productos/redirect.js"></script>
    <script src="js/main.js"></script>
    <script src="js/userModal.js"></script>
    <link rel="stylesheet" type="text/css" href="css/ratingStars.css" />
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
        <a href="catalogo.php" class="breadcrumbs__item"><?= $lang['catalogue'] ?></a>
        <?= "<a href='manufacturer.php?id=" . $smartphone['manufacturer_id'] . "' class='breadcrumbs__item'>" . ucfirst($smartphone['manufacturer_name']) . "</a>";?>
        <?= "<a class='breadcrumbs__item is-active'>" . $smartphone['title'] . "</a>";?>
    </nav>

    <div id="contenidoprincipal" class="wpb_row vc_row-fluid vc_row standard_section"
        data-product-id="<?= $id;?>">
        <div class="centrado_articulo">
            <div id="articulo" class="<?= $smartphone['thumbnail_name'];?>">
                <div class="column small-centered">
                    <div class="productCard_block">

                        <div class="row">
                            <div class="small-12 large-6 columns carrusel">
                                <div class="productCard_leftSide clearfix">
                                    <div class="sliderBlock">
                                        <ul class="sliderBlock_items">
                                            <?php 
                                                $imageCount = $smartphone['image_count'];
                                                for($i = 0; $i < $imageCount; $i++){
                                                    echo "<li class='sliderBlock_items__itemPhoto'>
                                                    <img id='image_" . $smartphone['id'] . "_". ($i + 1) . "' src='productos/" . $smartphone['manufacturer_name'] . "/img/producto/" . $smartphone['model'] . "/" . $color . "/" . $i + 1 . ".png' alt='thumbnail-" . ($i + 1) . "'>
                                                    </li>
                                                    ";
                                                }
                                            ?>
                                        </ul>

                                        <div class="sliderBlock_controls">
                                            <ul class="sliderBlock_positionControls">
                                                <?php 
                                                    for($i = 0; $i < $imageCount; $i++){
                                                        if($i == 0){
                                                            echo "<li class='sliderBlock_positionControls__paginatorItem sliderBlock_positionControls__active'>
                                                                    <img id='mini_image_" . $smartphone['id'] . "_". ($i + 1) . "' src='productos/" . $smartphone['manufacturer_name'] . "/img/producto/" . $smartphone['model'] . "/" . $color . "/" . $i + 1 . ".png' alt='thumbnail-" . ($i + 1) . "'>
                                                                </li>
                                                            ";
                                                        }else{
                                                            echo "<li class='sliderBlock_positionControls__paginatorItem'>
                                                            <img id='mini_image_" . $smartphone['id'] . "_". ($i + 1) . "' src='productos/" . $smartphone['manufacturer_name'] . "/img/producto/" . $smartphone['model'] . "/" . $color . "/" . $i + 1 . ".png' alt='thumbnail-" . ($i + 1) . "'>
                                                            </li>";
                                                        }
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="small-12 large-6 columns contenido">
                                <div class="productCard_rightSide">
                                    <div class="block_specification">
                                        <div class="block_specification__specificationShow">
                                            <i class="fa fa-cog block_specification__button block_specification__button__rotate"
                                                aria-hidden="true"></i>
                                            <span class="block_specification__text"><?= $lang['specs'] ?></span>
                                        </div>
                                        <div class="block_specification__informationShow hide">
                                            <i class="fa fa-info-circle block_specification__button block_specification__button__jump"
                                                aria-hidden="true"></i>
                                            <span class="block_specification__text"><?= $lang['info'] ?></span>
                                        </div>
                                    </div>

                                    <div class="block_product">
                                        <h2 class="block_name block_name__mainName"><span
                                                class="smartphone_main_title"><?= $smartphone['title'];?></span><sup>&reg;
                                            </sup></h2>
                                        <h2 class="block_name block_name__addName">
                                            <?= $smartphone['subtitle1']; ?></h2>

                                        <p class="block_product__advantagesProduct">
                                            <?= $smartphone['subtitle2'];?>
                                        </p>

                                        <div class="block_informationAboutDevice">

                                            <div
                                                class="block_descriptionCharacteristic block_descriptionCharacteristic__disActive">
                                                <table class="block_specificationInformation_table">
                                                    <tr>
                                                        <th><?= $lang['caracteristics'] ?></th>
                                                        <th><?= $lang['value'] ?></th>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $lang['color'] ?></td>
                                                        <td><?= ucfirst($color); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $lang['width'] ?></td>
                                                        <td><?= $smartphone['width'];?>cm</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $lang['height'] ?></td>
                                                        <td><?= $smartphone['height'];?>cm</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $lang['thick'] ?></td>
                                                        <td><?= $smartphone['thick'];?>cm</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $lang['weight'] ?></td>
                                                        <td><?= $smartphone['weight'];?>g</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $lang['display'] ?></td>
                                                        <td><?= $smartphone['display'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $lang['chip'] ?></td>
                                                        <td><?= $smartphone['chip'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $lang['camera'] ?></td>
                                                        <td><?= $smartphone['camera'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $lang['os'] ?></td>
                                                        <td><?= $smartphone['os'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $lang['storage'] ?></td>
                                                        <?php 
                                                            $storages = explode(",",$smartphone['storage']);
                                                            $out = "";
                                                            for($i = 0; $i < count($storages); $i++){
                                                                if($i == count($storages) -1 ){
                                                                    $out .= " y " . $storages[$i] . "GB";
                                                                    break;
                                                                }
                                                                if($i == 0){
                                                                    $out = $storages[$i] . "GB";
                                                                }else{
                                                                    $out .= ", " . $storages[$i] . "GB";
                                                                }
                                                            }
                                                            echo "<td>" . $out . "</td>";
                                                        ?>
                                                    </tr>
                                                </table>
                                            </div>


                                            <div class="block_descriptionInformation">
                                                <span>
                                                    <?= $smartphone['description']; ?>
                                                </span>
                                            </div>
                                            <div class="block_rating clearfix">
                                                <div class="rating_stars_section">
                                                    <div fill="#FFA90D" class="opinion_stars_background">
                                                        <div fill="#FFA90D" data-testid="percent-bar" id="rating_avg_stars" value="<?= $global_avg ?>" class="opinion_stars"></div>
                                                    </div>
                                                </div>
                                                <span
                                                    class="block_rating__avarage"><?= $global_avg ?></span>
                                            </div>
                                            <div class="row">
                                                <div class="price_and_quantity left-align">
                                                    <div class="block_price">
                                                        <p class="block_price__currency">
                                                            <?= $smartphone['price'];?>€</p>
                                                        <p class="block_price__shipping"><?= $lang['plus_shipping_costs'] ?></p>
                                                    </div>
                                                    <div class="block_quantity clearfix">
                                                        <span class="text_specification"><?= $lang['quantity'] ?></span>
                                                        <div class="block_quantity__chooseBlock">
                                                            <input id="amountInput" class="block_quantity__number"
                                                                name="quantityNumber" type="text" min="1" value="1">
                                                            <div>
                                                                <button
                                                                    class="block_quantity__button block_quantity__up"></button>
                                                                <button
                                                                    class="block_quantity__button block_quantity__down"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="large-6 small-12 column end">
                                                    <div class="block_goodColor">
                                                        <span class="text_specification"><?= $lang['choose_color'] ?>:</span>
                                                        <div class="block_goodColor__allColors">
                                                            <?php
                                                                $colors = explode(",",$smartphone['colors']);
                                                                for($i = 0; $i < count($colors);$i++){
                                                                    if($colors[$i] == $color){
                                                                        echo "
                                                                        <input type='radio' name='colorOfItem' class='radio_button' id='radioColor" . $i + 1 . "' checked />
                                                                        ";
                                                                    }else{
                                                                        echo "
                                                                        <input type='radio' name='colorOfItem' class='radio_button' id='radioColor" . $i + 1 . "' />
                                                                        ";
                                                                    }
                                                                    echo '<label onclick="redireccionarColor(\'' . strtolower($color) . '\', \'' . strtolower($colors[$i]) . '\')" title="' . $lang[$colors[$i]] . '" for="radioColor' . ($i + 1) . '" class="block_goodColor__radio block_goodColor__' . $colors[$i] . '"></label>';
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <button id="addToCart" class="button button_addToCard"><?= $lang['add_to_cart'] ?></button>
                                                </div>
                                            </div>
                                            <ul class="blogpost-navigation">
                                                <?php
                                                    // Get the next smartphone
                                                    $next_smartphone_id = $smartphone['id'] + 1;
                                                    $next_smartphone_query = $conn->prepare("SELECT id, colors, title, thumbnail_name FROM smartphones WHERE id = ?");
                                                    $next_smartphone_query->bind_param("i", $next_smartphone_id);
                                                    $next_smartphone_query->execute();
                                                    $next_smartphone_res = $next_smartphone_query->get_result();
                                                    $next_smartphone = $next_smartphone_res->fetch_assoc();

                                                    // Get the previous smartphone
                                                    $previous_smartphone_id = $smartphone['id'] - 1;
                                                    if ($previous_smartphone_id > 0) {
                                                        $previous_smartphone_query = $conn->prepare("SELECT id, colors, title, thumbnail_name FROM smartphones WHERE id = ?");
                                                        $previous_smartphone_query->bind_param("i", $previous_smartphone_id);
                                                        $previous_smartphone_query->execute();
                                                        $previous_smartphone_res = $previous_smartphone_query->get_result();
                                                        $previous_smartphone = $previous_smartphone_res->fetch_assoc();
                                                    } else {
                                                        $previous_smartphone = null;
                                                    }

                                                    if($previous_smartphone) {
                                                        echo '
                                                        <li class="prev">
                                                            <a href="smartphone.php?id=' . $previous_smartphone['id'] . '&color=' . explode(',',  $previous_smartphone['colors'])[0] . '" class="btn btn-default">
                                                                <i class="fa fa-angle-right fa-lg fa-navigationblock" aria-hidden="true"></i>
                                                                <span>
                                                                    <strong>' . $previous_smartphone['title'] . '</strong><br>
                                                                </span>
                                                                <img src="productos/apple/img/catalogo/' . $previous_smartphone['thumbnail_name'] . '.png" width="100" alt="' . $previous_smartphone['title'] . '">
                                                            </a>
                                                        </li>
                                                        ';
                                                    }

                                                    if ($next_smartphone) {
                                                        echo '
                                                            <li class="next">
                                                                <a href="smartphone.php?id=' . $next_smartphone['id'] . '&color=' . explode(',',  $next_smartphone['colors'])[0] . '" class="btn btn-default">
                                                                    <span>
                                                                        <strong>' . $next_smartphone['title'] . '</strong><br>
                                                                    </span>
                                                                    <img src="productos/apple/img/catalogo/' . $next_smartphone['thumbnail_name'] . '.png" width="100" alt="' . $next_smartphone['title'] . '">
                                                                    <i class="fa fa-angle-right fa-lg fa-navigationblock" aria-hidden="true"></i>
                                                                </a>
                                                            </li>
                                                        ';
                                                    }
                                                    if ($next_smartphone) $next_smartphone_query->close();
                                                    if ($previous_smartphone) $previous_smartphone_query->close();
                                                ?>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="opinions">

                            <div id="opinions-summary">
                                <div class="opinions_report">
                                    <div class="report_card">
                                        <div class="opinion_card_content">
                                            <div value="<?= $global_avg ?>" class="rating_avg_value"></div>
                                            <div class="rating_stars_section">
                                                <div fill="#FFA90D" class="opinion_stars_background">
                                                    <div fill="#FFA90D" data-testid="percent-bar" id="rating_avg_stars" value="<?= $global_avg ?>" class="opinion_stars"></div>
                                                </div>
                                            </div>
                                            <span value="<?= $global_count ?>" class="opinions_value"> <?= $lang['opinions'] ?></span>
                                        </div>
                                    </div>
                                    <div class="report_card">
                                        <div class="opinion_card_content">
                                            <div value="<?= $global_recommended_percentage ?>" class="recommended_percentage_value">%</div>
                                            <span class="recommended_title"><?= $lang['recommended'] ?></span>
                                            <span value="<?= $global_recommended_count ?>" class="recommended_value"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="opinions_report">
                                    <div class="ratings_report">
                                        <ul class="ratings_ul">
                                            <li data-testid="star-5" class="rating_li">
                                                <span class="rating_placeholder">5</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    enable-background="new 0 0 24 24" fill="#FFA90D"
                                                    class="star">
                                                    <path
                                                        d="M21.9 8.6c-.1-.4-.5-.6-.9-.6h-5.4l-2.7-5.4c-.3-.7-1.4-.7-1.8 0L8.4 8H3c-.4 0-.8.2-.9.6-.2.4-.1.8.2 1.1l4.6 4.6L5 20.7c-.1.4 0 .8.4 1.1.3.2.8.3 1.1 0l5.4-3.6 5.4 3.6c.2.1.4.2.6.2.2 0 .4-.1.6-.2.3-.2.5-.7.4-1.1l-1.8-6.4 4.6-4.6c.3-.3.4-.7.2-1.1z">
                                                    </path>
                                                </svg><script src="js/browser.js"></script>
                                                <div class="rating_bar">
                                                    <span class="rating_bar_5"></span>
                                                </div>
                                                <span class="rating_value"><?= $global_5_count ?></span>
                                            </li>
                                            <li data-testid="star-4" class="rating_li">
                                                <span class="rating_placeholder">4</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    enable-background="new 0 0 24 24" fill="#FFA90D"
                                                    class="star">
                                                    <path
                                                        d="M21.9 8.6c-.1-.4-.5-.6-.9-.6h-5.4l-2.7-5.4c-.3-.7-1.4-.7-1.8 0L8.4 8H3c-.4 0-.8.2-.9.6-.2.4-.1.8.2 1.1l4.6 4.6L5 20.7c-.1.4 0 .8.4 1.1.3.2.8.3 1.1 0l5.4-3.6 5.4 3.6c.2.1.4.2.6.2.2 0 .4-.1.6-.2.3-.2.5-.7.4-1.1l-1.8-6.4 4.6-4.6c.3-.3.4-.7.2-1.1z">
                                                    </path>
                                                </svg>
                                                <div class="rating_bar">
                                                    <span class="rating_bar_4"></span>
                                                </div>
                                                <span class="rating_value"><?= $global_4_count ?></span>
                                            </li>
                                            <li data-testid="star-3" class="rating_li">
                                                <span class="rating_placeholder">3</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    enable-background="new 0 0 24 24" fill="#FFA90D"
                                                    class="star">
                                                    <path
                                                        d="M21.9 8.6c-.1-.4-.5-.6-.9-.6h-5.4l-2.7-5.4c-.3-.7-1.4-.7-1.8 0L8.4 8H3c-.4 0-.8.2-.9.6-.2.4-.1.8.2 1.1l4.6 4.6L5 20.7c-.1.4 0 .8.4 1.1.3.2.8.3 1.1 0l5.4-3.6 5.4 3.6c.2.1.4.2.6.2.2 0 .4-.1.6-.2.3-.2.5-.7.4-1.1l-1.8-6.4 4.6-4.6c.3-.3.4-.7.2-1.1z">
                                                    </path>
                                                </svg>
                                                <div class="rating_bar">
                                                    <span class="rating_bar_3"></span>
                                                </div><span class="rating_value"><?= $global_3_count ?></span>
                                            </li>
                                            <li data-testid="star-2" class="rating_li">
                                                <span class="rating_placeholder">2</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    enable-background="new 0 0 24 24" fill="#FFA90D"
                                                    class="star">
                                                    <path
                                                        d="M21.9 8.6c-.1-.4-.5-.6-.9-.6h-5.4l-2.7-5.4c-.3-.7-1.4-.7-1.8 0L8.4 8H3c-.4 0-.8.2-.9.6-.2.4-.1.8.2 1.1l4.6 4.6L5 20.7c-.1.4 0 .8.4 1.1.3.2.8.3 1.1 0l5.4-3.6 5.4 3.6c.2.1.4.2.6.2.2 0 .4-.1.6-.2.3-.2.5-.7.4-1.1l-1.8-6.4 4.6-4.6c.3-.3.4-.7.2-1.1z">
                                                    </path>
                                                </svg>
                                                <div class="rating_bar">
                                                    <span class="rating_bar_2"></span>
                                                </div>
                                                <span class="rating_value"><?= $global_2_count ?></span>
                                            </li>
                                            <li data-testid="star-1" class="rating_li">
                                                <span class="rating_placeholder">1</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    enable-background="new 0 0 24 24" fill="#FFA90D"
                                                    class="star">
                                                    <path
                                                        d="M21.9 8.6c-.1-.4-.5-.6-.9-.6h-5.4l-2.7-5.4c-.3-.7-1.4-.7-1.8 0L8.4 8H3c-.4 0-.8.2-.9.6-.2.4-.1.8.2 1.1l4.6 4.6L5 20.7c-.1.4 0 .8.4 1.1.3.2.8.3 1.1 0l5.4-3.6 5.4 3.6c.2.1.4.2.6.2.2 0 .4-.1.6-.2.3-.2.5-.7.4-1.1l-1.8-6.4 4.6-4.6c.3-.3.4-.7.2-1.1z">
                                                    </path>
                                                </svg>
                                                <div class="rating_bar">
                                                    <span class="rating_bar_1"></span>
                                                </div>
                                                <span class="rating_value"><?= $global_1_count ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="leave_opinion_section">
                                    <div class="leave_opinion">
                                        <div class="leave_opinion_title"><?= $lang['leave_opinion'] ?></div>
                                        <form method="GET" action="rate_smartphone.php">
                                            <input type="hidden" value="<?= $smartphone['id'] ?>" name="id">
                                            <button type="submit" class="leave_opinion_button"><?= $lang['add_opinion'] ?></button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="opinions_list">
                                <h2><?= $lang['opinions'] ?></h2>
                                <!--List Opinions-->
                                <?php include 'php/list_smartphone_opinions.php' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button id="darkmode-btn" onclick="toggleColorScheme()"><i class="fas fa-sun fa-2x" id="btn-icon"></i></button>
    </div>
    <script src="js/browser.js"></script>
    <script src="js/mobile_navbar.js"></script>
    <?php 
        if(isset($_SESSION['id'])){
            echo '<script src="js/cart.js"></script>';
        }
        $conn->close();
    ?>
    <script src="js/browser.js"></script>
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