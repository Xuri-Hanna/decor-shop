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
            <h1>About us</h1>
        </div>
        <div class="title2">
            <a href="home.php">home/</a><span>About</span>
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
        <div class="about">
            <div class="row">
                <div class="img-box">
                    <img src="img/vsit.jpg" style="width: 170vh;">
                </div>
                <div class="detail" >
                    <h1>Visit our shop</h1>
                    <p style="color: white;">If you're looking for a more beautiful, relaxing, comfortable, and convenient space for your bedroom
                        , workspace, living room, or your home, come to us. We have everything you need, whether i
                        t's LED lighting, decor items like bookshelves, bedside lamps, or clocks, and even natural fragrances.
                    </p>
                    <a href="view_products.php" class="btn">Shop now</a>
                </div>
            </div>
        </div>
        <div class="testimonial-container">
            <div class="title">
                <img src="img/logoshop.png" class="logo" alt="">
                <h1>We ARE?</h1>
                <p>We are young people who always love wonderful spaces for ourselves and also wish to share them with you.</p>
                <div class="container">
                    <div class="testimonial-item">
                        <img src="img/peole1.jpg" alt="">
                        <h1>sara smith</h1>
                        <p>Our CEO is a passionate person who constantly seeks new things and is open to accepting all feedback from customers.</p>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/people3.jpg" alt="">
                        <h1>loki smith</h1>
                        <p>Our Deputy CEO is someone who always listens and is ready to answer your questions.</p>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/people2.jpg" alt="">
                        <h1>john smith</h1>
                        <p>This is the employee of the year, who will always assist you with an open heart and sincerity.</p>
                    </div>
                </div>
            </div>
        </div>
              <?php include'footer.php';?>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="script.js"></script>
<?php 
        include 'system/allert.php';
    ?>
</body>
</html>