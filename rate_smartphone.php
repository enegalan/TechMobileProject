<?php
include 'lang/detect_lang.php';
if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
    session_start();
}
if (isset($_SESSION['id']) && isset($_GET['id']) && !empty($_GET['id'])) {
    include 'php/conn.php';
    $smartphone_id = $_GET['id'];
    $query = $conn->prepare("SELECT S.id, S.title, S.subtitle1, S.subtitle2, S.image_count, S.manufacturer_id, M.name AS manufacturer_name, S.price, S.description, S.width, S.height, S.thick, S.weight, S.display, S.chip, S.camera, S.os, S.storage, S.colors, S.thumbnail_name, S.model FROM smartphones S INNER JOIN manufacturers M ON S.manufacturer_id = M.id WHERE S.id = ? LIMIT 1");
    $query->bind_param('i', $smartphone_id);
    $query->execute();
    $res = $query->get_result();
    $smartphone = $res->fetch_assoc();
} else {
    header('location: index.php');
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $smartphone['title'] ?> | TechMobile | Eneko Galan</title>
    <link rel="stylesheet" type="text/css" href="productos/style-productos.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="js/main.js"></script>
    <script src="js/userModal.js"></script>
    <link rel="stylesheet" type="text/css" href="css/ratingStars.css" />
    <link rel="stylesheet" type="text/css" href="css/rateSmartphones.css" />
    <link rel="stylesheet" href="css/toast.css">
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
                            <?php include 'components/header_user_dropdown.php';?>
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
    <?php include 'components/mobile_navbar.php';?>
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
    <?php include 'components/waves_footer.php'?>

    <nav class="breadcrumbs">
    <a href="index.php" class="breadcrumbs__item"><?= $lang['home'] ?></a>
        <a href="catalogo.php" class="breadcrumbs__item"><?= $lang['catalogue'] ?></a>
        <?= "<a href='manufacturer.php?id=" . $smartphone['manufacturer_id'] . "' class='breadcrumbs__item'>" . ucfirst($smartphone['manufacturer_name']) . "</a>"; ?>
        <?= "<a id='smartphone-href' href='smartphone.php?id=" . $smartphone['id'] . "&color=" . explode(',', $smartphone['colors'])[0] . "' class='breadcrumbs__item'>" . $smartphone['title'] . "</a>"; ?>
        <?= "<a class='breadcrumbs__item is-active'>" . $lang['rate_product'] . "</a>"; ?>
    </nav>

    <div id="rateSmartphoneContent" class="wpb_row vc_row-fluid vc_row standard_section"
        data-product-id="<?= $smartphone['id']; ?>">
        <div class="centrado_articulo">
            <div class="rateSmartphoneParent">
                <div>
                    <h2><?= $lang['rate_product'] ?></h2>
                    <p><?= $lang['welcome_rating'] ?></p>
                </div>
                <div class="rateSmartphoneBody">
                    <div class="rate_smartphone_preview">
                        <img src="productos/<?=$smartphone['manufacturer_name']?>/img/catalogo/<?=$smartphone['thumbnail_name']?>.png">
                        <div>
                            <h5 style="font-weight:normal;"><?=$smartphone['title']?></h5>
                            <h5><b><?=$smartphone['price']?>€</b></h5>
                        </div>
                    </div>
                    <div class="rate_stepper">
                        <div class="rate_step" id="step1">
                            <div class="rate_step_block">
                                <div data-id="1" class="rate_step_block_number active">
                                    <span class="rate_step_block_number_span">1</span>
                                </div>
                                <div class="rate_step_block_name">
                                    <span class="rate_step_block_name_span"><?= $lang['step'] ?> 1 <?= $lang['of'] ?> 4</span>
                                    <span class="rate_step_block_name_span_responsive"><?= $lang['general'] ?>*</span>
                                </div>
                            </div>
                            <div class="rate_step_line"></div>
                        </div>
                        <div class="rate_step" id="step2">
                            <div class="rate_step_block">
                                <div data-id="2" class="rate_step_block_number">
                                    <span class="rate_step_block_number_span">2</span>
                                </div>
                                <div class="rate_step_block_name">
                                    <span class="rate_step_block_name_span"><?= $lang['step'] ?> 2 <?= $lang['of'] ?> 4</span>
                                    <span class="rate_step_block_name_span_responsive"><?= $lang['opinion'] ?>*</span>
                                </div>
                            </div>
                            <div class="rate_step_line"></div>
                        </div>
                        <div class="rate_step" id="step3">
                            <div class="rate_step_block">
                                <div data-id="3" class="rate_step_block_number">
                                    <span class="rate_step_block_number_span">3</span>
                                </div>
                                <div class="rate_step_block_name">
                                    <span class="rate_step_block_name_span"><?= $lang['step'] ?> 3 <?= $lang['of'] ?> 3</span>
                                    <span class="rate_step_block_name_span_responsive"><?= $lang['images'] ?></span>
                                </div>
                            </div>
                            <div class="rate_step_line"></div>
                        </div>
                    </div>
                    <div class="rate_content">
                        <!--Change content visibility via JS-->
                        <div id="rate_general">
                            <div class="general_rating">
                                <h3><?= $lang['general_rating'] ?>*</h3>
                                <fieldset class="block_rating__stars">
                                    <input type="radio" id="star5" name="rating" value="5" />
                                    <label class="full" for="star5"
                                        title="<?= $lang['incredible'] ?> - 5 <?= $lang['stars'] ?>"></label>
                                    <input type="radio" id="star4half" name="rating" value="4.5" />
                                    <label class="half" for="star4half"
                                        title="<?= $lang['very_good'] ?> - 4.5 <?= $lang['stars'] ?>"></label>
                                    <input type="radio" id="star4" name="rating" value="4" />
                                    <label class="full" for="star4" title="<?= $lang['good'] ?> - 4 <?= $lang['stars'] ?>"></label>
                                    <input type="radio" id="star3half" name="rating" value="3.5" />
                                    <label class="half" for="star3half"
                                        title="<?= $lang['less_than_media'] ?> - 3.5 <?= $lang['stars'] ?>"></label>
                                    <input type="radio" id="star3" name="rating" value="3" />
                                    <label class="full" for="star3" title="<?= $lang['average'] ?> - 3 <?= $lang['stars'] ?>"></label>
                                    <input type="radio" id="star2half" name="rating" value="2.5" />
                                    <label class="half" for="star2half"
                                        title="Meh - 2.5 <?= $lang['stars'] ?>"></label>
                                    <input type="radio" id="star2" name="rating" value="2" />
                                    <label class="full" for="star2" title="<?= $lang['bad'] ?> - 2 <?= $lang['stars'] ?>"></label>
                                    <input type="radio" id="star1half" name="rating" value="1.5" />
                                    <label class="half" for="star1half"
                                        title="<?= $lang['very_bad'] ?> - 1.5 <?= $lang['stars'] ?>"></label>
                                    <input type="radio" id="star1" name="rating" value="1" />
                                    <label class="full" for="star1" title="<?= $lang['fatal'] ?> - 1 <?= $lang['star'] ?>"></label>
                                    <input type="radio" id="starhalf" name="rating" value="0.5" />
                                    <label class="half" for="starhalf"
                                        title="<?= $lang['rubbish'] ?> - 0.5 <?= $lang['stars'] ?>"></label>
                                </fieldset>
                            </div>
                            <div class="rate_recommend">
                                <h3><?= $lang['would_you_recommend'] ?><h3>
                                <input type="radio" value="1" name="recommended" id="recommended">
                                <label for="recommended"><?= $lang['yes'] ?></label>

                                <input type="radio" value="0" name="recommended" id="not_recommended">
                                <label for="not_recommended"><?= $lang['no'] ?></label>
                            </div>
                        </div>
                        <div id="opinion">
                            <div>
                                <h3><?= $lang['add_opinion'] ?>*</h3>
                                <p><?= $lang['write_what_you_think'] ?></p>
                                <textarea name="opinion" required placeholder="<?= $lang['add_opinion'] ?>*"></textarea>
                            </div>
                            <div>
                                <textarea name="advantages" placeholder="<?= $lang['advantages'] ?> (<?= $lang['optional'] ?>)"></textarea>
                                <textarea name="disadvantages" placeholder="<?= $lang['disadvantages'] ?> (<?= $lang['optional'] ?>)"></textarea>
                            </div>
                        </div>
                        <div id="images">
                            <div>
                                <h3><?= $lang['add_images'] ?> (<?= $lang['optional'] ?>)</h3>
                                <p><?= $lang['add_images_subtitle'] ?></p>
                                <div class="upload_textarea">
                                    <form method="post" action="" enctype="multipart/form-data" novalidate class="box upload_textarea_content">
                                        <div class="box__input">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="80px" height="47px" viewBox="0 0 79 47" version="1.1" fill="#CCCCCC" class="upload_textarea_svg"><g id="surface1"><path d="M 69.097656 24.796875 C 68.457031 11.019531 56.570312 0 42.050781 0 C 29.207031 0 17.796875 8.4375 15.054688 19.789062 L 13.988281 19.789062 C 6.277344 19.789062 0 25.890625 0 33.390625 C 0 41.019531 5.964844 46.996094 13.578125 46.996094 L 67.890625 46.996094 C 74.121094 46.996094 79 42.109375 79 35.867188 C 79 30.035156 74.738281 25.382812 69.097656 24.796875 Z M 67.890625 44.523438 L 13.578125 44.523438 C 7.347656 44.523438 2.46875 39.632812 2.46875 33.390625 C 2.46875 27.253906 7.636719 22.261719 13.988281 22.261719 L 17.0625 22.261719 L 17.257812 21.261719 C 19.335938 10.550781 29.992188 2.472656 42.050781 2.472656 C 55.617188 2.472656 66.65625 13.015625 66.65625 25.972656 L 66.65625 27.207031 L 67.890625 27.207031 C 72.734375 27.207031 76.53125 31.011719 76.53125 35.867188 C 76.53125 40.71875 72.734375 44.523438 67.890625 44.523438 Z M 67.890625 44.523438 "></path><path d="M 38.625 14.839844 L 28.75 24.914062 L 30.496094 26.757812 L 38.265625 19.0625 L 38.265625 40.8125 L 40.734375 40.8125 L 40.734375 19.0625 L 48.5 26.847656 L 50.246094 24.914062 L 40.371094 14.839844 Z M 38.625 14.839844 "></path></g></svg>
                                            <input type="file" name="files[]" id="file" class="box__file" accept="image/png, image/jpg, image/jpeg, video/*" data-multiple-caption="{count} files selected" multiple />
                                            <label for="file"><strong><?= $lang['drag_files'] ?></strong><span class="box__dragndrop"> <?= $lang['or_click_here'] ?></span>.</label>
                                            <button type="submit" id="#add-image-button" class="box__button"><?= $lang['upload'] ?></button>
                                            <div class="upload_textarea_separator"></div>
                                            <div class="upload_textarea_info">
                                                <span>
                                                    <p><?= $lang['allowed_image_formats'] ?>: JPEG, JPG <?= strtolower($lang['and']) ?> PNG</p>
                                                    <p><?= $lang['max'] ?> 10 <?= ($lang['images']) ?></p>
                                                </span>
                                            </div>
                                        </div>
    
    
                                        <div class="box__uploading"><?= $lang['uploading'] ?>&hellip;</div>
                                        <div class="box__success"><?= $lang['done'] ?>! <a href="#0" class="box__restart" role="button"><?= $lang['upload_more'] ?></a></div>
                                        <div class="box__error"><?= $lang['error'] ?>! <span></span>. <a href="#0" class="box__restart" role="button"><?= $lang['try_again'] ?></a></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rate_controllers">
                    <button class="rate_next_button" value=""><?= $lang['next'] ?></button>
                    <button class="rate_finish_button" value=""><?= $lang['publish_rating'] ?></button>
                    <button class="rate_previous_button" value=""><?= $lang['previous'] ?></button>
                </div>
            </div>
        </div>
        <button id="darkmode-btn" onclick="toggleColorScheme()"><i class="fas fa-sun fa-2x" id="btn-icon"></i></button>
    </div>
    <script src="js/toast.js"></script>
    <script src="js/rate_smartphone.js"></script>
    <script src="js/browser.js"></script>
    <script src="js/mobile_navbar.js"></script>
    <?php
    if (isset($_SESSION['id'])) {
        echo '<script src="js/cart.js"></script>';
    }
    $conn->close();
    ?>
    <script src="js/browser.js"></script>
	<script src="js/auth.js"></script>
    <script src="js/drag_and_drop_input.js"></script>
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