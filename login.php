<?php 
require_once 'includes/auth.php';
include('includes/header.php');

if(isset($_POST['submit'])) {
    $email = clean_input($_POST['email']);
    $password = $_POST['password'];
    
    $user = login_user($email, $password);
    if($user) {
        $_SESSION['login_msg'] = "<div class='success'>Login Successful.</div>";
        if($user['role'] == 'admin') {
            header("Location: " . SITEURL . "admin/index.php");
        } else {
            header("Location: " . SITEURL . "index.php");
        }
        exit();
    } else {
        $_SESSION['login_msg'] = "<div class='error text-center'>Email or Password did not match.</div>";
    }
}
?>

<div class="login-content">
    <div class="login-container">
        <div class="login-box">
            <h2 class="text-center">Login</h2>
            <br>
            <?php 
                if(isset($_SESSION['login_msg'])) {
                    echo $_SESSION['login_msg'];
                    unset($_SESSION['login_msg']);
                }
            ?>
            <form action="" method="POST" class="text-center">
                <input type="email" name="email" placeholder="Enter Email" required><br>
                <input type="password" name="password" placeholder="Enter Password" required><br>
                <input type="submit" name="submit" value="Login" class="login-btn">
            </form>
            <br>
            <p class="text-center">New user? <a href="register.php">Register here</a></p>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
