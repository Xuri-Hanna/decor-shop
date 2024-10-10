<?php
    include '../system/connection.php';
    session_start();
    $admin_id=$_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location :login.php');
    }
    if(isset($_POST['delete'])){
        $delete_id=$_POST['delete_id'];
        $verify_mess= $conn->prepare("SELECT * FROM `message` WHERE id =? ");
        $verify_mess->execute([$delete_id]);
    if($verify_mess->rowCount() > 0){
        $delete_mess=$conn->prepare("DELETE FROM `message` WHERE id = ? ");
        $delete_mess->execute([$delete_id]);
        $success_msg[] ='message deleted';
    }else{
        $warning_msg[] = 'message already deleted';
    }
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
            <h1>unread message</h1>
        </div>
        <div class="title2">
            <a href="dashboad.php">dashboard</a><span> / unread message</span>
        </div>
        <section class="accounts">
            <h1 class="heading">register user</h1>
            <div class="box-container">
                <?php
                    $select_message=$conn->prepare("SELECT * FROM `message`");
                    $select_message->execute();
                    
                    if($select_message->rowCount() > 0){
                        while($fetch_message=$select_message->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="box">
                        <h3 class="name"><?= $fetch_message['name'];?></h3>
                        <h4><?= $fetch_message['subject'];?></h4> 
                        <p><?= $fetch_message['message'];?></p>  
                        <form action="" method="post" class="flex-btn">
                            <input type="hidden" name="delete_id" id="" value="<?= $fetch_message['id'];?>">
                            <button type="submit" name="delete" class="btn" onclick="return confirm('delete this message');">delete message</button>
                        </form>
                </div>
                <?php
                     }
                    }else{
                        echo'<div class="empty">
                                <p> no message send yet </p>
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