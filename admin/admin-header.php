<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/food_order_system/includes/auth.php');

if(!is_admin()) {
    $_SESSION['login_msg'] = "<div class='error text-center'>Access Denied. Admin login required.</div>";
    header("Location: " . SITEURL . "login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Foodie</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/admin.css">
    <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/cart.css">
    <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/checkout.css">
</head>
<body>
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
