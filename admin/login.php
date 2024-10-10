<?php
    include '../system/connection.php';
    session_start();
    if(isset($_POST['login'])){
        $email =$_POST['email'];
        $pass=$_POST['password'];
        $select_admin =$conn->prepare("SELECT *FROM `admin` WHERE email =? and password =?");
        $select_admin->execute([$email,$pass]);
        if($select_admin->rowCount()>0){

            $fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC);
            $_SESSION['admin_id']=$fetch_admin['id'];
            header('location:dashboad.php');
            
        }else{
            $warning_msg[]='incorrect username or password';
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
    <title>SHOP ADMIN Login</title>
</head>
<body> 
    <div class="main">
        <section>
            <div class="form-container" id="admin_login">
                <form action="" method="post" enctype="multipart/form-data">
                    <h3>Login now</h3>      
                    <div class="input-field">
                        <label for="">user email <sup>*</sup></label>
                        <input type="email" name="email"  required placeholder="Enter your email" oninput="">
                    </div>
                    <div class="input-field">
                        <label for="">Password <sup>*</sup></label>
                        <input type="password" name="password" maxlength="" required placeholder="Enter your password" oninput="">
                    </div>
                    <button type="submit" name="login" class="btn ">Login now</button>
                    <p>do not have an account ? <a href="register.php">Register now</a></p>
                </form>
            </div>
        </section>
    </div>
      <!--sweetalert cdn link -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php 
        include 'alert.php'
    ?>
</body>
</html>