<?php
include 'lang/detect_lang.php';
if (session_status() !== PHP_SESSION_ACTIVE && !headers_sent()) {
    session_start();
}
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $is_admin = $_SESSION['is_admin'] ?? false;
    $username = $_SESSION['username'] ?? '';
    $email = $_SESSION['email'] ?? '';
    $name = $_SESSION['name'] ?? '';
    $surname = $_SESSION['surname'] ?? '';
    $birthdate = $_SESSION['birthdate'] ?? '';
    $sex = $_SESSION['sex'] ?? '';
    $about = $_SESSION['about'] ?? '';
    $gravatar = $_SESSION['gravatar'];
    $password = $_SESSION['password'] ;
    $country = $_SESSION['country'] ?? '';
    $city = $_SESSION['city'] ?? '';
    $province = $_SESSION['province'] ?? '';
    $phone = $_SESSION['phone'] ?? '';
    $website = $_SESSION['website'] ?? '';
    $facebook = $_SESSION['facebook'] ?? '';
    $twitter = $_SESSION['twitter'] ?? '';
    $instagram = $_SESSION['instagram'] ?? '';
    $github = $_SESSION['github'] ?? '';
    $address1 = $_SESSION['address1'] ?? '';
    $address2 = $_SESSION['address2'] ?? '';
    $zip = $_SESSION['zip'] ?? '';
}else{
    header('location: index.php');
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang['profile'] ?> | TechMobile | Eneko Galan</title>
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/scroll.css" />
    <link rel="stylesheet" type="text/css" href="css/profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css">
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

    <div id="contenidoprincipal profile" class="wpb_row vc_row-fluid vc_row standard_section greyBx">
        <div class="profile-form">
            <div class="user-left-panel">
                <!--User Card (Gravatar, username, country, city, birthdate & about)-->
                <div class="user-card">
                    <!--User Gravatar-->
                    <div class="user-gravatar">
                        <img class="user-gravatar-img" src="<?= $gravatar; ?>" alt="userGravatar">
                        <!--Edit User Gravatar-->
                        <div class="edit-gravatar">
                            <i class="fa-solid fa-edit"></i>
                            <div class="edit-gravatar-modal">
                                <div class="row">
                                    <h3><?= $lang['upload_your_profile_image'] ?></h3>
                                    <span class="edit-gravatar-modal-close"><i class="fa-solid fa-x"></i></span>
                                </div>
                                <form action="php/uploadGravatar.php" method="POST" enctype="multipart/form-data">
                                    <input type="file" name="gravatar">
                                    <button type="submit" class="btn btn-primary"><?= $lang['upload'] ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h5 id="username">
                        <?= $username; ?>
                    </h5>
                    <div class="info-localization">
                        <?php if(trim($country) !== ""){ ?>
                            <span id="country">
                                <?= $country; ?>
                            </span>
                        <?php }?>
                        <?php if(trim($city) !== ""){ ?>
                            <span>,ㅤ</span>
                            <span id="city">
                                <?= $city; ?>
                            </span>
                        <?php }?>
                    </div>
                    <div class="info-birthdate">
                        <span id="birthdate">
                            <?= $birthdate ?>
                        </span>
                    </div>
                    <div class="info-about">
                        <?= $about; ?>
                    </div>
                </div>
                <!--User Social-->
                <?php if(trim($website) !== "" && trim($facebook) !== "" && trim($twitter) !== "" && trim($instagram) !== "" && trim($github) !== ""){ ?>
                    <div class="user-social">
                        <ul class="social-list">
                            <?php if(trim($website) !== ""){ ?>
                                <li class="social-row">
                                    <i class="fa-solid fa-globe"></i>
                                    <span class="social-text">
                                        <?= $website; ?>
                                    </span>
                                </li>
                            <?php }?>
                            <?php if(trim($facebook) !== ""){ ?>
                                <li class="social-row">
                                    <i class="fa-brands fa-facebook-f"></i>
                                    <span class="social-text">
                                        <?= $facebook; ?>
                                    </span>
                                </li>
                            <?php }?>
                            <?php if(trim($twitter) !== ""){ ?>
                                <li class="social-row">
                                    <i class="fa-brands fa-twitter"></i>
                                    <span class="social-text">
                                        <?= $twitter; ?>
                                    </span>
                                </li>
                            <?php }?>
                            <?php if(trim($instagram) !== ""){ ?>
                                <li class="social-row">
                                    <i class="fa-brands fa-instagram"></i>
                                    <span class="social-text">
                                        <?= $instagram; ?>
                                    </span>
                                </li>
                            <?php }?>
                            <?php if(trim($github) !== ""){ ?>
                                <li class="social-row">
                                    <i class="fa-brands fa-github"></i>
                                    <span class="social-text">
                                        <?= $github; ?>
                                    </span>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                <?php }else{?>
                    <div></div>
                <?php }?>
            </div>
            <!--User Information-->
            <div class="user-info">
                <div class="row">
                    <span><?= $lang['name'] ?></span>
                    <input type="text" name="name" id="name" value="<?= $name; ?>" disabled>
                </div>
                <div class="row">
                    <span><?= $lang['surname'] ?></span>
                    <input type="text" name="surname" id="surname" value="<?= $surname; ?>" disabled>
                </div>
                <div class="row">
                    <span><?= $lang['email'] ?></span>
                    <input type="text" name="email" id="email" value="<?= $email; ?>" disabled>
                </div>
                <div class="row">
                    <span><?= $lang['phone'] ?></span>
                    <input type="text" name="phone" id="phone" value="<?= $phone; ?>" disabled>
                </div>
                <div class="row">
                    <span><?= $lang['address1'] ?></span>
                    <input type="text" name="address1" id="address1" value="<?= $address1; ?>" disabled>
                </div>
                <div class="row">
                    <span><?= $lang['address2'] ?></span>
                    <input type="text" name="address2" id="address2" value="<?= $address2; ?>" disabled>
                </div>
                <div class="row">
                    <span><?= $lang['city'] ?></span>
                    <input type="text" name="city" id="city" value="<?= $city; ?>" disabled>
                </div>
                <div class="row">
                    <span><?= $lang['province'] ?></span>
                    <input type="text" name="province" id="province" value="<?= $province; ?>" disabled>
                </div>
                <div class="row">
                    <span><?= $lang['zip'] ?></span>
                    <input type="text" name="zip" id="zip" value="<?= $zip; ?>" disabled>
                </div>
                <div class="row">
                    <span><?= $lang['country'] ?></span>
                    <input type="text" name="country" id="country" value="<?= $country; ?>" disabled>
                </div>
            </div>
            <!--User Dashboard-->
            <div class="user-dashboard">
                <div class="container">
                    <div class="nav-area">
                        <ul class="nav-tabs" id="myTab" role="tablist" data-bs-toggle="tab">
                            <li class="nav-item user-dashboard-nav-li">
                                <!--Nav Tab Background-->
                                <?php include 'components/nav_tab_background.php'; ?>
                                <!---->
                                <a class="nav-link user-dashboard-nav-a active show" id="dashboard-link"
                                    data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard"
                                    aria-selected="true"><i class="fas fa-tachometer-alt" aria-hidden="true"></i>
                                    <span><?= $lang['dashboard'] ?></span></a>
                            </li>
                            <li class="nav-item user-dashboard-nav-li">
                                <!--Nav Tab Background-->
                                <?php include 'components/nav_tab_background.php'; ?>
                                <!---->
                                <a class="nav-link user-dashboard-nav-a" id="my-order" data-toggle="tab"
                                    href="#my-orders" role="tab" aria-controls="my-orders" aria-selected="false"><i
                                        class="fas fa-file-invoice"></i>
                                    <span><?= $lang['orders'] ?></span></a>
                            </li>
                            <li class="nav-item user-dashboard-nav-li">
                                <!--Nav Tab Background-->
                                <?php include 'components/nav_tab_background.php'; ?>
                                <!---->
                                <a class="nav-link user-dashboard-nav-a" id="myopinion" data-toggle="tab"
                                    href="#my-opinions" role="tab" aria-controls="my-opinions" aria-selected="false"><i
                                        class="fas fa-comment-dots"></i>
                                    <span><?= $lang['opinions'] ?></span></a>
                            </li>
                            <li class="nav-item user-dashboard-nav-li">
                                <!--Nav Tab Background-->
                                <?php include 'components/nav_tab_background.php'; ?>
                                <!---->
                                <a class="nav-link user-dashboard-nav-a" id="mycard" data-toggle="tab" href="#mycards"
                                    role="tab" aria-controls="mycards" aria-selected="false"><i
                                        class="fas fa-credit-card"></i>
                                    <span><?= $lang['cards'] ?></span></a>
                            </li>
                            <li class="nav-item user-dashboard-nav-li">
                                <!--Nav Tab Background-->
                                <?php include 'components/nav_tab_background.php'; ?>
                                <!---->
                                <a class="nav-link user-dashboard-nav-a" id="my-address" data-toggle="tab"
                                    href="#address" role="tab" aria-controls="address" aria-selected="false"><i
                                        class="fas fa-map-marker-alt"></i>
                                    <span><?= $lang['addresses'] ?></span></a>
                            </li>
                            <li class="nav-item user-dashboard-nav-li">
                                <!--Nav Tab Background-->
                                <?php include 'components/nav_tab_background.php'; ?>
                                <!---->
                                <a class="nav-link user-dashboard-nav-a" id="account-detail" data-toggle="tab"
                                    href="#account-details" role="tab" aria-controls="account-details"
                                    aria-selected="false"><i class="fas fa-user-alt"></i> 
                                    <span><?= $lang['account_details'] ?></span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tabs Content start -->
                <div class="tabs tg-tabs-content-wrapp">
                    <div class="container">
                        <div class="inner">
                            <div class="tab-content" id="myTabContent">
                                <!--Dashboard-->
                                <div class="tab-pane fade show active" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-link">
                                    <div class="my-account-dashboard">
                                        <div class="inner">
                                            <div class="row">
                                                <!--Orders Card-->
                                                <div class="col-md-4 mb-3">
                                                    <div class="card" data-target="#my-orders" area-toggle="my-order">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <a><img
                                                                        src="images/icons/orders.png"></a>
                                                            </div>
                                                            <h2><?= $lang['orders'] ?></h2>
                                                            <p><?= $lang['check_out_orders_status'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Opinions Card-->
                                                <div class="col-md-4 mb-3">
                                                    <div class="card" data-target="#my-opinions" area-toggle="my-opinion">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <a><img
                                                                        src="images/icons/opinions.png"></a>
                                                            </div>
                                                            <h2><?= $lang['opinions'] ?></h2>
                                                            <p><?= $lang['check_out_opinions_and_reply'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Addresses Card-->
                                                <div class="col-md-4 mb-3">
                                                    <div class="card" data-target="#address" area-toggle="my-address">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <a><img
                                                                        src="images/icons/addresses.png"></a>
                                                            </div>
                                                            <h2><?= $lang['addresses'] ?></h2>
                                                            <p><?= $lang['add_edit_or_remove_addresses'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Cards Card -->
                                                <div class="col-md-4 mb-3">
                                                    <div class="card" data-target="#mycards" area-toggle="mycards">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <a><img
                                                                        src="images/icons/cards.png"></a>
                                                            </div>
                                                            <h2><?= $lang['cards'] ?></h2>
                                                            <p><?= $lang['add_edit_or_remove_cards'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Account Details Card-->
                                                <div class="col-md-4 mb-3">
                                                    <div class="card" data-target="#account-details"
                                                        area-toggle="account-detail">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <a><img
                                                                        src="images/icons/details.png"></a>
                                                            </div>
                                                            <h2><?= $lang['account_details'] ?></h2>
                                                            <p><?= $lang['edit_your_account_adding_more_info'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--My Orders-->
                                <div class="tab-pane fade" id="my-orders" role="tabpanel" aria-labelledby="my-order">
                                    <table id="my-orders-table"
                                        class="table table-striped table-bordered dt-responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th><?= $lang['order'] ?></th>
                                                <th><?= $lang['date'] ?></th>
                                                <th><?= $lang['status'] ?></th>
                                                <th><?= $lang['total'] ?></th>
                                                <th class="action"><?= $lang['action'] ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#8083</td>
                                                <td>Sep 9, 2021</td>
                                                <td>Completed</td>
                                                <td>$350</td>
                                                <td class="action"><a href="#" class="view-order"><?= $lang['view_replies'] ?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#8283</td>
                                                <td>Sep 8, 2021</td>
                                                <td>Pending</td>
                                                <td>$190</td>
                                                <td class="action"><a href="#" class="view-order"><?= $lang['view_replies'] ?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#8483</td>
                                                <td>Sep 7, 2021</td>
                                                <td>Completed</td>
                                                <td>$399</td>
                                                <td class="action"><a href="#" class="view-order"><?= $lang['view_replies'] ?></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--My Addresses-->
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="my-address">
                                    <div class="address-form">
                                        <div class="inner">
                                            <form class="tg-form myaddresses-form" action="php/add_new_address.php"
                                                method="POST">
                                                <div class="my_addresses">
                                                    <div class="new_address">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </div>
                                                    <!--List default address-->
                                                    <?php include 'php/list_default_address.php'; ?>

                                                    <?php include 'php/list_my_addresses.php'; ?>
                                                </div>
                                                <div class="add_address">
                                                    <div class="row address-header">
                                                        <h3><?= $lang['add_new_address'] ?></h3>
                                                        <span class="close_add_address"><i
                                                                class="fa-solid fa-x"></i></span>
                                                    </div>
                                                    <div class="row">
                                                        <div>
                                                            <label for="name"><?= $lang['name'] ?></label>
                                                            <input type="text" name="name" id="name">
                                                        </div>
                                                        <div>
                                                            <label for="surname"><?= $lang['surname'] ?></label>
                                                            <input type="text" name="surname" id="surname">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div>
                                                            <label for="address1"><?= $lang['address1'] ?></label>
                                                            <input type="text" name="address1" id="address1">
                                                        </div>
                                                        <div>
                                                            <label for="address2"><?= $lang['address2'] ?></label>
                                                            <input type="text" name="address2" id="address2">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div>
                                                            <label for="city"><?= $lang['city'] ?></label>
                                                            <input type="text" name="city" id="city">
                                                        </div>
                                                        <div>
                                                            <label for="province"><?= $lang['province'] ?></label>
                                                            <input type="text" name="province" id="province">
                                                        </div>
                                                        <div>
                                                            <label for="zip"><?= $lang['zip'] ?></label>
                                                            <input type="text" name="zip" id="zip">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div>
                                                            <label for="country"><?= $lang['country'] ?></label>
                                                            <input type="text" name="country" id="country">
                                                        </div>
                                                        <div>
                                                            <label for="phone"><?= $lang['phone'] ?></label>
                                                            <input type="text" name="phone" id="phone">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label for="default"><?= $lang['change_to_default_address'] ?></label>
                                                        <input type="checkbox" name="default" id="default">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary"><?= $lang['add'] ?></button>
                                                </div>
                                            </form>
                                            <div class="edit_address">
                                                <div class="row address-header">
                                                    <h3><?= $lang['edit_address'] ?></h3>
                                                    <span class="close_edit_address"><i
                                                            class="fa-solid fa-x"></i></span>
                                                </div>
                                                <div class="editing_address_info">
                                                    <!--List the information of the selected address via Ajax-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Account Details-->
                                <div class="tab-pane fade" id="account-details" role="tabpanel"
                                    aria-labelledby="account-detail">
                                    <div class="account-detail-form">
                                        <div class="inner">
                                            <form class="tg-form account_details" action="php/updateProfile.php"
                                                method="POST">
                                                <div class="form-col">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputfname"><?= $lang['name'] ?></label>
                                                            <input type="text" name="name" class="form-control"
                                                                id="inputfname" placeholder="<?= $lang['name'] ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputlname"><?= $lang['surname'] ?></label>
                                                            <input name="surname" type="text" class="form-control"
                                                                id="inputlname" placeholder="<?= $lang['surname'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="inputusername"><?= $lang['username'] ?></label>
                                                            <input name="username" type="text" class="form-control"
                                                                id="inputusername" placeholder="<?= $lang['username'] ?>">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="inputphone"><?= $lang['phone'] ?></label>
                                                            <input name="phone" type="text" class="form-control"
                                                                id="inputphone" placeholder="<?= $lang['phone'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="inputEmail4"><?= $lang['email'] ?></label>
                                                            <input name="email" type="email" class="form-control"
                                                                id="inputEmail4" placeholder="<?= $lang['email'] ?>">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="inputbd"><?= $lang['birthdate'] ?></label>
                                                            <input name="birthdate" type="date" class="form-control"
                                                                id="inputbd" placeholder="MM/DD/YYYY">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="inputpassword"><?= $lang['password'] ?></label>
                                                            <input name="password" type="text" class="form-control"
                                                                id="inputpassword" placeholder="Password">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="confirm_password"><?= $lang['confirm_password'] ?></label>
                                                            <input name="confirm_password" type="text"
                                                                class="form-control" id="confirm_password"
                                                                placeholder="<?= $lang['confirm_password'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="about"><?= $lang['about_me'] ?></label>
                                                            <input type="text" placeholder="<?= $lang['i_am'] ?>..." name="about"
                                                                id="about">
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary"><?= $lang['update'] ?></button>
                                            </form>
                                        </div>
                                        <br><br><br>
                                        <div class="form-col">
                                            <form class="tg-form social-media" action="php/updateSocialMedia.php"
                                                method="POST">
                                                <h3><?= $lang['social_media'] ?></h3>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="website"><?= $lang['website'] ?></label>
                                                        <input type="text" name="website" class="form-control"
                                                            id="website" placeholder="www.<?= $lang['yourwebsite'] ?>.com">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="facebook">Facebook</label>
                                                        <input name="facebook" type="text" class="form-control"
                                                            id="facebook" placeholder="username">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="twitter">Twitter</label>
                                                        <input name="twitter" type="text" class="form-control"
                                                            id="twitter" placeholder="username">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="instagram">Instagram</label>
                                                        <input name="instagram" type="text" class="form-control"
                                                            id="instagram" placeholder="@username">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="github">GitHub</label>
                                                        <input name="github" type="text" class="form-control"
                                                            id="github" placeholder="username">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary"><?= $lang['update'] ?></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--My Cards-->
                            <div class="tab-pane fade" id="mycards" role="tabpanel" aria-labelledby="mycards">
                                <div class="account-detail-form">
                                    <div class="inner">
                                        <div class="my-cards">
                                            <section class="cards_list">
                                                <div class="row">
                                                    <h2><?= $lang['my_cards'] ?></h2>
                                                    <span id="add_card"><i class="fa-solid fa-plus"></i></span>
                                                </div>
                                                <div class="selected_card">

                                                </div>
                                                <div class="all_cards">
                                                    <!--List all cards-->
                                                    <?php include('php/list_all_cards.php'); ?>
                                                </div>
                                            </section>
                                            <section class="card_edit">
                                                <h2><?= $lang['edit_card'] ?></h2>
                                                <div class="row">

                                                    <div class="card_info_edit">
                                                        <!--List selected card information via Ajax-->
                                                    </div>
                                                    <div class="card_billing_address">
                                                        <h2><?= $lang['billing_address'] ?></h2>
                                                        <div class="billing_address">
                                                            <?php include 'php/list_default_address.php'; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card_options">
                                                    <div class="remove_card">
                                                        <a class="remove_card_a" href=""><?= $lang['remove_card'] ?></a>
                                                    </div>
                                                    <div class="other_options">
                                                        <button class="cancel_card_btn"><?= $lang['cancel'] ?></button>
                                                        <button class="save_card_btn"><?= $lang['save'] ?></button>
                                                    </div>
                                                </div>
                                            </section>
                                            <section>
                                                <div class="add_card_modal">
                                                    <div class="add_card_modal_info">
                                                        <h3><?= $lang['add_new_card'] ?></h3>
                                                        <span class="add_card_modal_close"><i class="fa-solid fa-x"></i></span>
                                                        <form method="POST" action="php/add_card.php">
                                                            <div class="card_info_add">
                                                                <div class="card_name">
                                                                    <span><b><?= $lang['card_name'] ?></b></span>
                                                                    <input type="text" name="card_name" id="card-name" minlength="5" maxlength="30" value="">
                                                                </div>
                                                                <div class="card_number">
                                                                    <span><b><?= $lang['card_number'] ?></b></span>
                                                                    <input type="text" name="card_number" id="card-number" minlength="11" maxlength="19" oninput="limitToNumbers(this)" value="">
                                                                </div>
                                                                <div class="card_cvv">
                                                                    <span><b><?= $lang['cvv'] ?></b></span>
                                                                    <input type="text" name="card_cvv" id="card-cvv" minlength="3" maxlength="3" oninput="limitToNumbers(this)" value="">
                                                                </div>
                                                                <div class="card_due_date">
                                                                    <span><b><?= $lang['due_date'] ?></b></span>
                                                                    <div class="row">
                                                                        <select id="card-due-month" name="card_due_month">
                                                                            <option value="01" selected>01</option>
                                                                            <option value="02">02</option>
                                                                            <option value="03">03</option>
                                                                            <option value="04">04</option>
                                                                            <option value="05">05</option>
                                                                            <option value="06">06</option>
                                                                            <option value="07">07</option>
                                                                            <option value="08">08</option>
                                                                            <option value="09">09</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>
                                                                        </select>
                                                                        <select id="card-due-year" name="card_due_year">
                                                                            <option value="2023" selected>2023</option>
                                                                            <option value="2024">2024</option>
                                                                            <option value="2025">2025</option>
                                                                            <option value="2026">2026</option>
                                                                            <option value="2027">2027</option>
                                                                            <option value="2028">2028</option>
                                                                            <option value="2029">2029</option>
                                                                            <option value="2030">2030</option>
                                                                            <option value="2031">2031</option>
                                                                            <option value="2032">2032</option>
                                                                            <option value="2033">2033</option>
                                                                            <option value="2034">2034</option>
                                                                            <option value="2035">2035</option>
                                                                            <option value="2036">2036</option>
                                                                            <option value="2037">2037</option>
                                                                            <option value="2038">2038</option>
                                                                            <option value="2039">2039</option>
                                                                            <option value="2040">2040</option>
                                                                            <option value="2041">2041</option>
                                                                            <option value="2042">2042</option>
                                                                            <option value="2043">2043</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <button class="btn btn-active"><?= $lang['add'] ?></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--My Opinions-->
                            <div class="tab-pane fade" id="my-opinions" role="tabpanel" aria-labelledby="myopinions">
                                <table id="my-opinions-table"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><?= $lang['product'] ?></th>
                                            <th><?= $lang['quote'] ?></th>
                                            <th><?= $lang['media'] ?></th>
                                            <th><?= $lang['recommended2'] ?></th>
                                            <th><?= $lang['status'] ?></th>
                                            <th class="action"><?= $lang['action'] ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_SESSION['id'])) {
                                            $user_opinions_query = $conn->prepare("SELECT O.id, O.quote as opinion_quote, O.media, O.recommended, O.verified, S.title, U.username FROM opinions O
                                            INNER JOIN smartphones S on O.smartphone_id = S.id
                                            INNER JOIN users U on O.user_id = U.id WHERE O.user_id = ?");
                                            $user_opinions_query->bind_param("i", $user_id);
                                            $user_opinions_query->execute();
                                            $user_opinions_res = $user_opinions_query->get_result();
                                            while ($opinion = $user_opinions_res->fetch_assoc()) {
                                                echo '<tr>
                                                    <td>' . $opinion['title'] . '</td>
                                                    <td>' . $opinion['opinion_quote'] . '</td>
                                                    <td>' . $opinion['media'] . '</td>
                                                    <td>' . ($opinion['recommended'] ? $lang['recommended2'] : $lang['not_recommended']) . '</td>
                                                    <td>' . ($opinion['verified'] ? $lang['verified'] : $lang['not_verified']) . '</td>
                                                    <td class="action"><a href="#" data-id="' . $opinion['id'] . '" class="viewReplies view-order">' . $lang['view_replies'] . '</td>
                                                </tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="show_answer_replies">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="cd-top text-replace js-cd-top"><?= $lang['go_top'] ?></a>
    <button id="darkmode-btn" onclick="toggleColorScheme()"><i class="fas fa-sun fa-2x" id="btn-icon"></i></button>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="js/browser.js"></script>
    <script src="js/mobile_navbar.js"></script>
    <script src="js/userModal.js"></script>
    <script src="js/profileDashboard.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/main.js"></script>
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