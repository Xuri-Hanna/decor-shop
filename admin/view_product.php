<?php
    include '../system/connection.php';
    session_start();
    $admin_id=$_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location :login.php');
    }
    // delete product
    if (isset($_POST['delete'])){
        $p_id =$_POST['product_id'];

        
        $delete_product=$conn->prepare("DELETE  FROM `products` WHERE id = ?");
        $delete_product->execute([$p_id]);
        $success_msg[] ='product deleted sucessfully';

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
            <h1>all products</h1>
        </div>
        <div class="title2">
            <a href="dashboad.php">Home</a><span> / all products</span>
        </div>
        <section class="show-post">
            <h1 class="heading">all products</h1>
            <div class="box-container">
            <?php
                $select_product= $conn->prepare("SELECT * FROM `products`");
                $select_product->execute();
                if($select_product->rowCount() > 0){
                    while($fetch_product =$select_product->fetch(PDO::FETCH_ASSOC)){

                ?>
                <form action="" class="box" method="post">
                <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                    <?php if($fetch_product['image'] != ''){ ?>
                        <img src="../image/<?= $fetch_product['image']; ?>" class="image" alt="">
                    <?php } ?>
                    <div class="status" style="color: <?php if($fetch_product['status'] == 'active') { echo "green";} else {echo"red";}?>;">
                        <?= $fetch_product['status'];?></div>
                        <div class="price"><?= $fetch_product['price'];?></div>
                        <div class="title"><?= $fetch_product['name'];?></div>
                        <div class="flex-btn">
                            <a href="edit_product.php?id=<?= $fetch_product['id']?>" class="btn">edit </a>
                            <button type="submit" name="delete" class="btn" onclick="return confirm('delete this product');">delete</button>
                        </div>
                </form>
                <?php
                        }
                    }else{
                        echo'<div class="empty">
                                <p> no product added yet <br><a href="add_product.php" style="margin: top 1.5rem;" class="btn"> add product</a></p>
                            </div>';
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