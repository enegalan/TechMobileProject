﻿<?php 
    //Get Smartphone data via GET ?id and ?color
    if(isset($_GET['id']) && isset($_GET['color'])){
        include 'php/conn.php';
        $id = $_GET['id'];
        $color = $_GET['color'];
        $query1 = $conn->prepare("SELECT S.id, S.title, S.subtitle1, S.subtitle2, S.image_count, S.manufacturer_id, M.name AS manufacturer_name, S.price, S.description, S.rating, S.width, S.height, S.thick, S.weight, S.display, S.chip, S.camera, S.os, S.storage, S.colors, S.thumbnail_name, S.model FROM smartphones S INNER JOIN manufacturers M ON S.manufacturer_id = M.id WHERE S.id = ? LIMIT 1");
        $query1->bind_param("i",$id);
        $query1->execute();
        $res = $query1->get_result();
        $rows = $res->num_rows;
        for($i = 0; $i < $rows; $i++){
            $smartphone = $res->fetch_assoc();
        }
    }else{
        header('location: catalogo.php');
    }
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title><?php echo $smartphone['title']?> | TechMobile | Eneko Galan</title>
    <link rel="stylesheet" type="text/css" href="productos/style-productos.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="productos/scripts-productos.js"></script>
    <script src="productos/redirect.js"></script>
    <script src="js/main.js"></script>
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

    <nav class="breadcrumbs">
        <a href="index.php" class="breadcrumbs__item">Inicio</a>
        <a href="catalogo.php" class="breadcrumbs__item">Catálogo</a>
        <?php echo "<a href='manufacturer.php?id=" . $smartphone['manufacturer_id'] . "' class='breadcrumbs__item'>" . ucfirst($smartphone['manufacturer_name']) . "</a>";?>
        <?php echo "<a class='breadcrumbs__item is-active'>" . $smartphone['title'] . "</a>";?>
    </nav>

    <div id="contenidoprincipal" class="wpb_row vc_row-fluid vc_row standard_section"
        data-product-id="<?php echo $id;?>">
        <div class="centrado_articulo">
            <div id="articulo" class="<?php echo $smartphone['thumbnail_name'];?>">
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
                                            <span class="block_specification__text">especificaciones</span>
                                        </div>
                                        <div class="block_specification__informationShow hide">
                                            <i class="fa fa-info-circle block_specification__button block_specification__button__jump"
                                                aria-hidden="true"></i>
                                            <span class="block_specification__text">información</span>
                                        </div>
                                    </div>

                                    <div class="block_product">
                                        <h2 class="block_name block_name__mainName"><span
                                                class="smartphone_main_title"><?php echo $smartphone['title'];?></span><sup>&reg;
                                            </sup></h2>
                                        <h2 class="block_name block_name__addName">
                                            <?php echo $smartphone['subtitle1']; ?></h2>

                                        <p class="block_product__advantagesProduct">
                                            <?php echo $smartphone['subtitle2'];?>
                                        </p>

                                        <div class="block_informationAboutDevice">

                                            <div
                                                class="block_descriptionCharacteristic block_descriptionCharacteristic__disActive">
                                                <table class="block_specificationInformation_table">
                                                    <tr>
                                                        <th>Características</th>
                                                        <th>Valor</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Color</td>
                                                        <td><?php echo ucfirst($color); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alto</td>
                                                        <td><?php echo $smartphone['width'];?>cm</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ancho</td>
                                                        <td><?php echo $smartphone['height'];?>cm</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Grosor</td>
                                                        <td><?php echo $smartphone['thick'];?>cm</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Peso</td>
                                                        <td><?php echo $smartphone['weight'];?>g</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pantalla</td>
                                                        <td><?php echo $smartphone['display'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Chip</td>
                                                        <td><?php echo $smartphone['chip'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cámara</td>
                                                        <td><?php echo $smartphone['camera'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sistema operativo</td>
                                                        <td><?php echo $smartphone['os'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Almacenamiento</td>
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
                                                    <?php echo $smartphone['description']; ?>
                                                </span>
                                            </div>

                                            <div class="block_rating clearfix">
                                                <fieldset class="block_rating__stars"
                                                    smartphone-id="<?php echo $smartphone['id']; ?>">
                                                    <input type="radio" id="star5" name="rating" value="5" />
                                                    <label class="full" for="star5"
                                                        title="Increíble - 5 estrellas"></label>
                                                    <input type="radio" id="star4half" name="rating" value="4.5" />
                                                    <label class="half" for="star4half"
                                                        title="Muy bien - 4.5 estrellas"></label>
                                                    <input type="radio" id="star4" name="rating" value="4" />
                                                    <label class="full" for="star4" title="Bien - 4 estrellas"></label>
                                                    <input type="radio" id="star3half" name="rating" value="3.5" />
                                                    <label class="half" for="star3half"
                                                        title="Por debajo de la media - 3.5 estrellas"></label>
                                                    <input type="radio" id="star3" name="rating" value="3" />
                                                    <label class="full" for="star3" title="Average - 3 stars"></label>
                                                    <input type="radio" id="star2half" name="rating" value="2.5" />
                                                    <label class="half" for="star2half"
                                                        title="Meh - 2.5 estrellas"></label>
                                                    <input type="radio" id="star2" name="rating" value="2" />
                                                    <label class="full" for="star2" title="Mal - 2 stars"></label>
                                                    <input type="radio" id="star1half" name="rating" value="1.5" />
                                                    <label class="half" for="star1half"
                                                        title="Muy mal - 1.5 estrellas"></label>
                                                    <input type="radio" id="star1" name="rating" value="1" />
                                                    <label class="full" for="star1" title="Fatal - 1 star"></label>
                                                    <input type="radio" id="starhalf" name="rating" value="0.5" />
                                                    <label class="half" for="starhalf"
                                                        title="Una porquería - 0.5 estrellas"></label>
                                                </fieldset>
                                                <span
                                                    class="block_rating__avarage"><?php echo $smartphone['rating'];?></span>
                                            </div>
                                            <div class="row">
                                                <div class="large-6 small-12 column left-align">
                                                    <div class="block_price">
                                                        <p class="block_price__currency">
                                                            <?php echo $smartphone['price'];?>€</p>
                                                        <p class="block_price__shipping">Mas gastos de envío</p>
                                                    </div>
                                                    <div class="block_quantity clearfix">
                                                        <span class="text_specification">Cantidad</span>
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
                                                        <span class="text_specification">Elige el color:</span>
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
                                                                    echo '<label onclick="redireccionarColor(\'' . strtolower($color) . '\', \'' . strtolower($colors[$i]) . '\')" title="' . ucfirst($colors[$i]) . '" for="radioColor' . ($i + 1) . '" class="block_goodColor__radio block_goodColor__' . $colors[$i] . '"></label>';
                                                                }
                                                                $conn->close();
                                                                $query->close();
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <button id="addToCart" class="button button_addToCard">Añadir al
                                                        carrito</button>
                                                </div>
                                            </div>
                                            <ul class="blogpost-navigation">
                                                <li class="next">
                                                    <a href="productos/apple/iphone11.html" class="btn btn-default">
                                                        <span>
                                                            <strong>IPhone 11</strong><br>
                                                        </span>
                                                        <img src="productos/apple/img/catalogo/iphone11.png" width="100"
                                                            alt="IPhone11">
                                                        <i class="fa fa-angle-right fa-lg fa-navigationblock"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                </li>
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
                                            <div value="4.9" class="rating_avg_value"></div>
                                            <div class="rating_stars_section">
                                                <div fill="#FFA90D" class="opinion_stars_background">
                                                    <div fill="#FFA90D" data-testid="percent-bar" id="rating_avg_stars" value="4.9" class="opinion_stars"></div>
                                                </div>
                                            </div>
                                            <span value="157" class="opinions_value"> Opiniones</span>
                                        </div>
                                    </div>
                                    <div class="report_card">
                                        <div class="opinion_card_content">
                                            <div value="72" class="recommended_percentage_value">%</div>
                                            <span class="recommended_title">Recomiendan</span>
                                            <span value="113" class="recommended_value"></span>
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
                                                </svg>
                                                <div class="rating_bar">
                                                    <span class="rating_bar_5"></span>
                                                </div>
                                                <span class="rating_value">149</span>
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
                                                <span class="rating_value">7</span>
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
                                                </div><span class="rating_value">0</span>
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
                                                <span class="rating_value">0</span>
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
                                                <span class="rating_value">1</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="leave_opinion_section">
                                    <div class="leave_opinion">
                                        <div class="leave_opinion_title">Leave your opinion</div>
                                        <button class="leave_opinion_button">Add opinion</button>
                                    </div>
                                </div>
                            </div>

                            <div class="opinions_list">
                                <h3>Opinions</h3>
                                <!--List Opinions-->
                                <?php include 'php/list_smartphone_opinions.php' ?>
                            </div>
                        </div>
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