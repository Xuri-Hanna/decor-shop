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
    if(isset($_POST['place_order'])){
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $address= $_POST['flat'].',' .$_POST['street'].', '.$_POST['city'];
        $address_type =$_POST['address_type'];
        $method =$_POST['method'];

        $varify_cart=$conn->prepare("SELECT * FROM `cart` WHERE user_id =?");
        $varify_cart->execute([$user_id]);

        if(isset($_GET['get_id'])){
            $get_product =$conn->prepare("SELECT * FROM `products` Where id =? limit 1");
            $get_product->execute([$_GET['get_id']]);
            if($get_product->rowCount()>0){
                while($fetch_p =$get_product->fetch(PDO::FETCH_ASSOC)){
                    $insert_order=$conn->prepare("INSERT INTO `orders`(id,user_id,name,number,email,address,address_type,method,product_id,price,qty) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                    $insert_order->execute([unique_id(),$user_id,$name,$number,$email,$address,$address_type,$method,$fetch_p['id'],$fetch_p['price'],1]);
                    header('location: order.php');
                }
            }else{
                $warning_msg[] ='something went wrong ';
            }
        }else if($varify_cart->rowCount()>0){
            while($f_cart=$varify_cart->fetch(PDO::FETCH_ASSOC)){
                $insert_order=$conn->prepare("INSERT INTO `orders`(id,user_id,name,number,email,address,address_type,method,product_id,price,qty) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                    $insert_order->execute([unique_id(),$user_id,$name,$number,$email,$address,$address_type,$method,$f_cart['product_id'],$f_cart['price'],$f_cart['qty']]);
                    header('location: order.php');
            }
            if($insert_order){
                $delete_cart_id=$conn->prepare("DELETE * FROM `cart` WHERE user_id =?");
                $delete_cart_id->execute([$user_id]);
                header('location: order.php');
            }
        }else {
            $warning_msg[] ='something went wrong ';
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
        <?php include'header.php';?>    
    </div>
    <div class="main">
    <div class="banner">
            <h1>Check out</h1>
        </div>
        <div class="title2">
            <a href="home.php">home/</a><span>checkout sumary</span>
        </div>
        <section class="checkout">
            <div class="title">
                <img src="img/logoshop.png" alt="" class="logo">
                <h1>checkout sumary</h1>
                <p>Thank you for your trust and choosing us, see you again soon</p>
            </div>
                <div class="row">
                    <form action="" method="post">
                        <h3>billing detail</h3>
                        <div class="flex">
                            <div class="box">
                                <div class="input-field">
                                    <p>Your name</p>
                                    <input type="text" name="name" required maxlength="90" placeholder="enter your name" class="input">
                                </div>
                                <div class="input-field">
                                    <p>Your number </p>
                                    <input type="number" name="number" required maxlength="12" placeholder="enter your number" class="input">
                                </div>
                                <div class="input-field">
                                    <p>Your email</p>
                                    <input type="email" name="email" required maxlength="90" placeholder="enter your email" class="input">
                                </div>
                                <div class="input-field">
                                    <p>payment method</p>
                                    <select name="method" id="" class="input">
                                        <option value="cash on delivery">cash on delivery</option>
                                        <option value="credit card">credit card</option>
                                        <option value="net banking">net banking</option>
                                        <option value="paytm">paytm</option>
                                        <option value="zalo pay">zalo pay</option>
                                    </select>
                                </div>
                                <div class="input-field">
                                    <p>address type</p>
                                    <select name="address_type" id="" class="input">
                                        <option value="home">home</option>
                                        <option value="office">office</option>
                                    </select>
                                </div>
                            </div>
                            <div class="box">
                                <div class="input-field">
                                    <p>address line 01</p>
                                    <input type="text" name="flat" required maxlength="90" placeholder="
                                    e.g flat& building number" class="input">
                                </div>
                                <div class="input-field">
                                    <p>address line 02</p>
                                    <input type="text" name="street" required maxlength="90" placeholder="
                                    e.g street name" class="input">
                                </div>
                                <div class="input-field">
                                    <p>your city</p>
                                    <input type="text" name="city" required maxlength="90" placeholder="
                                    e.g your city name" class="input">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="place_order" class="btn">place order</button>
                    </form>
                    <div class="sumary">
                        <h3>my bag</h3>
                        <div class="container">
                            <?php
                                $grand_total=0;
                                if(isset($_GET['get_id'])){
                                    $select_get=$conn->prepare("SELECT * FROM `products` WHERE id =?");
                                    $select_get->execute([$_GET['get_id']]);
                                    while($fetch_get =$select_get->fetch(PDO::FETCH_ASSOC)){
                                        $sub_total =$fetch_get['price'];
                                        $grand_total+=$sub_total;
                            ?>
                            <div class="flex">
                                <img src="img/<?=$fetch_get['image']; ?>" class="img" alt="">
                                <div>
                                     <h3 class="name"><?=$fetch_get['name']; ?></h3>
                                     <p class="price"><?=$fetch_get['price']; ?>.000VNĐ</p>
                                </div>
                            </div>
                            <?php
                                   }
                                }else{
                                    $select_cart =$conn->prepare("SELECT *FROM `cart` WHERE user_id=?");
                                    $select_cart->execute([$user_id]);
                                    if($select_cart->rowCount()>0){
                                        while($fetch_cart =$select_cart->fetch(PDO::FETCH_ASSOC)){
                                            $select_product =$conn->prepare("SELECT* FROM `products` WHERE id =?");
                                            $select_product->execute([$fetch_cart['product_id']]);
                                            $fetch_product=$select_product->fetch(PDO::FETCH_ASSOC);
                                            $sub_total=($fetch_cart['qty'] * $fetch_product['price']);
                                            $grand_total+=$sub_total;      
                            ?>
                            <div class="flex"> '
                            <img src="img/<?=$fetch_product['image']; ?>" class="img" alt="">
                                <div>
                                     <h3 class="name"><?=$fetch_product['name']; ?></h3>
                                     <p class="price"><?=$fetch_product['price']; ?> x <?=$fetch_cart['qty']; ?></p>
                                </div>
                            </div>
                            <?php
                                        }
                                    }else{
                                        echo '<p class="empty">your cart is empty</p>';
                                    }
                                }
                            ?>
                        </div>
                        <div class="grand-total"><span> total amount payable: </span><?= $grand_total ;?>.000VNĐ</div>
                    </div>
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