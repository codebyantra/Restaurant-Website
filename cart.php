<?php
include('includes/header.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['login_msg'] = "<div class='error text-center'>Please login to access cart.</div>";
    header("Location: " . SITEURL . "login.php");
    exit();
}


?>
<link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/cart.css">
<section class="cart-section">
    <div class="container">

        <h2 class="cart-title">Your Cart</h2>

        <!-- CART ITEMS -->
        <div class="cart-wrapper">

            <div class="cart-items">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Food</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody id="cart-items">
                        <!-- JS will inject items here -->
                    </tbody>
                </table>
            </div>

            <!-- SUMMARY -->
            <div class="cart-summary">
                <h3>Bill Summary</h3>

                <div class="summary-row">
                    <span>Items Total</span>
                    <span>₹<span id="cart-total">0</span></span>
                </div>

                <div class="summary-row">
                    <span>Delivery</span>
                    <span>₹30</span>
                </div>

                <div class="summary-row">
                    <span>Tax</span>
                    <span>₹20</span>
                </div>

                <hr>

                <div class="summary-row total">
                    <span>Grand Total</span>
                    <span>₹<span id="final-total">0</span></span>
                </div>

                <a href="checkout.php" class="checkout-btn">
                    Proceed to Checkout
                </a>
            </div>

        </div>

    </div>
</section>

<script src="<?php echo SITEURL; ?>assets/js/script.js"></script>
