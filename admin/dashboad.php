<?php
    include '../system/connection.php';
    session_start();
    $admin_id=$_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location :login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin_style.css?v=<?php echo time()?>">
    <title>SHOP ADMIN PAGE</title>
</head>
<body> 
    <?php 
        include 'header.php';
    ?>
    <div class="main">
        <div class="banner">
            <h1>dashboard</h1>
        </div>
        <div class="title2">
            <a href="dashboad.php">Home</a><span> / dashboard</span>
        </div>
        <section class="dashboard">
            <h1 class="heading">dashboard</h1>
            <div class="box-container">
                <div class="box">
                    <h3>welcome!</h3>
                    <p><?= $fetch_profile['name']; ?></p>
                    <a href="" class="btn">profile</a>
                </div>
                <div class="box">
                   <?php 
                        $select_product =$conn->prepare("SELECT * FROM `products`");
                        $select_product->execute();
                        $num_product=$select_product->rowCount();
                   ?>
                   <h3><?= $num_product; ?></h3>
                   <p>product added</p>
                   <a href="add_product.php" class="btn">add new product</a>
                </div>
                <div class="box">
                   <?php 
                        $select_active_product =$conn->prepare("SELECT * FROM `products` WHERE status = ?");
                        $select_active_product->execute(['active']);
                        $num_active_product=$select_active_product->rowCount();
                   ?>
                   <h3><?= $num_active_product; ?></h3>
                   <p>total active products</p>
                   <a href="view_product.php" class="btn">View active product</a>
                </div>
                <div class="box">
                   <?php 
                        $select_deactive_product =$conn->prepare("SELECT * FROM `products` WHERE status = ?");
                        $select_deactive_product->execute(['deactive']);
                        $num_deactive_product=$select_deactive_product->rowCount();
                   ?>
                   <h3><?= $num_deactive_product; ?></h3>
                   <p>total deactive products</p>
                   <a href="view_product.php" class="btn">View deactive product</a>
                </div>
                <div class="box">
                   <?php 
                        $select_user =$conn->prepare("SELECT * FROM `users`");
                        $select_user->execute();
                        $num_user=$select_user->rowCount();
                   ?>
                   <h3><?= $num_user; ?></h3>
                   <p>registed users</p>
                   <a href="account.php" class="btn">view user</a>
                </div>
                <div class="box">
                   <?php 
                        $select_admin =$conn->prepare("SELECT * FROM `admin`");
                        $select_admin->execute();
                        $num_admin=$select_admin->rowCount();
                   ?>
                   <h3><?= $num_admin; ?></h3>
                   <p>registed admin</p>
                   <a href="account.php" class="btn">view admin</a>
                </div>
                <div class="box">
                   <?php 
                        $select_message =$conn->prepare("SELECT * FROM `message`");
                        $select_message->execute();
                        $num_message=$select_message->rowCount();
                   ?>
                   <h3><?= $num_message; ?></h3>
                   <p>unreaded message</p>
                   <a href="message.php" class="btn">view message</a>
                </div>
                <div class="box">
                   <?php 
                        $select_orders =$conn->prepare("SELECT * FROM `orders`");
                        $select_orders->execute();
                        $num_orders=$select_orders->rowCount();
                   ?>
                   <h3><?= $num_orders; ?></h3>
                   <p>total orders placed</p>
                   <a href="order.php" class="btn">view orders</a>
                </div>
                <div class="box">
                   <?php 
                        $select_confirm_orders =$conn->prepare("SELECT * FROM `orders` WHERE status =?");
                        $select_confirm_orders->execute(['in progress']);
                        $num_confirm_orders=$select_confirm_orders->rowCount();
                   ?>
                   <h3><?= $num_confirm_orders; ?></h3>
                   <p>total confirm orders </p>
                   <a href="order.php" class="btn">view confirm orders</a>
                </div>
                <div class="box">
                   <?php 
                        $select_canceled_orders =$conn->prepare("SELECT * FROM `orders` WHERE status =?");
                        $select_canceled_orders->execute(['canceled']);
                        $num_canceled_orders=$select_canceled_orders->rowCount();
                   ?>
                   <h3><?= $num_canceled_orders; ?></h3>
                   <p>total canceled orders </p>
                   <a href="order.php" class="btn">view canceled orders</a>
                </div>
            </div>
        </section>
    </div>
      <!--sweetalert cdn link -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php 
        include 'alert.php';
    ?>
</body>
</html>