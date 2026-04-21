<?php 
include('includes/header.php'); 
if(!isset($_SESSION['user_id'])) {
    header("Location: " . SITEURL . "login.php");
    exit();
}
?>

<div class="main-content">
    <div class="container">
        <h2 class="text-center">My Orders</h2>
        <br>
        <?php 
            if(isset($_GET['success'])) {
                echo "<div class='success'>Order placed successfully!</div><br>";
            }
        ?>
        <table class="tbl-full">
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Details</th>
            </tr>
            <?php 
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY order_date DESC";
                $res = mysqli_query($conn, $sql);
                if($res && mysqli_num_rows($res) > 0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td>#<?php echo $row['id']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td>$<?php echo $row['total_amount']; ?></td>
                            <td>
                                <span class="status-<?php echo strtolower(str_replace(' ', '-', $row['status'])); ?>">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                            <td>
                                <a href="order-details.php?id=<?php echo $row['id']; ?>" class="btn-secondary">View</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No orders found.</td></tr>";
                }
            ?>
        </table>
    </div>
</div>

<?php include('includes/footer.php'); ?>
