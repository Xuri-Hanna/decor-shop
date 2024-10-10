<?php 
    include 'system/connection.php';
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id=$_SESSION['user_id'];
    }else{
        $user_id='';
    }
    if(isset($_POST['submit'])){ 
        $email=$_POST['email'];
  
        $password=$_POST['password'];
        $select_admin =$conn->prepare("SELECT *FROM `admin` WHERE email =? and password =?");
        $select_admin->execute([$email,$password]);
        if($select_admin->rowCount()>0){

            $fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC);
            $_SESSION['admin_id']=$fetch_admin['id'];
            header('location: admin/dashboad.php');
            
        }else{
      
        $select_user =$conn->prepare("SELECT *FROM `users` WHERE email = ? And password = ?");
        $select_user->execute([$email,$password]);
        $row =$select_user->fetch(PDO::FETCH_ASSOC);

        if($select_user->rowCount()>0){
            $_SESSION['user_id']=$row['id'];
            $_SESSION['user_name']=$row['name'];
            $_SESSION['user_email']=$row['email'];
            header("location: home.php");
        }else{
            $warning_msg[]='incorrect username or password';
        }
    }
    }
?>
<style type="text/css">
   <?php include 'style/login.css';?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="main-container">
       
            <div class="title">
                <img src="img/logo/104540-OMG7QN-486.jpg" alt="" class="logo">
                <h1>Login Now</h1>
                <p>Come and join with us</p>
                <img src="img/muiten.png" alt="" class="logo">
            </div>
            <section class="form-container">
            <form action="" method="post">
                <div class="input-field">
                    <p>Your email </p>
                    <input type="email" name="email" required placeholder="enter your email" maxlength="50"
                    oninput="this.value=this.value.replace(/\s/g, '')">    
                </div>
                <div class="input-field">
                    <p>Your password</p>
                    <input type="password" name="password" required placeholder="enter your password" maxlength="50"
                    oninput="this.value=this.value.replace(/\s/g, '')">
                </div>
                <button type="submit" name="submit" value="register now" class="btn">Login Now</button>
                <pre>Do not have an account?</pre>
                <a href="resigter.php">Register now</a>
            </form>
        </section>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php 
        include 'system/allert.php';
    ?>
</body>
</html>