<?php
    include '../system/connection.php';
    session_start();
    $admin_id=$_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location :login.php');
    }
    $get_id= $_GET['post_id'];

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
            <h1>read products</h1>
        </div>
        <div class="title2">
            <a href="dashboad.php">Home</a><span> / read products</span>
        </div>
        <section class="read-post">
            <h1 class="heading">read products</h1>
            <div class="box-container">
                <?php
                    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_product->execute([$get_id]);
                    if($select_product->rowCount() > 0 ){
                        while($fetch_product =$select_product->fetch(PDO::FETCH_ASSOC)){
                ?>
                <form action="" method="post">
                    <input type="hidden"  name="product_id" value="<?=$fetch_product ['id'];?>">
                    <?php if($fetch_product['image'] != ''){ ?>
                        <img src="../image/<?= $fetch_product['image']; ?>" class="image" alt="">
                    <?php } ?>
                    <div class="status" style="color: <?php if($fetch_product['status'] == 'active') { echo "green";} else {echo"red";}?>;">
                        <?= $fetch_product['status'];?></div>
                        <div class="title"><?= $fetch_product['name'];?></div>
                        <div class="price"><?= $fetch_product['price'];?></div>
                        <div class="detail"><?= $fetch_product['product_detail'];?></div>
                </form>
                <?php            
                        }
                    }
                ?>
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