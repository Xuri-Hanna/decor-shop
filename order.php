<?php 
    include 'system/connection.php';
    include 'system/allert.php';
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id=$_SESSION['user_id'];
    }else{
        $user_id='';
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header("location: login.php");
    }

?>
<style type="text/css">
   <?php include 'style/style.css';?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Decor shop</title>
</head>
<body>
    <div>
        <?php include'header.php';?>    
    </div>
    <div class="main">
        <div class="banner">
            <h1>Order</h1>
        </div>
        <div class="title2">
            <a href="home.php">home / </a><span>order</span>
        </div>
        <section class="orders">
                <div class="title">
                    <img src="img/logoshop.png"  class="logo">
                    <h1> My order</h1>
                    <p> Please make sure you have checked enough products in your shopping cart</p>
                </div>
                <div class="box-container">
                    <?php
                        $select_order=$conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
                        $select_order->execute([$user_id]);
                        if($select_order->rowCount()>0){
                            while($fecth_order =$select_order->fetch(PDO::FETCH_ASSOC)){
                                $select_product =$conn->prepare("SELECT * FROM `products` WHERE id = ?");
                                $select_product->execute([$fecth_order['product_id']]);
                                if($select_product->rowCount()>0){
                                    while($fetch_product=$select_product->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <div class="box" <?php if($fecth_order['status'] == 'cancel') { echo 'style="border:2px soild red";';}?>>
                        <a href="view_order.php?get_id=<?= $fecth_order['id']; ?>">
                            <p class="date"><i class="bi bi-calender-fill"></i><span><?=$fecth_order['date']; ?></span></p>
                            <img src="img/<?= $fetch_product['image']; ?>" class="img">
                            <div class="row">
                                <h3 class="name"><?=$fetch_product['name']; ?></h3>
                                <p class="price"> Price: <?=$fecth_order['price'];?> X <?=$fecth_order['qty'];?></p>
                                <p class="status" style="color: <?php if($fecth_order['status'] == 'deliverd'){
                                    echo 'green';}else if($fecth_order['status'] == 'canceled'){ echo'red';}else{
                                    echo 'orange';} ?>"></p>
                            </div>
                        </a>
                    </div>
                    <?php                                    
                                    }
                                }
                            }
                        }else {
                            echo '<p class="empty"> no order takes placed yet</p>';
                        }
                    ?>
                </div>
        </section>
        
              <?php include'footer.php';?>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php 
        include 'system/allert.php';
    ?>
</body>
</html>