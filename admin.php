<?php 
include 'lang/detect_lang.php';
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
//Checking if the user is admin
if(!isset($_SESSION['id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] !== 1){
    header('location: index.php');
} else {
    $gravatar = isset($_SESSION['gravatar']) ? $_SESSION['gravatar'] : 'images/users/default.jpg';
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang['admin_dashboard'] ?> | TechMobile | Eneko Galan</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/scroll.css" />
    <link rel="stylesheet" type="text/css" href="css/sliderRange.css" />
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
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li id="dashboard-li">
                    <a href="">
                        <span class="icon">
                            <i class="fa-solid fa-star"></i>
                        </span>
                        <span class="title"><?= $lang['admin_dashboard'] ?></span>
                    </a>
                </li>

                <li>
                    <a href="#dashboard">
                        <span class="icon">
                            <i class="fa-solid fa-house"></i>
                        </span>
                        <span class="title"><?= $lang['dashboard'] ?></span>
                    </a>
                </li>

                <li>
                    <a href="#users">
                        <span class="icon">
                            <i class="fa-solid fa-user-group"></i>
                        </span>
                        <span class="title"><?= $lang['users'] ?></span>
                    </a>
                </li>

                <li>
                    <a href="#opinions">
                        <span class="icon">
                            <i class="fa-solid fa-comment"></i>
                        </span>
                        <span class="title"><?= $lang['opinions'] ?></span>
                    </a>
                </li>

                <li>
                    <a href="#faqs">
                        <span class="icon">
                            <i class="fa-solid fa-question"></i>
                        </span>
                        <span class="title">FAQs</span>
                    </a>
                </li>

                <li>
                    <a href="#smartphones">
                        <span class="icon">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                        </span>
                        <span class="title"><?= $lang['smartphones'] ?></span>
                    </a>
                </li>

                <li>
                    <a href="#orders">
                        <span class="icon">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </span>
                        <span class="title"><?= $lang['orders'] ?></span>
                    </a>
                </li>

            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <!-- ========================= Topbar ==================== -->
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="user">
                    <span><?= $lang['welcome_back'] ?>, <?= $username?></span>
                    <img src="<?= $gravatar ?>" alt="">
                </div>
            </div>
            <!-- ======================= Dashboard ================== -->
            <div class="dashboard">
                <div class="cardBox">
                    <div class="card">
                        <div>
                            <div class="numbers">80</div>
                            <div class="cardName"><?= $lang['sales'] ?></div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers"><?php include 'php/admin/data/countOpinions.php'; getCountOpinions();?></div>
                            <div class="cardName"><?= $lang['opinions'] ?></div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="chatbubbles-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers">7842€</div>
                            <div class="cardName"><?= $lang['earning'] ?></div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cash-outline"></ion-icon>
                        </div>
                    </div>
                </div>

                <!-- ================ Order Details List ================= -->
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2><?= $lang['recent_orders'] ?></h2>
                            <a href="#" class="btn"><?= $lang['view_all'] ?></a>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <td><?= $lang['order'] ?> ID</td>
                                    <td><?= $lang['user'] ?> ID</td>
                                    <td><?= $lang['username'] ?></td>
                                    <td><?= $lang['order'] ?></td>
                                    <td><?= $lang['order_price'] ?></td>
                                    <td><?= $lang['payment'] ?></td>
                                    <td><?= $lang['status'] ?></td>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td><?= $lang['view_order'] ?></td>
                                    <td>1200€</td>
                                    <td>Paypal</td>
                                    <td><span class="status delivered">Delivered</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td><?= $lang['view_order'] ?></td>
                                    <td>1200€</td>
                                    <td>Mastercard</td>
                                    <td><span class="status pending">Pending</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td><?= $lang['view_order'] ?></td>
                                    <td>1200€</td>
                                    <td>Paypal</td>
                                    <td><span class="status return">Return</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td><?= $lang['view_order'] ?></td>
                                    <td>1200€</td>
                                    <td>Visa</td>
                                    <td><span class="status inProgress">In Progress</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td><?= $lang['view_order'] ?></td>
                                    <td>1200€</td>
                                    <td>Visa</td>
                                    <td><span class="status delivered">Delivered</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td><?= $lang['view_order'] ?></td>
                                    <td>1200€</td>
                                    <td>Paypal</td>
                                    <td><span class="status pending">Pending</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td><?= $lang['view_order'] ?></td>
                                    <td>1200€</td>
                                    <td>Mastercard</td>
                                    <td><span class="status return">Return</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td><?= $lang['view_order'] ?></td>
                                    <td>1200€</td>
                                    <td>Paypal</td>
                                    <td><span class="status inProgress">In Progress</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- ================= Recent Users ================ -->
                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <h2><?= $lang['recent_users'] ?></h2>
                        </div>
                        <!--List of Recent Users--->
                        <?php include 'php/admin/list_recent_users.php'; 
                        $queryRecentUsers->close();
                        ?>
                    </div>
                </div>
            </div>
            <!-- ======================= End Dashboard ================== -->
            <!-- ======================= Users ================== -->
            <div class="users">
                <!--Add User Modal-->
                <div class="add_user_modal">
                    <div class="add_user_main">
                        <div class="add_user_main_title">
                            <h2><?= $lang['add_user'] ?></h2>
                            <span class="add_user_close"><i class="fa-solid fa-x"></i></span>
                        </div>
                        <div class="card">
                            <h3><?= $lang['user_info'] ?></h3>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_username"><?= $lang['username'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_username" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['username']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_password"><?= $lang['password'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_password" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['password']) ?>">
                                </div>
                                <div>
                                    <label for="add_user_email"><?= $lang['email'] ?></label>
                                    <input class="default_input" type="text" minlength="10" id="add_user_email" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['email']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_name"><?= $lang['name'] ?></label>
                                    <input class="default_input" type="text" min="0" id="add_user_name" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['name']) ?>">
                                </div>
                                <div>
                                    <label for="add_user_surname"><?= $lang['surname'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_surname" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['surname']) ?>">
                                </div>
                                <div>
                                    <label for="add_user_birthdate"><?= $lang['birthdate'] ?></label>
                                    <input class="default_input" type="date" id="add_user_birthdate">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_sex"><?= $lang['sex'] ?></label>
                                    <select class="default_input" name="add_user_sex" id="add_user_sex">
                                        <option value="-1"><?= $lang['select'] ?>...</option>
                                        <option value="M"><?=$lang['male'] ?></option>
                                        <option value="F"><?= $lang['female'] ?></option>
                                    </select>
                                </div>
                                <div>
                                    <label for="add_user_about"><?= $lang['about_me'] ?></label>
                                    <textarea class="default_textarea" type="text" minlength="4" id="add_user_about" placeholder="<?= $lang['i_am'] ?>..."></textarea>
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_country"><?= $lang['country'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_country" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['country']) ?>">
                                </div>
                                <div>
                                    <label for="add_user_province"><?= $lang['province'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_province" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['province']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_city"><?= $lang['city'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_city" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['city']) ?>">
                                </div>
                                <div>
                                    <label for="add_user_zip"><?= $lang['zip'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_zip" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['zip']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_address1"><?= $lang['address1'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_address1" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['address1']) ?>">
                                </div>
                                <div>
                                    <label for="add_user_address2"><?= $lang['address2'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_address2" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['address2']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_phone"><?= $lang['phone'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_phone" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['phone']) ?>">
                                </div>
                                <div>
                                    <label for="add_user_website"><?= $lang['website'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_website" placeholder="www.<?= strtolower($lang['yourwebsite']) ?>.com">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_facebook">Facebook</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_facebook" placeholder="<?= $lang['enter_facebook_username'] ?>">
                                </div>
                                <div>
                                    <label for="add_user_twitter">Twitter</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_twitter" placeholder="<?= $lang['enter_twitter_username'] ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_instagram">Instagram</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_instagram" placeholder="<?= $lang['enter_instagram_username'] ?> @<?= strtolower($lang['user']) ?>">
                                </div>
                                <div>
                                    <label for="add_user_github">GitHub</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_github" placeholder="<?= $lang['enter_github_username'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row"><button onclick="createUser()"><?= $lang['submit'] ?></button></div>
                    </div>
                </div>
                <!--Edit User Modal-->
                <div class="edit_user_modal">
                    <div class="edit_user_main">
                        <div class="edit_user_main_title">
                            <h2><?= $lang['edit_user'] ?></h2>
                            <span class="edit_user_close"><i class="fa-solid fa-x"></i></span>
                        </div>
                        <div class="card">
                            <h3><?= $lang['user_info'] ?></h3>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_id">ID</label>
                                    <input class="default_input" type="text" id="edit_user_id" disabled>
                                </div>
                                <div>
                                    <label for="edit_user_username"><?= $lang['username'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_username" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['username']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_password"><?= $lang['password'] ?></label>
                                    <input class="default_input" type="password" minlength="10" id="edit_user_password" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['password']) ?>">
                                </div>
                                <div>
                                    <label for="edit_user_email"><?= $lang['email'] ?></label>
                                    <input class="default_input" type="text" minlength="10" id="edit_user_email" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['email']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_name"><?= $lang['name'] ?></label>
                                    <input class="default_input" type="text" min="2" id="edit_user_name" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['name']) ?>">
                                </div>
                                <div>
                                    <label for="edit_user_surname"><?= $lang['surname'] ?></label>
                                    <input class="default_input" type="text" minlength="2" id="edit_user_surname" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['surname']) ?>">
                                </div>
                                <div>
                                    <label for="edit_user_birthdate"><?= $lang['birthdate'] ?></label>
                                    <input class="default_input" type="date" id="edit_user_birthdate">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_sex"><?= $lang['sex'] ?></label>
                                    <select class="default_input" name="edit_user_sex" id="edit_user_sex">
                                        <option value="-1"><?= $lang['select'] ?>...</option>
                                        <option value="M"><?= $lang['male'] ?></option>
                                        <option value="F"><?= $lang['female'] ?></option>
                                    </select>
                                </div>
                                <div>
                                    <label for="edit_user_about"><?= $lang['about_me'] ?></label>
                                    <textarea class="default_textarea" id="edit_user_about" type="text" cols="1" rows="5" placeholder="<?= strtolower($lang['i_am']) ?>..."></textarea>
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_country"><?= $lang['country'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_country" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['country']) ?>">
                                </div>
                                <div>
                                    <label for="edit_user_province"><?= $lang['province'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_province" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['province']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_city"><?= $lang['city'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_city" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['city']) ?>">
                                </div>
                                <div>
                                    <label for="edit_user_zip"><?= $lang['zip'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_zip" placeholder="<?= $lang['enter'] ?> <?= $lang['zip'] ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_address1"><?= $lang['address1'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_address1" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['address1']) ?>">
                                </div>
                                <div>
                                    <label for="edit_user_address2"><?= $lang['address2'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_address2" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['address2']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_phone"><?= $lang['phone'] ?></label>
                                    <input class="default_input" type="text" id="edit_user_phone" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['phone']) ?>">
                                </div>
                                <div>
                                    <label for="edit_user_website"><?= $lang['website'] ?></label>
                                    <input class="default_input" type="text" id="edit_user_website" placeholder="www.<?= strtolower($lang['yourwebsite']) ?>.com">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_facebook"><?= $lang['facebook'] ?></label>
                                    <input class="default_input" type="text" id="edit_user_facebook" placeholder="<?= $lang['enter_facebook_username'] ?>">
                                </div>
                                <div>
                                    <label for="edit_user_twitter">Twitter</label>
                                    <input class="default_input" type="text" id="edit_user_twitter" placeholder="<?= $lang['enter_twitter_username'] ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_instagram">Instagram</label>
                                    <input class="default_input" type="text" id="edit_user_instagram" placeholder="<?= $lang['enter_instagram_username'] ?> Instagram @<?= strtolower($lang['username']) ?>">
                                </div>
                                <div>
                                    <label for="edit_user_github">Github</label>
                                    <input class="default_input" type="text" id="edit_user_github" placeholder="<?= $lang['enter_github_username'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row"><button onclick="updateUser()"><?= $lang['submit'] ?></button></div>
                    </div>
                </div>

                <div class="cardBox">
                    <div class="card">
                        <div>
                            <div class="numbers">
                                <?php 
                                    include 'php/admin/data/countUsers.php'; 
                                    echo countUsers(); 
                                ?>
                            </div>
                            <div class="cardName"><?= $lang['users'] ?></div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="cart outline">
                            </ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers"><?= countActiveUsers(); ?></div>
                            <div class="cardName"><?= $lang['users_active'] ?></div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="chatbubbles-outline" role="img" class="md hydrated"
                                aria-label="chatbubbles outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers"><?= countInactiveUsers(); ?></div>
                            <div class="cardName"><?= $lang['users_inactive'] ?></div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cash-outline" role="img" class="md hydrated" aria-label="cash outline">
                            </ion-icon>
                        </div>
                    </div>
                </div>
                <div class="details">
                    <div class="cardHeaderUsersList">
                        <div class="headerUsers">
                            <h2><?= $lang['users'] ?></h2>
                            <a href="#" class="btn" id="add_user_a"><?= $lang['add'] ?></a>
                        </div>
                    </div>
                    <div class="usersList">
                        <!--Users Table-->
                        <div class="users-table">
                            <table>
                                <thead>
                                    <tr>
                                        <td></td>
                                        <!--Users Gravatar-->
                                        <td>ID</td>
                                        <td><?= $lang['username'] ?></td>
                                        <td><?= $lang['email'] ?></td>
                                        <td><?= $lang['name'] ?></td>
                                        <td><?= $lang['surname'] ?></td>
                                        <td><?= $lang['phone'] ?></td>
                                        <td><?= $lang['birthdate'] ?></td>
                                        <td><?= $lang['sex'] ?></td>
                                        <td><?= $lang['country'] ?></td>
                                        <td><?= $lang['province'] ?></td>
                                        <td><?= $lang['city'] ?></td>
                                        <td><?= $lang['zip'] ?></td>
                                        <td><?= $lang['address1'] ?></td>
                                        <td><?= $lang['address2'] ?></td>
                                        <td><?= $lang['status'] ?></td>
                                        <td><?= $lang['action'] ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--List all users--->
                                    <?php include 'php/admin/list_all_users.php';?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="usersFilters">
                        <h2><?= $lang['filters'] ?></h2>
                        <ul>
                            <li>
                                <label for="search"><?= $lang['search'] ?></label>
                                <input class="default_input" type="text" name="search" id="search" placeholder="<?= $lang['search'] ?>...">
                            </li>
                            <li>
                                <label for="birthdate"><?= $lang['birthdate'] ?></label>
                                <input class="default_input" type="date" name="birthdate" id="birthdate">
                            </li>
                            <li>
                                <label for="joining_date"><?= $lang['joining_date'] ?></label>
                                <input class="default_input" type="date" name="joining_date" id="joining_date">
                            </li>
                            <li>
                                <label for="status"><?= $lang['status'] ?></label>
                                <select class="default_input" name="status" id="status">
                                    <option value="-1" selected><?= $lang['all'] ?></option>
                                    <option value="1"><?= $lang['active'] ?></option>
                                    <option value="0"><?= $lang['inactive'] ?></option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ======================= End Users ================== -->
            <!-- ======================= Opinions ================== -->
            <div class="opinions">
                <div class="cardBox">
                    <div class="card">
                        <div>
                            <div class="numbers"><?php getCountOpinionsMonth() ?></div>
                            <div class="cardName"><?= $lang['new_opinions_month'] ?></div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="cart outline">
                            </ion-icon>
                        </div>
                    </div>
                </div>
                <div class="details">
                    <div class="cardHeaderUsersList">
                        <div class="headerOpinions">
                            <h2><?= $lang['opinions'] ?></h2>
                        </div>
                    </div>
                    <div class="commentsList">
                        <!--Opinions Table-->
                        <div class="opinions-table">
                            <table>
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td><?= $lang['smartphone'] ?></td>
                                        <td></td>
                                        <!--Users Gravatar-->
                                        <td><?= $lang['username'] ?></td>
                                        <td><?= $lang['opinion'] ?></td>
                                        <td><?= $lang['date'] ?></td>
                                        <td><?= $lang['action'] ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include 'php/admin/list_all_opinions.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="opinionsFilters" class="usersFilters">
                        <h2><?= $lang['filters'] ?></h2>
                        <ul>
                            <li>
                                <label for="search"><?= $lang['search'] ?></label>
                                <input class="default_input" type="text" name="search" id="search"
                                    placeholder="<?= $lang['search'] ?>...">
                            </li>
                            <li>
                                <label for="manufacturer"><?= $lang['manufacturer'] ?></label>
                                <select class="default_input" name="manufacturer" id="manufacturer">
                                    <option value="-1" selected><?= $lang['all'] ?></option>
                                    <?php
                                        include 'php/list_manufacturers.php';
                                        foreach ($manufacturers as $manufacturer) {
                                            echo '
                                                <option value="' . $manufacturer['name'] .'">' . ucfirst($manufacturer['name']) .'</option>
                                            ';                                            
                                        }
                                        
                                    ?>
                                </select>
                            </li>
                            <li>
                                <label for="date"><?= $lang['date'] ?></label>
                                <input class="default_input" type="date" name="date" id="date">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ======================= End Comments ================== -->
            <!--Add FAQ Modal-->
            <div class="add_faq_modal">
                <div class="add_faq_main">
                    <div class="add_faq_main_title">
                        <h2><?= $lang['add'] ?> FAQ</h2>
                        <span class="add_faq_close"><i class="fa-solid fa-x"></i></span>
                    </div>
                    <div class="card">
                        <h3>FAQ <?= $lang['info'] ?></h3>
                        <div class="row" style="display: inline-grid;">
                            <div>
                                <label for="add_faq_question"><?= $lang['question'] ?></label>
                                <input class="default_input" type="text" minlength="5" id="add_faq_question" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['question']) ?>">
                            </div>
                        </div>
                        <div class="row" style="display: inline-grid;">
                            <div>
                                <label for="add_faq_answer"><?= $lang['answer'] ?></label>
                                <input class="default_input" type="text" minlength="5" id="add_faq_answer" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['add']) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row"><button onclick="createFAQ()"><?= $lang['submit'] ?></button></div>
                </div>
            </div>
            <!--Edit FAQ Modal-->
            <div class="edit_faq_modal">
                <div class="edit_faq_main">
                    <div class="edit_faq_main_title">
                        <h2><?= $lang['edit'] ?> FAQ</h2>
                        <span class="edit_faq_close"><i class="fa-solid fa-x"></i></span>
                    </div>
                    <div class="card">
                        <h3>FAQ <?= $lang['info'] ?></h3>
                        <div class="row" style="display: inline-grid;">
                            <div>
                                <label for="edit_faq_id">ID</label>
                                <input class="default_input" type="text" id="edit_faq_id" disabled>
                            </div>
                            <div>
                                <label for="edit_faq_question"><?= $lang['question'] ?></label>
                                <input class="default_input" type="text" minlength="5" id="edit_faq_question" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['question']) ?>">
                            </div>
                        </div>
                        <div class="row" style="display: inline-grid;">
                            <div>
                                <label for="edit_faq_answer"><?= $lang['answer'] ?></label>
                                <input class="default_input" type="text" minlength="5" id="edit_faq_answer" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['answer']) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row"><button onclick="updateFAQ()"><?= $lang['submit'] ?></button></div>
                </div>
            </div>
            <!-- ======================= FAQs ================== -->
            <div class="faqs">
                <div class="details">
                    <div class="faqsList">
                        <div class="cardHeaderFAQList">
                            <div class="headerFAQ">
                                <h2>FAQs</h2>
                                <a href="#" id="add_faq_a" class="btn"><?= $lang['add'] ?></a>
                            </div>
                        </div>
                        <!--FAQs Table-->
                        <div class="faqs-table">
                            <table>
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td><?= $lang['question'] ?></td>
                                        <td><?= $lang['answer'] ?></td>
                                        <td><?= $lang['created_by'] ?></td>
                                        <td><?= $lang['date'] ?></td>
                                        <td><?= $lang['action'] ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--List FAQS-->
                                    <?php include 'php/admin/faqs/list_faqs.php' ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="faqsFilters" class="usersFilters">
                        <h2><?= $lang['filters'] ?></h2>
                        <ul>
                            <li>
                                <label for="search"><?= $lang['search'] ?></label>
                                <input class="default_input" type="text" name="search" id="search" placeholder="<?= $lang['search'] ?>...">
                            </li>
                            <li>
                                <label for="date"><?= $lang['date'] ?></label>
                                <input class="default_input" type="date" name="date" id="date">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ======================= End FAQs ================== -->
            <!-- ======================= Smartphones ================== -->
            <div  class="smartphones">
                <!--Add Smartphone Modal-->
                <div class="add_smartphone_modal">
                    <div class="add_smartphone_main">
                        <div class="add_smartphone_main_title">
                            <h2><?= $lang['add'] ?> <?= strtolower($lang['smartphone']) ?></h2>
                            <span class="add_smartphone_close"><i class="fa-solid fa-x"></i></span>
                        </div>
                        <div class="card">
                            <h3><?= $lang['smartphone'] ?> <?= $lang['info'] ?></h3>
                            <div class="row" style="display: inline-grid;">
                                <label for="add_smartphone_title"><?= $lang['title'] ?></label>
                                <input class="default_input" type="text" minlength="4" id="smartphone_add_title" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['title']) ?>">
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_subtitle1">Subtitle1</label>
                                    <input class="default_input" type="text" minlength="10" id="smartphone_add_subtitle1" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['subtitle']) ?> 1">
                                </div>
                                <div>
                                    <label for="smartphone_add_subtitle2">Subtitle2</label>
                                    <input class="default_input" type="text" minlength="10" id="smartphone_add_subtitle2" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['subtitle']) ?> 2">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <label for="smartphone_add_price"><?= $lang['price'] ?></label>
                                <input class="default_input" type="text" min="0" id="smartphone_add_price" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['price'] . ' ' . $lang['in']) ?> Euros €">
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_description"><?= $lang['description'] ?></label>
                                    <textarea class="default_textarea" type="text" minlength="4" id="smartphone_add_description" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['description']) ?>"></textarea>
                                </div>
                                <div>
                                    <label for="smartphone_add_model"><?= $lang['model'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_model" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['add']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_width"><?= $lang['width'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_width" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['width']) ?>">
                                </div>
                                <div>
                                    <label for="smartphone_add_height"><?= $lang['height'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_height" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['height']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_thick"><?= $lang['thick'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_thick" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['thick']) ?>">
                                </div>
                                <div>
                                    <label for="smartphone_add_weight"><?= $lang['weight'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_weight" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['weight']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_display"><?= $lang['display'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_display" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['display']) ?>">
                                </div>
                                <div>
                                    <label for="smartphone_add_chip"><?= $lang['chip'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_chip" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['chip']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_camera"><?= $lang['camera'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_camera" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['camera']) ?>">
                                </div>
                                <div>
                                    <label for="smartphone_add_os"><?= $lang['os'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_os" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['os']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <span><?= $lang['storage'] ?></span>
                                    <div class="add_smartphone_storage_options" style="display: block;">
                                        <input type="checkbox" id="option16" name="option16" value="16">
                                        <label for="option16">16GB</label>
                                        <input type="checkbox" id="option32" name="option32" value="32">
                                        <label for="option32">32GB</label>
                                        <input type="checkbox" id="option64" name="option64" value="64">
                                        <label for="option64">64GB</label>
                                        <input type="checkbox" id="option128" name="option128" value="128">
                                        <label for="option128">128GB</label>
                                        <input type="checkbox" id="option256" name="option256" value="256">
                                        <label for="option256">256GB</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <span><?= $lang['colors'] ?></span>
                                <div class="add_smartphone_color_options_div" style="display: block;">
                                    <?php include 'php/admin/list_colors.php'; echo $list_colors; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card" style="width: 61%;margin-right: 0;">
                                <h3><?= $lang['smartphone_gallery'] ?></h3>
                                <div class="row">
                                    <div class="upload-wrapper">
                                        <span class="upload-label">
                                            <?= $lang['upload_thumbnail'] ?>
                                        </span>
                                        <input type="file" name="add-smartphone-upload-thumbnail" id="add-smartphone-upload-thumbnail" class="upload-input" placeholder="<?= $lang['upload_file'] ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="add_smartphone_image_count"><?= $lang['image_count'] ?></label>
                                    <input 105px id="add_smartphone_image_count" type="number" min="0" value="0">
                                </div>
                                <div class="row">
                                    <button onclick="loadColors1()"><?= $lang['load_colors'] ?></button>
                                </div>
                                <div class="row" style="align-items: flex-start;padding-bottom: 10%;">
                                    <label><?= $lang['add_images'] ?></label>
                                    <div class="add_smartphone_images">
                                        <ul>
                                            <li>
                                                <input type="radio" color="black" name="radioButton" class="radio_button" id="radioColor1" checked>
                                                <label title="Black" for="radioColor1" class="block_goodColor__radio block_goodColor__black"></label>
                                            </li>
                                        </ul>
                                        <div class="add-smartphone-colors-upload">
                                            <div class="black active">
                                                <input type="file" class="add_smartphone_upload_image" multiple name="add_smartphone_add_images_black" id="add_smartphone_add_images_black">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="width: 36%;height: 50%;top: -25%;">
                                <h3><?= $lang['manufacturer'] ?></h3>
                                <div class="row">
                                    <label for="add_smartphone_manufacturer_id"><?= $lang['manufacturer_name'] ?></label>
                                    <select class="default_input" name="add_smartphone_manufacturer_id" id="add_smartphone_manufacturer_id">
                                        <option value="-1"><?= $lang['select'] ?>...</option>
                                        <?php include 'php/list_manufacturers.php';
                                            for($i = 0; $i < count($manufacturers); $i++){
                                                echo '
                                                    <option value="' . $manufacturers[$i]['id'] . '">' . ucfirst($manufacturers[$i]['name']) . '</option>
                                                ';
                                            }
                                            $query->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <label for="add_smartphone_stock"><?= $lang['stock'] ?></label>
                                    <input class="default_input" type="number" name="add_smartphone_stock" id="add_smartphone_stock" style="width:105px;" min="0" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row"><button onclick="createSmartphone()"><?= $lang['submit'] ?></button></div>
                    </div>
                </div>
                <!--Edit Smartphone Modal-->

                <div class="edit_smartphone_modal">
                    <div class="edit_smartphone_main">
                        <div class="edit_smartphone_main_title">
                            <h2><?= $lang['edit'] ?> smartphone</h2>
                            <span class="edit_smartphone_close"><i class="fa-solid fa-x"></i></span>
                        </div>
                        <div class="card">
                            <h3>Smartphone <?= $lang['info'] ?></h3>
                            <div class="row">
                                <label for="smartphone_edit_id">ID</label>
                                <input class="default_input" type="number" minlength="4" id="smartphone_edit_id" value="" disabled>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <label for="smartphone_edit_title"><?= $lang['title'] ?></label>
                                <input class="default_input" type="text" minlength="4" id="smartphone_edit_title" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['title']) ?>">
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_subtitle1"><?= $lang['subtitle'] ?> 1</label>
                                    <input class="default_input" type="text" minlength="10" id="smartphone_edit_subtitle1" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['subtitle']) ?> 1">
                                </div>
                                <div>
                                    <label for="smartphone_edit_subtitle2"><?= $lang['subtitle'] ?> 2</label>
                                    <input class="default_input" type="text" minlength="10" id="smartphone_edit_subtitle2" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['subtitle']) ?> 2">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <label for="smartphone_edit_price"><?= $lang['price'] ?></label>
                                <input class="default_input" type="text" min="0" id="smartphone_edit_price" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['price'] . $lang['in']) ?>  Euros €">
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_description"><?= $lang['description'] ?></label>
                                    <textarea class="default_textarea" type="text" minlength="4" id="smartphone_edit_description" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['description']) ?>"></textarea>
                                </div>
                                <div>
                                    <label for="smartphone_edit_model"><?= $lang['model'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_model" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['model']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_width"><?= $lang['width'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_width" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['width']) ?>">
                                </div>
                                <div>
                                    <label for="smartphone_edit_height"><?= $lang['height'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_height" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['height']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_thick"><?= $lang['thick'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_thick" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['thick']) ?>">
                                </div>
                                <div>
                                    <label for="smartphone_edit_weight"><?= $lang['weight'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_weight" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['weight']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_display"><?= $lang['display'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_display" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['display']) ?>">
                                </div>
                                <div>
                                    <label for="smartphone_edit_chip"><?= $lang['chip'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_chip" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['chip']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_camera"><?= $lang['camera'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_camera" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['camera']) ?>">
                                </div>
                                <div>
                                    <label for="smartphone_edit_os"><?= $lang['os'] ?></label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_os" placeholder="<?= $lang['enter'] ?> <?= strtolower($lang['os']) ?>">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <span><?= $lang['storage'] ?></span>
                                    <div class="edit_smartphone_storage_options" style="display: block;">
                                        <input type="checkbox" id="option16" name="option16" value="16">
                                        <label for="option16">16GB</label>
                                        <input type="checkbox" id="option32" name="option32" value="32">
                                        <label for="option32">32GB</label>
                                        <input type="checkbox" id="option64" name="option64" value="64">
                                        <label for="option64">64GB</label>
                                        <input type="checkbox" id="option128" name="option128" value="128">
                                        <label for="option128">128GB</label>
                                        <input type="checkbox" id="option256" name="option256" value="256">
                                        <label for="option256">256GB</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <span><?= $lang['colors'] ?></span>
                                <div class="edit_smartphone_color_options_div" style="display: block;">
                                    <?= $list_colors ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card" style="width: 61%;margin-right: 0;">
                                <h3><?= $lang['smartphone_gallery'] ?></h3>
                                <div class="row">
                                    <div class="upload-wrapper">
                                        <span class="upload-label">
                                            <?= $lang['upload_thumbnail'] ?>
                                        </span>
                                        <input type="file" name="edit-smartphone-upload-thumbnail" id="edit-smartphone-upload-thumbnail" class="upload-input" placeholder="<?= $lang['upload_file'] ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="edit_smartphone_image_count"><?= $lang['image_count'] ?></label>
                                    <input class="default_input" id="edit_smartphone_image_count" type="number" min="0" value="0">
                                </div>
                                <div class="row">
                                    <button onclick="loadColors2()"><?= $lang['load_colors'] ?></button>
                                </div>
                                <div class="row" style="align-items: flex-start;padding-bottom: 10%;">
                                    <label for="edit_smartphone_add_images"><?= $lang['add_images'] ?></label>
                                    <div class="edit_smartphone_images">
                                        <ul>
                                            <li>
                                                <input type="radio" color="black" name="radioButton" class="radio_button" id="radioColor1" checked>
                                                <label title="<?= $lang['height'] ?>" for="radioColor1" class="block_goodColor__radio block_goodColor__black"></label>
                                            </li>
                                        </ul>
                                        <div class="edit-smartphone-colors-upload">
                                            <div class="black active">
                                                <input type="file" class="edit_smartphone_upload_image" multiple name="edit_smartphone_add_images_black" id="edit_smartphone_add_images_black">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="width: 36%;height: 50%;top: -25%;">
                                <h3><?= $lang['manufacturer'] ?></h3>
                                <div class="row">
                                    <label for="edit_smartphone_manufacturer_id"><?= $lang['manufacturer_name'] ?></label>
                                    <select class="default_input" name="edit_smartphone_manufacturer_id" id="edit_smartphone_manufacturer_id">
                                        <option value="-1"><?= $lang['select'] ?>...</option>
                                        <?php include 'php/list_manufacturers.php';
                                            for($i = 0; $i < count($manufacturers); $i++){
                                                echo '
                                                    <option value="' . $manufacturers[$i]['id'] . '">' . ucfirst($manufacturers[$i]['name']) . '</option>
                                                ';
                                            }
                                            $query->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <label for="edit_smartphone_stock"><?= $lang['stock'] ?></label>
                                    <input class="default_input" type="number" name="edit_smartphone_stock" id="edit_smartphone_stock" style="width: 105px;" min="0" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row"><button onclick="updateSmartphone()"><?= $lang['submit'] ?></button></div>
                    </div>
                </div>

                <div class="details">
                    <div class="cardHeaderSmartphonesList">
                        <div class="headerUsers">
                            <h2><?= $lang['smartphones'] ?></h2>
                            <a href="#" id="add_smartphone_a" class="btn"><?= $lang['add'] ?></a>
                        </div>
                    </div>
                    <div class="smartphonesList">
                        <!--Smartphones Table-->
                        <div class="smartphones-table">
                            <table>
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td></td>
                                        <!--Smartphone thumbnail-->
                                        <td><?= $lang['name'] ?></td>
                                        <td><?= $lang['manufacturer'] ?></td>
                                        <td><?= $lang['price'] ?></td>
                                        <td><?= $lang['rating'] ?></td>
                                        <td><?= $lang['action'] ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--List all smartphones-->
                                    <?php include 'php/admin/list_all_smartphones.php';?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="smartphonesFilters" class="usersFilters">
                        <h2><?= $lang['filters'] ?></h2>
                        <ul>
                            <li>
                                <label for="search"><?= $lang['search'] ?></label>
                                <input class="default_input" type="text" name="search" id="search"
                                    placeholder="<?= $lang['search'] ?>...">
                            </li>
                            <li>
                                <label for="price"><?= $lang['manufacturer'] ?></label>
                                <input class="default_input" type="text" name="smartphones-filter2" id="smartphones-filter2"
                                    placeholder="<?= $lang['search'] ?>...">
                            </li>
                            <li>
                                <label for="smartphones-filter3"><?= $lang['price'] ?></label>
                                <div style="margin-left:20px; display: flex;flex-direction: column;width: 400px;">
                                    <div class="price-input">
                                        <div class="field">
                                            <span>Min</span>
                                            <input type="number" id="min_price" class="input-min" value="0">
                                        </div>
                                        <div class="separator">-</div>
                                        <div class="field">
                                            <span>Max</span>
                                            <input type="number" id="max_price" class="input-max" value="5000">
                                        </div>
                                    </div>
                                    <div class="slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min" min="0" max="5000" value="0" step="100">
                                        <input type="range" class="range-max" min="0" max="5000" value="5000" step="100">
                                    </div>
                                </div>
                            </li>
                            <li style="display:flex;gap:5px;margin-top:10px;">
                                <label for="rating"><?= $lang['rating'] ?></label>
                                <select name="rating" id="rating">
                                    <option selected value="-1"><?= $lang['all'] ?></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ======================= End Smartphones ================== -->
            <!-- ======================= Orders ================== -->
            <div class="orders">
                <h1><?= $lang['orders'] ?></h1>
            </div>
            <!-- ======================= End Orders ================== -->
        </div>
        <a href="#" class="cd-top text-replace js-cd-top"><?= $lang['go_top'] ?></a>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="js/auth.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/main.js"></script>
    <script src="js/browser.js"></script>
    <script src="js/mobile_navbar.js"></script>
    <script src="js/userModal.js"></script>
    <script src="js/sliderRange.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>