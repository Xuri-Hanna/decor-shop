<?php 
    include 'system/connection.php';
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id=$_SESSION['user_id'];
    }else{
        $user_id='';
    }
    if(isset($_POST['submit'])){
        $id=unique_id();
        $name=$_POST['name'];
        $name=filter_var($name,FILTER_SANITIZE_STRING);
        $email=$_POST['email'];
        $email=filter_var($email,FILTER_SANITIZE_STRING);
        $password=$_POST['password'];
        $password=filter_var($password,FILTER_SANITIZE_STRING);
        $confirm=$_POST['confirm'];
        $confirm=filter_var($confirm,FILTER_SANITIZE_STRING);

        $select_user =$conn->prepare("SELECT *FROM `users` WHERE email = ?");
        $select_user->execute([$email]);
        $row =$select_user->fetch(PDO::FETCH_ASSOC);

        if($select_user->rowCount()>0){
            $warning_msg[]= 'emali already exit';
        }else{
            if($password!=$confirm){
                $warning_msg[]='confirm your password';
            }else{
                $insert_user = $conn->prepare("INSERT INTO `users` (id, name, email, password) VALUES (?, ?, ?, ?)");
                $insert_user->execute([$id, $name, $email, $password]);
                $select_user=$conn->prepare("SELECT * FROM `users` WHERE email =? AND password=?");
                $select_user->execute([$email,$password]);
                $row =$select_user->fetch(PDO::FETCH_ASSOC);
                if($select_user->rowCount()>0){
                    $_SESSION['user_id']=$row['id'];
                    $_SESSION['user_name']=$row['name'];
                    $_SESSION['user_email']=$row['email'];
                    header("location: home.php");
                }
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
    <title>Register</title>
</head>
<body>
    <div class="main-container">
       
            <div class="title">
                <img src="img/coffee-640647_1280.jpg" alt="" class="logo">
                <h1>Register Now</h1>
                <p>Come and join with us</p>
                <img src="img/muiten.png" alt="" class="logo">
            </div>
            <section class="form-container">
            <form action="" method="post">
                <div class="input-field">
                    <p>Your name </p>
                    <input type="text" name="name" required placeholder="enter your name" maxlength="50">
                </div>
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
                <div class="input-field">   
                    <p>Confirm password</p>
                    <input type="password" name="confirm" required placeholder="confirm your password" maxlength="50"
                    oninput="this.value=this.value.replace(/\s/g, '')">
                </div>
                <button type="submit" name="submit" value="egister now" class="btn">Register Now</button>
                <pre>You allready have an account?<a href="login.php">Login now</a></pre>
            </form>
        </section>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php 
        include 'system/allert.php';
    ?>
</body>
</html>