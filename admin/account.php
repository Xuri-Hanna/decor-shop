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
            <h1>register user</h1>
        </div>
        <div class="title2">
            <a href="dashboad.php">dashboard</a><span> / register user</span>
        </div>
        <section class="accounts">
            <h1 class="heading">register user</h1>
            <div class="box-container">
                <?php
                    $select_user=$conn->prepare("SELECT * FROM `users`");
                    $select_user->execute();
                    
                    if($select_user->rowCount() > 0){
                        while($fetch_user=$select_user->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="box">
                    
                    <p> user id : <span><?= $fetch_user['id'];?></span></p>
                    <p> user name : <span><?= $fetch_user['name'];?></span></p>
                    <p> user email : <span><?= $fetch_user['email'];?></span></p>
                </div>
                <?php
                     }
                    }else{
                        echo'<div class="empty">
                                <p> no user registered yet </p>
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