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
 //adding cart
 if(isset($_POST['add_to_cart'])){
    $id=unique_id();
    $product_id=$_POST['product_id'];

    $qty= 1;
    $qty = filter_var($qty , FILTER_SANITIZE_STRING);

    $varify_cart= $conn->prepare("SELECT *FROM `cart` WHERE user_id =? AND product_id=?");
    $varify_cart->execute([$user_id,$product_id]);

    $max_cart_items= $conn->prepare("SELECT* FROM `cart` WHERE user_id = ?");
    $max_cart_items->execute([$user_id]);

    if($varify_cart->rowCount() > 0){
        $warning_msg[]='product already exist in your wishlist';
    }else if($max_cart_items->rowCount() > 20){
        $warning_msg[] ='cart  is full';
    }else{
        $select_price =$conn->prepare("SELECT * FROM `products` WHERE id =? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_cart =$conn->prepare("INSERT INTO `cart` (id,user_id,product_id,price,qty) VALUES(?,?,?,?,?)");
        $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'],$qty]);
        $success_msg[]='product added to cart succesfully';
}
}
//delete item
    if(isset($_POST['delete_item'])){
        $wishlist_id = $_POST['wishlist_id'];
        $wishlist_id = filter_var($wishlist_id,FILTER_SANITIZE_STRING);

        $Vvarify_delete_item = $conn->prepare("SELECT* FROM `wishist` WHERE id = ?");
        $Vvarify_delete_item->execute([$wishlist_id]);
        
        if($Vvarify_delete_item->rowCount()>0){
            $delete_wishlist_id=$conn->prepare("DELETE FROM `wishist` WHERE id=?");
            $delete_wishlist_id->execute([$wishlist_id]);
            $success_msg[] ="wishlist item delete successfully";
        }else{
            $success_msg[] ="wishlist item already deleted";
        }

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
       <?php include 'header.php' ;?>
    </div>
    <div class="main">
    <div class="banner">
            <h1>wishist</h1>
        </div>
        <div class="title2">
            <a href="home.php">home/ </a><span>wishist</span>
        </div>
        <section class="products">
            <h1 class="title"> Product added to wishist</h1>
            <div class="box-container">
                <?php   
                    $grand_total=0;
                    $select_wishlist =$conn->prepare("SELECT * FROM `wishist` WHERE user_id =?");
                    $select_wishlist ->execute([$user_id]);
                    if($select_wishlist->rowCount() > 0){
                        while($fetch_wishlist =$select_wishlist->fetch(PDO::FETCH_ASSOC)){
                            $select_product=$conn->prepare("SELECT * FROM `products` WHERE id = ?");
                            $select_product->execute([$fetch_wishlist['product_id']]);
                            if($select_product->rowCount()>0){
                                $fetch_product =$select_product->fetch(PDO::FETCH_ASSOC);
                    
                ?>
                <form action="" method="post" class="box">
                    <input type="hidden" name="wishlist_id" value="<?=$fetch_wishlist['id']; ?>">
                    <img src="imgage/<?=$fetch_product['image']; ?>" class="img" alt="">
                    <div class="button">
                        <button type="submit" name="add_to_cart"><i class="bx bx-cart cart" ></i></button>
                        <a href="view_page.php?pid=<?php echo $fetch_product['id']; ?>" class="bx bx-loader heart"></a>
                        <button type="submit" name="delete_item" onclick="return confirm('delete this item')"><i class="bx bx-x x"></i></button>
                    </div> 
                    <h3 class="name"> <?= $fetch_product['name'];?></h3>
                    <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                    <div class="flex">
                        <p class="price">price: <?= $fetch_product['price'];?>VNĐ</p>
                    </div>
                    <a href="checkout.php?get_id<?=$fetch_product['id'];?>" class="btn">buy now</a>
                </form>

                <?php
                    $grand_total+=$fetch_wishlist['price'];
                             }
                        }
                    }else{
                        echo '<p class="empty"> no product added yet</p>';
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