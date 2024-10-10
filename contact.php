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
    if(isset($_POST['submit'])){
        if(isset($_POST['name'])&& isset($_POST['email'])&&
        isset($_POST['number'])&&isset($_POST['message'])){
            $id=unique_id();
            $name=$_POST['name'];
            $email=$_POST['email'];
            $number=$_POST['number'];
            $message=$_POST['message'];

            $sql = $conn->prepare("INSERT INTO `message` Values(?,?,?,?,?,?)");
            $sql->execute([$id,$user_id,$name,$email,$number,$message]);
            $success_msg[]='we recived your message';
        }else{
            $warning_msg[]='we need full information';
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
            <h1>Contact us</h1>
        </div>
        <div class="title2">
            <a href="home.php">home/</a><span>Contact</span>
        </div>
        <section class="services">
            <div class="title">
                <img src="img/logoshop.png" alt="" class="logo">
                <h1>Why choose us</h1>
                <p>***************************************</p>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="img/piggy-bank.png" style="width: 100px; height:100px;">
                    <div class="detail">
                        <h3>Great savings</h3>
                        <p>save big every order</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/sms.png"  style="width: 100px; height:100px;">
                    <div class="detail">
                        <h3>24*7 support</h3>
                        <p>one on one support</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/gift.png" style="width: 100px; height:100px;">
                    <div class="detail">
                        <h3>gift</h3>
                        <p>vouchers on every vouchers</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/shipped.png" style="width: 100px; height:100px;">
                    <div class="detail">
                        <h3>Wordwlide delivery</h3>
                        <p>dropship Wordwlide</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="form-container">
            <form action="" method="post">
                <div class="title">
                    <img src="img/logoshop.png" alt="" class="logo">
                    <h1>Leave a mesage</h1>
                </div>
                <div class="input-field">
                    <p>your name *</p>
                    <input type="text" name="name">
                </div>
                <div class="input-field">
                    <p>your email *</p>
                    <input type="text" name="email">
                </div>
                <div class="input-field">
                    <p>your number * </p>
                    <input type="text" name="number">
                </div>
                <div class="input-field">
                    <p>your message *</p>
                    <input type="text" name="message">
                </div>
                <button type="submit" name="submit-btn" class="btn">Send message</button>
            </form>
        </div>
        <div class="address">
            <div class="title">
                <img src="img/logoshop.png" class="logo">
                <h1>Contact detail</h1>
                <p>Call us to be serviced</p>
            </div>
            <div class="box-container">
                <div class="box">
                    <i class="bx bxs-map-pin"></i>
                    <div>
                        <h4>address</h4>
                        <p>123 Alingsås ,Swiden</p>
                    </div>
                </div>
                <div class="box">
                    <i class="bx bxs-phone-call"></i>
                    <div>
                        <h4>phone number</h4>
                        <p>888888888888</p>
                    </div>
                </div>
                <div class="box">
                    <i class="bx bxs-map-pin"></i>
                    <div>
                        <h4>email</h4>
                        <p>pth@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
              <?php include'footer.php';?>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php 
        include 'system/allert.php';
    ?>
</body>
</html>