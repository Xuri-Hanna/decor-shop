<?php
    include '../system/connection.php';
    session_start();
    $admin_id=$_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location :login.php');
    }
    //update ORDER
    if(isset($_POST['delete_order'])){
        $order_id=$_POST['order_id'];
        $verify_dele= $conn->prepare("SELECT * FROM `orders` WHERE id =? ");
        $verify_dele->execute([$order_id]);
    if($verify_dele->rowCount() > 0){
        $delete_order=$conn->prepare("DELETE FROM `orders` WHERE id = ? ");
        $delete_order->execute([$order_id]);
        $success_msg[] ='order deleted';
    }else{
        $warning_msg[] = 'order already deleted';
    }
    }
    //update order
    if(isset($_POST['update_order'])){
        $order_id=$_POST['order_id'];
         $update_payment =$_POST['update_payment'];

         $update_pay=$conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id =?");
         $update_pay->execute([$update_payment,$order_id]);
         $success_msg[] ='order updated';
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
            <h1>order place</h1>
        </div>
        <div class="title2">
            <a href="dashboad.php">dashboard</a><span> order place</span>
        </div>
        <section class="order-container">
            <h1 class="heading">order place</h1>
            <div class="box-container">
                <?php
                    $select_order =$conn->prepare("SELECT * FROM `orders`");
                    $select_order ->execute();

                    if($select_order->rowCount()>0){
                        while ($fetch_order=$select_order->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="box">
                    <div class="status" style="color: <?php if($fetch_order['status'] == 'in progress'){ echo 'green';}else{ echo 'red';}?>;"> 
                        <?= $fetch_order['status'];?>
                    </div>
                    <div class="detail">
                        <p>user name: <span> <?= $fetch_order['name'];?></span></p>
                        <p>user id: <span> <?= $fetch_order['id'];?></span></p>
                        <p>placed on: <span> <?= $fetch_order['date'];?></span></p>
                        <p>user number: <span> <?= $fetch_order['number'];?></span></p>
                        <p>user email: <span> <?= $fetch_order['email'];?></span></p>
                        <p>total price: <span> <?= $fetch_order['price'];?></span></p>
                        <p>method : <span> <?= $fetch_order['method'];?></span></p>
                        <p>address : <span> <?= $fetch_order['address'];?></span></p>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?= $fetch_order['id'];?>">
                        <select name="update_payment" id="">
                            <option disabled selected> <?=  $fetch_order['payment_status']?></option>
                            <option value="pending">pending</option>
                            <option value="complete">complete</option>
                        </select>
                        <div class="flex-btn">
                            <button type="submit" name="update_order" class="btn">update order</button>
                            <button type="submit" name="delete_order" class="btn">delete order</button>
                        </div>
                    </form>
                </div>
                <?php
                        }
                    }else{
                        echo'<div class="empty">
                                <p> no order takes placed yet </p>
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