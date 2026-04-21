<?php include('includes/header.php'); ?>

<!-- ================= HERO SECTION ================= -->
<section class="hero">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1>Delicious Food Delivered To You</h1>
            <p>Fresh • Fast • Tasty</p>
            <a href="#food-menu" class="btn-primary">Order Now</a>
        </div>
    </div>
</section>

<!-- ================= SEARCH ================= -->
<section class="search-box">
    <div class="container">
        <div class="search-header">
        <h2>Find Your Favorite Food</h2>
        </div>
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST" class="search-form">
            <input type="search" name="search" placeholder="Search for food..." required>
            <button type="submit">Search</button>
        </form>

    </div>
</section>


<!-- ================= CATEGORIES ================= -->
<section id="categories" class="category-section">
    <div class="container">

        <div class="category-header">
            <h2>Explore Categories</h2>
            <a href="#">+ More</a>
        </div>

        <div class="category-grid">

            <?php
            $sql = "SELECT * FROM categories WHERE active='Yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);

            if ($res && mysqli_num_rows($res) > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['name'];
                    $image_name = $row['image_name'];
            ?>

                <a href="#" class="category-card">
                    <img src="<?php echo SITEURL; ?>assets/images/<?php echo $image_name; ?>">
                    <span><?php echo $title; ?></span>
                </a>

            <?php
                }

            } else {
                // 👇 DUMMY UI CARDS (layout ke liye)
            ?>

                <div class="category-card">
                    <img src="assets/images/pizza.jpg">
                    <span>pizza</span>
                </div>

                <div class="category-card">
                    <img src="assets/images/burger.jpg">
                    <span>Burger</span>
                </div>

                <div class="category-card">
                    <img src="assets/images/chinese.jpg">
                    <span>Chinese</span>
                </div>

            <?php } ?>

        </div>
    </div>
</section>


<!-- ================= FEATURED FOODS ================= -->
<section class="food-section" id="food-menu">
    <div class="container">

        <h2 class="text-center">Featured Foods</h2>

        <div class="food-grid">

            <?php
            $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 && mysqli_num_rows($res2) > 0) {

                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
            ?>

            <div class="food-card">
                <div class="food-img">
                    <img src="<?php echo SITEURL; ?>assets/images/food/<?php echo $image_name; ?>">
                </div>

                <div class="food-info">
                    <h4><?php echo $title; ?></h4>
                    <p class="price">₹<?php echo $price; ?></p>
                    <p class="desc"><?php echo $description; ?></p>

                   <button onclick="addToCart(1,'Cheese Burger',149)">
                        Add to Cart
                    </button>


                </div>
            </div>

            <?php
                }

            } else {
                // 👇 DUMMY FOOD CARDS (UI ke liye)
            ?>

            <div class="food-card">
                <div class="food-img">
                    <img src="assets/images/cheese-burger.jpg">
                </div>
                <div class="food-info">
                    <h4>Cheese Burger</h4>
                    <p class="price">₹149</p>
                    <p class="desc">Juicy burger with cheese & fresh veggies</p>
                   <button type="button" onclick="addToCart(1,'Cheese Burger',149,this)">
                        Add to Cart
                    </button>



                </div>
            </div>

            <div class="food-card">
                <div class="food-img">
                    <img src="assets/images/pizza2.jpg">
                </div>
                <div class="food-info">
                    <h4>Pizza</h4>
                    <p class="price">₹299</p>
                    <p class="desc">Loaded cheese pizza with toppings</p>
                   <button type="button" onclick="addToCart(2,'Pizza',299,this)">
                        Add to Cart
                    </button>



                </div>
            </div>
            <div class="food-card">
                <div class="food-img">
                    <img src="assets/images/sandwich.jpg">
                </div>
                <div class="food-info">
                    <h4>Sandwich</h4>
                    <p class="price">₹99</p>
                    <p class="desc">Grilled sandwich with fresh filling</p>
                   <button type="button" onclick="addToCart(3,'Sandwich',99,this)">
                        Add to Cart
                    </button>



                </div>
            </div>

            <div class="food-card">
                <div class="food-img">
                    <img src="assets/images/fries.jpg">
                </div>
                <div class="food-info">
                    <h4>French Fries</h4>
                    <p class="price">₹79</p>
                    <p class="desc">Crispy golden fries</p>
                   <button type="button" onclick="addToCart(4,'French Fries',79,this)">
                        Add to Cart
                    </button>



                </div>
            </div>

            <div class="food-card">
                <div class="food-img">
                    <img src="assets/images/noodles.jpg">
                </div>
                <div class="food-info">
                    <h4>Noodles</h4>
                    <p class="price">₹199</p>
                    <p class="desc">Hot spicy noodles</p>
                   <button type="button" onclick="addToCart(5,'Noodles',199,this)">
                        Add to Cart
                    </button>



                </div>
            </div>

            <div class="food-card">
                <div class="food-img">
                    <img src="assets/images/paasta.jpg">
                </div>
                <div class="food-info">
                    <h4>Pasta</h4>
                    <p class="price">₹249</p>
                    <p class="desc">Creamy Italian pasta</p>
                   <button type="button" onclick="addToCart(6,'Pasta',249,this)">
                        Add to Cart
                    </button>



                </div>
            </div>

            <?php } ?>

        </div>

        <div class="view-all">
            <a href="<?php echo SITEURL; ?>foods.php" class="btn-main">View All Foods</a>
        </div>

    </div>
</section>

<?php include('includes/footer.php'); ?>
