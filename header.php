<header class="header">
    <div class="flex">
        <a href="home.php" class="logo"><img src="img/logo/104540-OMG7QN-486.jpg" alt=""></a>
        <nav class="navbar" id="navbar">
            <a href="home.php">Home</a>
            <a href="view_product.php">Product</a>
            <a href="order.php">Orders</a>
            <a href="about.php">Abouts Us</a>
            <a href="contact.php">Contact Us</a>
        </nav>
        <div class="icons">
            <i class="bx bxs-user" id="user-btn"></i>
            <?php
                $count_wishlist_items = $conn->prepare("SELECT * FROM `wishist` WHERE user_id =?");
                $count_wishlist_items->execute([$user_id]);
                $total_wishlist_item = $count_wishlist_items->rowCount();
            ?>
            <a href="wishlist.php" class="cart-btn"><i class="bx bx-heart"></i><sup><?= $total_wishlist_item?></sup></a>
            <?php
                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id =?");
                $count_cart_items->execute([$user_id]);
                $total_cart_item = $count_cart_items->rowCount();
            ?>
            <a href="cart.php" class="cart-btn"><i class="bx bx-cart-download"></i><sup><?= $total_cart_item?></sup></a>
            <i class="bx bx-list-plus" id="menu-btn" style="font-size: 2rem;"></i>
        </div>
        <div class="user-box" id="user-box">
            <p style="color: white;">usename : <span><?php 
                if (!empty($_SESSION['user_name'])){
                    echo $_SESSION['user_name'];
                }else{
                    echo 'NOT SIGN IN';
                }
                ?></span></p>
            <p style="color: white;">email : <span><?php  
                if(!empty($_SESSION['user_email'])){
                    echo $_SESSION['user_email'];
                }else{
                    echo 'NOT SIGN IN';
                }
                ?></span></p>
            <a href="login.php" class="btn">Login</a>
            <a href="resigter.php" class="btn">register</a>
            <form action="" method="post">
                <button type="submit" name="logout" class="logout-btn">Log out</button>
            </form>
        </div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="script/navbar.js"></script>
    </div>
</header>