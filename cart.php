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
//delete item
    if(isset($_POST['delete_item'])){
        $cart_id = $_POST['cart_id'];
        $cart_id = filter_var($cart_id,FILTER_SANITIZE_STRING);

        $Vvarify_delete_item = $conn->prepare("SELECT* FROM `cart` WHERE id = ?");
        $Vvarify_delete_item->execute([$cart_id]);
        
        if($Vvarify_delete_item->rowCount()>0){
            $delete_cart_id=$conn->prepare("DELETE FROM `cart` WHERE id=?");
            $delete_cart_id->execute([$cart_id]);
            $success_msg[] ="cart item delete successfully";
        }else{
            $success_msg[] ="cart item already deleted";
        }

    }
    //empty cart
    if(isset($_POST['empty_cart'])){
        
        $Vvarify_empty_item = $conn->prepare("SELECT* FROM `cart` WHERE user_id = ?");
        $Vvarify_empty_item->execute([$user_id]);
        if($Vvarify_empty_item ->rowCount()>0){
            $delete_cart_id=$conn->prepare("DELETE FROM `cart` WHERE user_id=?");
            $delete_cart_id->execute([$user_id]);
            $success_msg[] ="cart item delete successfully";
        }else{
            $success_msg[] ="cart item already deleted";
        }
    }
    //update product
    if(isset($_POST['update_cart'])){
        $cart_id = $_POST['cart_id'];
        $cart_id = filter_var($cart_id,FILTER_SANITIZE_STRING);

        $qty =$_POST['qty'];
        $qty =filter_var($qty,FILTER_SANITIZE_STRING);

        $update_qty=$conn->prepare("UPDATE `cart` SET qty =? WHERE id=?");
        $update_qty->execute([$qty,$cart_id]);

        $success_msg[]='cart update successfully';
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
            <a href="home.php">home/ </a><span>cart</span>
        </div>
        <section class="products">
            <h1 class="title"> Product added in cart</h1>
            <div class="box-container">
                <?php   
                    $grand_total=0;
                    $select_cart =$conn->prepare("SELECT * FROM `cart` WHERE user_id =?");
                    $select_cart ->execute([$user_id]);
                    if($select_cart->rowCount() > 0){
                        while($fetch_cart =$select_cart->fetch(PDO::FETCH_ASSOC)){
                            $select_product=$conn->prepare("SELECT * FROM `products` WHERE id = ?");
                            $select_product->execute([$fetch_cart['product_id']]);
                            if($select_product->rowCount()>0){
                                $fetch_product =$select_product->fetch(PDO::FETCH_ASSOC);
                    
                ?>
                <form action="" method="post" class="box">
                    <input type="hidden" name="cart_id" value="<?=$fetch_cart['id']; ?>">
                    <img src="image/<?=$fetch_product['image']; ?>" class="img" alt="">
                    <h3 class="name"> <?= $fetch_product['name'];?></h3>
                    <div class="flex">
                        <p class="price">price: <?= $fetch_product['price'];?>VNĐ</p>
                        <input type="number" name="qty" required min="1" value="<?=$fetch_cart['qty']; ?>" max="99" maxlength="2" class="qty">
                        <button type="submit" name="update_cart" class="bx bxs-edit fa-edit"></button>
                    </div>
                    <p class="sub-total">sub total : <span> <?=$sub_toal =($fetch_cart['qty'] * $fetch_cart['price']) ?>.000VNĐ</span></p>
                    <button type="submit" name="delete_item" class="btn" onclick="return confirm('delete this item?')">delete</button>
                </form>

                <?php
                    $grand_total+=$sub_toal;
                             }else{
                                echo '<p class="empty">  product was not found</p>';
                             }
                        }
                    }else{
                        echo '<p class="empty"> no product added yet</p>';
                    }
                ?>
            </div>
            <?php
                if($grand_total !=0){
            ?>
            <div class="cart-total">
                <p>total amount payable: <span> <?= $grand_total;?>.000VNĐ</span></p>
                <div class="button">
                    <form action="" method="post">
                        <button type="submit" name="empty_cart" class="btn" onclick="return confirm('are you sure to empty your cart')">empty cart</button>
                    </form>
                    <a href="checkout.php" class="btn">proceed to checkout</a>
                </div>
            </div>
            <?php
                }
            ?>
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