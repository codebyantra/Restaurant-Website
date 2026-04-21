<?php 
require_once 'includes/auth.php';
include('includes/header.php'); 

if(isset($_POST['submit'])) {
    $full_name = clean_input($_POST['full_name']);
    $email = clean_input($_POST['email']);
    $password = $_POST['password'];
    $phone = clean_input($_POST['phone']);
    $address = clean_input($_POST['address']);
    
    if(register_user($full_name, $email, $password, $phone, $address)) {
        $_SESSION['login_msg'] = "<div class='success'>Registration Successful. Please Login.</div>";
        header("Location: " . SITEURL . "login.php");
        exit();
    } else {
        $_SESSION['reg_msg'] = "<div class='error'>Registration Failed. Email might already exist.</div>";
    }
}
?>

<div class="register-content">
    <div class="register-container">
        <div class="register-box">
            <h2 class="text-center">Register</h2>
            <?php 
                if(isset($_SESSION['reg_msg'])) {
                    echo $_SESSION['reg_msg'];
                    unset($_SESSION['reg_msg']);
                }
            ?>
            <form action="" method="POST" class="text-center">
                <input type="text" name="full_name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="phone" placeholder="Phone Number" required>
                <textarea name="address" placeholder="Address" required></textarea>
                <input type="submit" name="submit" value="Register" class="login-btn">
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
