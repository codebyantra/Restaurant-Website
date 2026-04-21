<?php $page = 'checkout'; ?>
<?php 
require_once 'includes/auth.php';
include('includes/header.php');
 

if(!isset($_SESSION['user_id'])) {
    header("Location: " . SITEURL . "login.php");
    exit();
}

// Fetch user details for the form
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$res = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($res);

if(isset($_POST['submit'])) {
    $total_amount = $_POST['total_amount'];
    $customer_name = clean_input($_POST['full_name']);
    $customer_contact = clean_input($_POST['phone']);
    $customer_email = clean_input($_POST['email']);
    $customer_address = clean_input($_POST['address']);
    
    // 1. Create Order
    $sql_order = "INSERT INTO orders (user_id, total_amount, status, customer_name, customer_contact, customer_email, customer_address) 
                  VALUES (?, ?, 'Ordered', ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_order);
    $stmt->bind_param("idssss", $user_id, $total_amount, $customer_name, $customer_contact, $customer_email, $customer_address);
    
    if($stmt->execute()) {
        $order_id = $conn->insert_id;
        
        // 2. Add Order Items (from hidden input or session)
        $cart_data = json_decode($_POST['cart_data'], true);
        foreach($cart_data as $item) {
            $food_id = $item['id'];
            $qty = $item['quantity'];
            $price = $item['price'];
            
            $sql_item = "INSERT INTO order_items (order_id, food_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt_item = $conn->prepare($sql_item);
            $stmt_item->bind_param("iiid", $order_id, $food_id, $qty, $price);
            $stmt_item->execute();
        }
        
        echo "<script>localStorage.removeItem('cart'); window.location.href='orders.php?success=1';</script>";
        exit();
    }
}
?>

<div class="checkout-content">
    <div class="checkout-container">
        <h2 class="text-center">Checkout</h2>
        <br>
        <form action="" method="POST" id="checkout-form">
            <div class="order-details">
                <fieldset>
                    <legend>Selected Foods</legend>
                    <div id="checkout-items"></div>
                    <div class="text-right">
                        <strong>Total: $<span id="checkout-total">0.00</span></strong>
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" value="<?php echo $user['full_name']; ?>" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="phone" value="<?php echo $user['phone']; ?>" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" required><?php echo $user['address']; ?></textarea>

                    <input type="hidden" name="total_amount" id="form-total">
                    <input type="hidden" name="cart_data" id="form-cart-data">
                    
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </div>
        </form>
    </div>
</div>

<script>
    // Load cart data into checkout form
    window.onload = function() {
        const cart = JSON.parse(localStorage.getItem('cart')) || []; 
        if(cart.length === 0) {
            window.location.href = 'index.php';
            return;
        }
        
        let total = 0;
        let html = '';
        cart.forEach(item => {
            total += item.price * item.quantity;
            html += `<p>${item.name} x ${item.quantity} = $${(item.price * item.quantity).toFixed(2)}</p>`;
        });
        
        document.getElementById('checkout-items').innerHTML = html;
        document.getElementById('checkout-total').innerText = total.toFixed(2);
        document.getElementById('form-total').value = total;
        document.getElementById('form-cart-data').value = JSON.stringify(cart);
    };
</script>

<?php include('includes/footer.php'); ?>
