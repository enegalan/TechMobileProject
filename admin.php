<?php 
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
//Checking if the user is admin
if(!isset($_SESSION['id']) && $_SESSION['is_admin'] !== 1){
    header('location: index.php');
}
$gravatar = $_SESSION['gravatar'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | TechMobile | Eneko Galan</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://kit.fontawesome.com/8e4bd12ccb.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/scroll.css" />
    <link rel="stylesheet" type="text/css" href="css/sliderRange.css" />
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
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li id="dashboard-li">
                    <a href="">
                        <span class="icon">
                            <i class="fa-solid fa-star"></i>
                        </span>
                        <span class="title">Admin Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#dashboard">
                        <span class="icon">
                            <i class="fa-solid fa-house"></i>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#users">
                        <span class="icon">
                            <i class="fa-solid fa-user-group"></i>
                        </span>
                        <span class="title">Users</span>
                    </a>
                </li>

                <li>
                    <a href="#opinions">
                        <span class="icon">
                            <i class="fa-solid fa-comment"></i>
                        </span>
                        <span class="title">Opinions</span>
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
                        <span class="title">Smartphones</span>
                    </a>
                </li>

                <li>
                    <a href="#orders">
                        <span class="icon">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </span>
                        <span class="title">Orders</span>
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
                    <span>Welcome back, <?= $username?></span>
                    <img src="<?= $gravatar ?>" alt="">
                </div>
            </div>
            <!-- ======================= Dashboard ================== -->
            <div class="dashboard">
                <div class="cardBox">
                    <div class="card">
                        <div>
                            <div class="numbers">80</div>
                            <div class="cardName">Sales</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers"><?php include 'php/admin/data/countOpinions.php'; getCountOpinions();?></div>
                            <div class="cardName">Opinions</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="chatbubbles-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers">7842€</div>
                            <div class="cardName">Earning</div>
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
                            <h2>Recent Orders</h2>
                            <a href="#" class="btn">View All</a>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <td>Order ID</td>
                                    <td>User ID</td>
                                    <td>Username</td>
                                    <td>Order</td>
                                    <td>Order Price</td>
                                    <td>Payment</td>
                                    <td>Status</td>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td>View Order</td>
                                    <td>1200€</td>
                                    <td>Paypal</td>
                                    <td><span class="status delivered">Delivered</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td>View Order</td>
                                    <td>1200€</td>
                                    <td>Mastercard</td>
                                    <td><span class="status pending">Pending</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td>View Order</td>
                                    <td>1200€</td>
                                    <td>Paypal</td>
                                    <td><span class="status return">Return</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td>View Order</td>
                                    <td>1200€</td>
                                    <td>Visa</td>
                                    <td><span class="status inProgress">In Progress</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td>View Order</td>
                                    <td>1200€</td>
                                    <td>Visa</td>
                                    <td><span class="status delivered">Delivered</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td>View Order</td>
                                    <td>1200€</td>
                                    <td>Paypal</td>
                                    <td><span class="status pending">Pending</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td>View Order</td>
                                    <td>1200€</td>
                                    <td>Mastercard</td>
                                    <td><span class="status return">Return</span></td>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>egalan</td>
                                    <td>View Order</td>
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
                            <h2>Recent Users</h2>
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
                            <h2>Add user</h2>
                            <span class="add_user_close"><i class="fa-solid fa-x"></i></span>
                        </div>
                        <div class="card">
                            <h3>User Info</h3>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_username">Username</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_username" placeholder="Enter username">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_password">Password</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_password" placeholder="Enter password">
                                </div>
                                <div>
                                    <label for="add_user_email">Email</label>
                                    <input class="default_input" type="text" minlength="10" id="add_user_email" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_name">Name</label>
                                    <input class="default_input" type="text" min="0" id="add_user_name" placeholder="Enter name">
                                </div>
                                <div>
                                    <label for="add_user_surname">Surname</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_surname" placeholder="Enter surname">
                                </div>
                                <div>
                                    <label for="add_user_birthdate">Birthdate</label>
                                    <input class="default_input" type="date" id="add_user_birthdate">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_sex">Sex</label>
                                    <select class="default_input" name="add_user_sex" id="add_user_sex">
                                        <option value="-1">Select...</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="add_user_about">About</label>
                                    <textarea class="default_textarea" type="text" minlength="4" id="add_user_about" placeholder="I am a..."></textarea>
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_country">Country</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_country" placeholder="Enter country">
                                </div>
                                <div>
                                    <label for="add_user_province">Province</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_province" placeholder="Enter province">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_city">City</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_city" placeholder="Enter city">
                                </div>
                                <div>
                                    <label for="add_user_zip">ZIP</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_zip" placeholder="Enter ZIP">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_address1">Address 1</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_address1" placeholder="Enter address 1">
                                </div>
                                <div>
                                    <label for="add_user_address2">Address 2</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_address2" placeholder="Enter address 2">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_phone">Phone</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_phone" placeholder="Enter phone">
                                </div>
                                <div>
                                    <label for="add_user_website">Website</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_website" placeholder="www.mywebsite.com">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_facebook">Facebook</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_facebook" placeholder="Enter Facebook username">
                                </div>
                                <div>
                                    <label for="add_user_twitter">Twitter</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_twitter" placeholder="Enter Twitter username">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="add_user_instagram">Instagram</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_instagram" placeholder="Enter Instagram @username">
                                </div>
                                <div>
                                    <label for="add_user_github">Github</label>
                                    <input class="default_input" type="text" minlength="4" id="add_user_github" placeholder="Enter Github username">
                                </div>
                            </div>
                        </div>
                        <div class="row"><button onclick="createUser()">Submit</button></div>
                    </div>
                </div>
                <!--Edit User Modal-->
                <div class="edit_user_modal">
                    <div class="edit_user_main">
                        <div class="edit_user_main_title">
                            <h2>Edit user</h2>
                            <span class="edit_user_close"><i class="fa-solid fa-x"></i></span>
                        </div>
                        <div class="card">
                            <h3>User Info</h3>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_id">ID</label>
                                    <input class="default_input" type="text" id="edit_user_id" disabled>
                                </div>
                                <div>
                                    <label for="edit_user_username">Username</label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_username" placeholder="Enter username">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_password">Password</label>
                                    <input class="default_input" type="password" minlength="10" id="edit_user_password" placeholder="Enter password">
                                </div>
                                <div>
                                    <label for="edit_user_email">Email</label>
                                    <input class="default_input" type="text" minlength="10" id="edit_user_email" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_name">Name</label>
                                    <input class="default_input" type="text" min="2" id="edit_user_name" placeholder="Enter name">
                                </div>
                                <div>
                                    <label for="edit_user_surname">Surname</label>
                                    <input class="default_input" type="text" minlength="2" id="edit_user_surname" placeholder="Enter surname">
                                </div>
                                <div>
                                    <label for="edit_user_birthdate">Birthdate</label>
                                    <input class="default_input" type="date" id="edit_user_birthdate">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_sex">Sex</label>
                                    <select class="default_input" name="edit_user_sex" id="edit_user_sex">
                                        <option value="-1">Select...</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="edit_user_about">About</label>
                                    <textarea class="default_textarea" id="edit_user_about" type="text" cols="1" rows="5" placeholder="I am a..."></textarea>
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_country">Country</label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_country" placeholder="Enter country">
                                </div>
                                <div>
                                    <label for="edit_user_province">Province</label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_province" placeholder="Enter province">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_city">City</label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_city" placeholder="Enter city">
                                </div>
                                <div>
                                    <label for="edit_user_zip">ZIP</label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_zip" placeholder="Enter ZIP">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_address1">Address 1</label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_address1" placeholder="Enter address 1">
                                </div>
                                <div>
                                    <label for="edit_user_address2">Address 2</label>
                                    <input class="default_input" type="text" minlength="4" id="edit_user_address2" placeholder="Enter address 2">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_phone">Phone</label>
                                    <input class="default_input" type="text" id="edit_user_phone" placeholder="Enter phone">
                                </div>
                                <div>
                                    <label for="edit_user_website">Website</label>
                                    <input class="default_input" type="text" id="edit_user_website" placeholder="www.mywebsite.com">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_facebook">Facebook</label>
                                    <input class="default_input" type="text" id="edit_user_facebook" placeholder="Enter Facebook username">
                                </div>
                                <div>
                                    <label for="edit_user_twitter">Twitter</label>
                                    <input class="default_input" type="text" id="edit_user_twitter" placeholder="Enter Twitter username">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="edit_user_instagram">Instagram</label>
                                    <input class="default_input" type="text" id="edit_user_instagram" placeholder="Enter Instagram @username">
                                </div>
                                <div>
                                    <label for="edit_user_github">Github</label>
                                    <input class="default_input" type="text" id="edit_user_github" placeholder="Enter Github username">
                                </div>
                            </div>
                        </div>
                        <div class="row"><button onclick="updateUser()">Submit</button></div>
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
                            <div class="cardName">Users</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cart-outline" role="img" class="md hydrated" aria-label="cart outline">
                            </ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo countActiveUsers(); ?></div>
                            <div class="cardName">Users active</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="chatbubbles-outline" role="img" class="md hydrated"
                                aria-label="chatbubbles outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo countInactiveUsers(); ?></div>
                            <div class="cardName">Users inactive</div>
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
                            <h2>Users</h2>
                            <a href="#" class="btn" id="add_user_a">Add</a>
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
                                        <td>Username</td>
                                        <td>Email</td>
                                        <td>Name</td>
                                        <td>Surname</td>
                                        <td>Phone</td>
                                        <td>Birthdate</td>
                                        <td>Sex</td>
                                        <td>Country</td>
                                        <td>Province</td>
                                        <td>City</td>
                                        <td>ZIP</td>
                                        <td>Address 1</td>
                                        <td>Address 2</td>
                                        <td>Status</td>
                                        <td>Action</td>
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
                        <h2>Filters</h2>
                        <ul>
                            <li>
                                <label for="search">Search</label>
                                <input class="default_input" type="text" name="search" id="search" placeholder="Search...">
                            </li>
                            <li>
                                <label for="birthdate">Birthdate</label>
                                <input class="default_input" type="date" name="birthdate" id="birthdate">
                            </li>
                            <li>
                                <label for="joining_date">Joining date</label>
                                <input class="default_input" type="date" name="joining_date" id="joining_date">
                            </li>
                            <li>
                                <label for="status">Status</label>
                                <select class="default_input" name="status" id="status">
                                    <option value="-1" selected>All</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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
                            <div class="cardName">New opinions this month</div>
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
                            <h2>Opinions</h2>
                        </div>
                    </div>
                    <div class="commentsList">
                        <!--Opinions Table-->
                        <div class="opinions-table">
                            <table>
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Smartphone</td>
                                        <td></td>
                                        <!--Users Gravatar-->
                                        <td>Username</td>
                                        <td>Comment</td>
                                        <td>Date</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include 'php/admin/list_all_opinions.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="opinionsFilters" class="usersFilters">
                        <h2>Filters</h2>
                        <ul>
                            <li>
                                <label for="search">Search</label>
                                <input class="default_input" type="text" name="search" id="search"
                                    placeholder="Search...">
                            </li>
                            <li>
                                <label for="manufacturer">Manufacturer</label>
                                <select class="default_input" name="manufacturer" id="manufacturer">
                                    <option value="-1" selected>All</option>
                                    <option value="apple">Apple</option>
                                </select>
                            </li>
                            <li>
                                <label for="date">Date</label>
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
                        <h2>Add FAQ</h2>
                        <span class="add_faq_close"><i class="fa-solid fa-x"></i></span>
                    </div>
                    <div class="card">
                        <h3>FAQ Info</h3>
                        <div class="row" style="display: inline-grid;">
                            <div>
                                <label for="add_faq_question">Question</label>
                                <input class="default_input" type="text" minlength="5" id="add_faq_question" placeholder="Enter question">
                            </div>
                        </div>
                        <div class="row" style="display: inline-grid;">
                            <div>
                                <label for="add_faq_answer">Answer</label>
                                <input class="default_input" type="text" minlength="5" id="add_faq_answer" placeholder="Enter answer">
                            </div>
                        </div>
                    </div>
                    <div class="row"><button onclick="createFAQ()">Submit</button></div>
                </div>
            </div>
            <!--Edit FAQ Modal-->
            <div class="edit_faq_modal">
                <div class="edit_faq_main">
                    <div class="edit_faq_main_title">
                        <h2>Edit FAQ</h2>
                        <span class="edit_faq_close"><i class="fa-solid fa-x"></i></span>
                    </div>
                    <div class="card">
                        <h3>FAQ Info</h3>
                        <div class="row" style="display: inline-grid;">
                            <div>
                                <label for="edit_faq_id">ID</label>
                                <input class="default_input" type="text" id="edit_faq_id" disabled>
                            </div>
                            <div>
                                <label for="edit_faq_question">Question</label>
                                <input class="default_input" type="text" minlength="5" id="edit_faq_question" placeholder="Enter question">
                            </div>
                        </div>
                        <div class="row" style="display: inline-grid;">
                            <div>
                                <label for="edit_faq_answer">Answer</label>
                                <input class="default_input" type="text" minlength="5" id="edit_faq_answer" placeholder="Enter answer">
                            </div>
                        </div>
                    </div>
                    <div class="row"><button onclick="updateFAQ()">Submit</button></div>
                </div>
            </div>
            <!-- ======================= FAQs ================== -->
            <div class="faqs">
                <div class="details">
                    <div class="faqsList">
                        <div class="cardHeaderFAQList">
                            <div class="headerFAQ">
                                <h2>FAQs</h2>
                                <a href="#" id="add_faq_a" class="btn">Add</a>
                            </div>
                        </div>
                        <!--FAQs Table-->
                        <div class="faqs-table">
                            <table>
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Question</td>
                                        <td>Answer</td>
                                        <td>Created by</td>
                                        <td>Date</td>
                                        <td>Action</td>
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
                        <h2>Filters</h2>
                        <ul>
                            <li>
                                <label for="search">Search</label>
                                <input class="default_input" type="text" name="search" id="search" placeholder="Search...">
                            </li>
                            <li>
                                <label for="date">Date</label>
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
                            <h2>Add smartphone</h2>
                            <span class="add_smartphone_close"><i class="fa-solid fa-x"></i></span>
                        </div>
                        <div class="card">
                            <h3>Smartphone Info</h3>
                            <div class="row" style="display: inline-grid;">
                                <label for="add_smartphone_title">Title</label>
                                <input class="default_input" type="text" minlength="4" id="smartphone_add_title" placeholder="Enter title">
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_subtitle1">Subtitle1</label>
                                    <input class="default_input" type="text" minlength="10" id="smartphone_add_subtitle1" placeholder="Enter subtitle 1">
                                </div>
                                <div>
                                    <label for="smartphone_add_subtitle2">Subtitle2</label>
                                    <input class="default_input" type="text" minlength="10" id="smartphone_add_subtitle2" placeholder="Enter subtitle 2">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <label for="smartphone_add_price">Price</label>
                                <input class="default_input" type="text" min="0" id="smartphone_add_price" placeholder="Enter price in euros">
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_description">Description</label>
                                    <textarea class="default_textarea" type="text" minlength="4" id="smartphone_add_description" placeholder="Enter a description"></textarea>
                                </div>
                                <div>
                                    <label for="smartphone_add_model">Model</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_model" placeholder="Enter model">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_width">Width</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_width" placeholder="Enter width">
                                </div>
                                <div>
                                    <label for="smartphone_add_height">Height</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_height" placeholder="Enter height">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_thick">Thick</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_thick" placeholder="Enter thick">
                                </div>
                                <div>
                                    <label for="smartphone_add_weight">Weight</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_weight" placeholder="Enter weight">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_display">Display</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_display" placeholder="Enter display">
                                </div>
                                <div>
                                    <label for="smartphone_add_chip">Chip</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_chip" placeholder="Enter chip">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_add_camera">Camera</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_camera" placeholder="Enter camera">
                                </div>
                                <div>
                                    <label for="smartphone_add_os">OS</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_add_os" placeholder="Enter OS">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <span>Storage</span>
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
                                <span>Colors</span>
                                <div class="add_smartphone_color_options_div" style="display: block;">
                                    <input type="checkbox" class="color-options" id="option-black" color="option-black" value="black">
                                    <label for="option-black">Black</label>
                                    <input type="checkbox" class="color-options" id="option-white" color="option-white" value="white">
                                    <label for="option-white">White</label>
                                    <input type="checkbox" class="color-options" id="option-grey" color="option-grey" value="grey">
                                    <label for="option-grey">Grey</label>
                                    <input type="checkbox" class="color-options" id="option-spacegrey" color="option-spacegrey" value="spacegrey">
                                    <label for="option-spacegrey">Space Grey</label>
                                    <input type="checkbox" class="color-options" id="option-gold" color="option-gold" value="gold">
                                    <label for="option-gold">Gold</label>
                                    <input type="checkbox" class="color-options" id="option-silver" color="option-silver" value="silver">
                                    <label for="option-silver">Silver</label>
                                    <input type="checkbox" class="color-options" id="option-rosegold" color="option-rosegold" value="rosegold">
                                    <label for="option-rosegold">Rosegold</label>
                                    <input type="checkbox" class="color-options" id="option-green" color="option-green" value="green">
                                    <label for="option-green">Green</label>
                                    <input type="checkbox" class="color-options" id="option-purple" color="option-purple" value="purple">
                                    <label for="option-purple">Purple</label>
                                    <input type="checkbox" class="color-options" id="option-red" color="option-red" value="red">
                                    <label for="option-red">Red</label>
                                    <input type="checkbox" class="color-options" id="option-yellow" color="option-yellow" value="yellow">
                                    <label for="option-yellow">Yellow</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card" style="width: 61%;margin-right: 0;">
                                <h3>Smartphone Gallery</h3>
                                <div class="row">
                                    <div class="upload-wrapper">
                                        <span class="upload-label">
                                        Upload Thumbnail
                                        </span>
                                        <input type="file" name="add-smartphone-upload-thumbnail" id="add-smartphone-upload-thumbnail" class="upload-input" placeholder="Upload File">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="add_smartphone_image_count">Image Count</label>
                                    <input 105px id="add_smartphone_image_count" type="number" min="0" value="0">
                                </div>
                                <div class="row">
                                    <button onclick="loadColors1()">Load colors</button>
                                </div>
                                <div class="row" style="align-items: flex-start;padding-bottom: 10%;">
                                    <label>Add images</label>
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
                                <h3>Manufacturer</h3>
                                <div class="row">
                                    <label for="add_smartphone_manufacturer_id">Manufacturer name</label>
                                    <select class="default_input" name="add_smartphone_manufacturer_id" id="add_smartphone_manufacturer_id">
                                        <option value="-1">Select...</option>
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
                                    <label for="add_smartphone_stock">Stock</label>
                                    <input class="default_input" type="number" name="add_smartphone_stock" id="add_smartphone_stock" style="width:105px;" min="0" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row"><button onclick="createSmartphone()">Submit</button></div>
                    </div>
                </div>
                <!--Edit Smartphone Modal-->

                <div class="edit_smartphone_modal">
                    <div class="edit_smartphone_main">
                        <div class="edit_smartphone_main_title">
                            <h2>Edit smartphone</h2>
                            <span class="edit_smartphone_close"><i class="fa-solid fa-x"></i></span>
                        </div>
                        <div class="card">
                            <h3>Smartphone Info</h3>
                            <div class="row">
                                <label for="smartphone_edit_id">ID</label>
                                <input class="default_input" type="number" minlength="4" id="smartphone_edit_id" value="" disabled>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <label for="smartphone_edit_title">Title</label>
                                <input class="default_input" type="text" minlength="4" id="smartphone_edit_title" placeholder="Enter title">
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_subtitle1">Subtitle1</label>
                                    <input class="default_input" type="text" minlength="10" id="smartphone_edit_subtitle1" placeholder="Enter subtitle 1">
                                </div>
                                <div>
                                    <label for="smartphone_edit_subtitle2">Subtitle2</label>
                                    <input class="default_input" type="text" minlength="10" id="smartphone_edit_subtitle2" placeholder="Enter subtitle 2">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <label for="smartphone_edit_price">Price</label>
                                <input class="default_input" type="text" min="0" id="smartphone_edit_price" placeholder="Enter price in euros">
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_description">Description</label>
                                    <textarea class="default_textarea" type="text" minlength="4" id="smartphone_edit_description" placeholder="Enter a description"></textarea>
                                </div>
                                <div>
                                    <label for="smartphone_edit_model">Model</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_model" placeholder="Enter model">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_width">Width</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_width" placeholder="Enter width">
                                </div>
                                <div>
                                    <label for="smartphone_edit_height">Height</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_height" placeholder="Enter height">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_thick">Thick</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_thick" placeholder="Enter thick">
                                </div>
                                <div>
                                    <label for="smartphone_edit_weight">Weight</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_weight" placeholder="Enter weight">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_display">Display</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_display" placeholder="Enter display">
                                </div>
                                <div>
                                    <label for="smartphone_edit_chip">Chip</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_chip" placeholder="Enter chip">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <label for="smartphone_edit_camera">Camera</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_camera" placeholder="Enter camera">
                                </div>
                                <div>
                                    <label for="smartphone_edit_os">OS</label>
                                    <input class="default_input" type="text" minlength="4" id="smartphone_edit_os" placeholder="Enter OS">
                                </div>
                            </div>
                            <div class="row" style="display: inline-grid;">
                                <div>
                                    <span>Storage</span>
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
                                <span>Colors</span>
                                <div class="edit_smartphone_color_options_div" style="display: block;">
                                    <input type="checkbox" class="color-options" id="option-black" color="option-black" value="black">
                                    <label for="option-black">Black</label>
                                    <input type="checkbox" class="color-options" id="option-white" color="option-white" value="white">
                                    <label for="option-white">White</label>
                                    <input type="checkbox" class="color-options" id="option-grey" color="option-grey" value="grey">
                                    <label for="option-grey">Grey</label>
                                    <input type="checkbox" class="color-options" id="option-spacegrey" color="option-spacegrey" value="spacegrey">
                                    <label for="option-spacegrey">Space Grey</label>
                                    <input type="checkbox" class="color-options" id="option-gold" color="option-gold" value="gold">
                                    <label for="option-gold">Gold</label>
                                    <input type="checkbox" class="color-options" id="option-silver" color="option-silver" value="silver">
                                    <label for="option-silver">Silver</label>
                                    <input type="checkbox" class="color-options" id="option-rosegold" color="option-rosegold" value="rosegold">
                                    <label for="option-rosegold">Rosegold</label>
                                    <input type="checkbox" class="color-options" id="option-green" color="option-green" value="green">
                                    <label for="option-green">Green</label>
                                    <input type="checkbox" class="color-options" id="option-purple" color="option-purple" value="purple">
                                    <label for="option-purple">Purple</label>
                                    <input type="checkbox" class="color-options" id="option-red" color="option-red" value="red">
                                    <label for="option-red">Red</label>
                                    <input type="checkbox" class="color-options" id="option-yellow" color="option-yellow" value="yellow">
                                    <label for="option-yellow">Yellow</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card" style="width: 61%;margin-right: 0;">
                                <h3>Smartphone Gallery</h3>
                                <div class="row">
                                    <div class="upload-wrapper">
                                        <span class="upload-label">
                                        Upload Thumbnail
                                        </span>
                                        <input type="file" name="edit-smartphone-upload-thumbnail" id="edit-smartphone-upload-thumbnail" class="upload-input" placeholder="Upload File">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="edit_smartphone_image_count">Image Count</label>
                                    <input class="default_input" id="edit_smartphone_image_count" type="number" min="0" value="0">
                                </div>
                                <div class="row">
                                    <button onclick="loadColors2()">Load colors</button>
                                </div>
                                <div class="row" style="align-items: flex-start;padding-bottom: 10%;">
                                    <label for="edit_smartphone_add_images">Add images</label>
                                    <div class="edit_smartphone_images">
                                        <ul>
                                            <li>
                                                <input type="radio" color="black" name="radioButton" class="radio_button" id="radioColor1" checked>
                                                <label title="Black" for="radioColor1" class="block_goodColor__radio block_goodColor__black"></label>
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
                                <h3>Manufacturer</h3>
                                <div class="row">
                                    <label for="edit_smartphone_manufacturer_id">Manufacturer name</label>
                                    <select class="default_input" name="edit_smartphone_manufacturer_id" id="edit_smartphone_manufacturer_id">
                                        <option value="-1">Select...</option>
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
                                    <label for="edit_smartphone_stock">Stock</label>
                                    <input class="default_input" type="number" name="edit_smartphone_stock" id="edit_smartphone_stock" style="width: 105px;" min="0" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row"><button onclick="updateSmartphone()">Submit</button></div>
                    </div>
                </div>

                <div class="details">
                    <div class="cardHeaderSmartphonesList">
                        <div class="headerUsers">
                            <h2>Smartphones</h2>
                            <a href="#" id="add_smartphone_a" class="btn">Add</a>
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
                                        <td>Name</td>
                                        <td>Manufacturer</td>
                                        <td>Price</td>
                                        <td>Rating</td>
                                        <td>Action</td>
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
                        <h2>Filters</h2>
                        <ul>
                            <li>
                                <label for="search">Search</label>
                                <input class="default_input" type="text" name="search" id="search"
                                    placeholder="Search...">
                            </li>
                            <li>
                                <label for="price">Manufacturer</label>
                                <input class="default_input" type="text" name="smartphones-filter2" id="smartphones-filter2"
                                    placeholder="Search...">
                            </li>
                            <li>
                                <label for="smartphones-filter3">Price</label>
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
                                <label for="rating">Rating</label>
                                <select name="rating" id="rating">
                                    <option selected value="-1">All</option>
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
                <h1>Orders</h1>
            </div>
            <!-- ======================= End Orders ================== -->
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="js/auth.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/browser.js"></script>
    <script src="js/userModal.js"></script>
    <script src="js/sliderRange.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>