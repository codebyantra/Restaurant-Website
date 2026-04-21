<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodie - Online Food Ordering</title>

    <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/login.css">
    <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/register.css">
   <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/checkout.css">
</head>

<body>

<header class="navbar">
    <div class="container nav-flex">

        <div class="logo">
            <a href="<?php echo SITEURL; ?>">
                <img src="<?php echo SITEURL; ?>assets/images/logo.png" alt="Foodie Logo">
            </a>
        </div>

        <nav class="menu">
            <ul>
                <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                <li><a href="<?php echo SITEURL; ?>index.php#food-menu">Foods</a></li>
                <li><a href="<?php echo SITEURL; ?>index.php#categories">Categories</a></li>


                <?php if(isset($_SESSION['user_id'])): ?>

                    <li><a href="<?php echo SITEURL; ?>cart.php">Cart</a></li>
                    <li><a href="<?php echo SITEURL; ?>orders.php">My Orders</a></li>

                    <?php if($_SESSION['user_role'] == 'admin'): ?>
                        <li><a href="<?php echo SITEURL; ?>admin/index.php">Admin</a></li>
                    <?php endif; ?>

                    <li class="user-btn">
                        <a href="<?php echo SITEURL; ?>logout.php">
                            Logout (<?php echo $_SESSION['user_name']; ?>)
                        </a>
                    </li>

                <?php else: ?>

                    <li><a href="<?php echo SITEURL; ?>login.php">Login</a></li>
                    <li class="user-btn">
                        <a href="<?php echo SITEURL; ?>register.php">Register</a>
                    </li>
                    

                <?php endif; ?>
            </ul>
        </nav>

    </div>
</header>
