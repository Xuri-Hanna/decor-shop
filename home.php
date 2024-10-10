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
        <!--Section-home-->
        <section class="home-section">
        <div class="slider">
            <div class="slider__slider slide1 active">
                <div class="overlay"></div>
                <div class="slide-detail" >
                    <h1>Do you love decor?</h1>
                    <pre>Welcome to our store,where can meet your needs</pre>
                    <a href="View_product.php" class="btn">Shop now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>
            <!--slide end-->
            <div class="slider__slider slide2">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>Bedroom</h1>
                    <pre>Would you like to make your bedroom a sweeter space?</pre>
                    <a href="View_product.php" class="btn">Shop now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>
            <!--slide end-->
        
            <div class="slider__slider slide3">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>do you love rgb?</h1>
                    <pre>we can help you to enjoy wonderful light, from natural light to artistic light.</pre>
                    <a href="View_product.php" class="btn">Shop now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>
            <!--slide end-->
        
            <div class="slider__slider slide4">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>The city in your house</h1>
                    <pre>You can find the whole "world" in our store.</pre>
                    <a href="View_product.php" class="btn">Shop now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>
            <!--slide end-->
       
            <div class="slider__slider slide5">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>scent</h1>
                    <pre>Scent will always be the easiest thing to make you feel more relaxed.</pre>
                    <a href="View_product.php" class="btn">Shop now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>
            <!--slide end-->
            <div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
            <div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>
        </div>
        </section>
       
              <!--home slider end-->
        <section class="thumb">
            <div class="box-container">
                <div class="box">
                    <img src="img/deep1.jpg" alt="">
                    <h3>decor</h3>
                    <p>**********************</p>
                    <a href="view_product.php"><i class="bx bx-chevron-right" ></i></a>
                </div>
                <div class="box">
                    <img src="img/deep2.jpg" alt="">
                    <h3>scent</h3>
                    <p>**********************</p>
                    <a href="view_product.php"><i class="bx bx-chevron-right"></i></a>
                </div>
                <div class="box">
                    <img src="img/deep3.jpg ">
                    <h3>led RGB</h3>
                    <p>**********************</p>
                    <a href="view_product.php"><i class="bx bx-chevron-right"></i></a>
                </div>
                <div class="box">
                    <img src="img/deep4.jpg" alt="">
                    <h3>memory</h3>
                    <p>**********************</p>
                    <a href="view_product.php"><i class="bx bx-chevron-right"></i></a>
                </div>
            </div>
        </section>
         <!--Section-Shop category-->
        <section class="shop-category">
            <div class="box-container">
                <div class="box">
                    <img src="img/haloween.jpg" >
                    <div class="detail">
                        <span>Haloween is coming</span>
                        <h1>Sale 20%</h1>
                        <a href="view_products.php" class="btn">Shop now</a>
                    </div>
                </div>
                <div  class="box">
                    <img src="img/christmas.jpg" >
                    <div class="detail">
                        <span>Merry Christmas</span>
                        <h1>Big offer is coming soon</h1>
                        <a href="view_products.php" class="btn">Shop now</a>
                    </div>
                </div>
            </div>
        </section>
             <!--Section--->
        <section class="services">
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
             <!--brand-->
        <section class="brand">
            <div class="box-container">
                <div class="box">
                    <img src="img/logo1.png" >
                </div>
                <div class="box">
                    <img src="img/logo2.png" alt="">
                </div>
                <div class="box">
                    <img src="img/logo3.png" alt="">
                </div>
                <div class="box">
                    <img src="img/logo4.png" alt="">
                </div>
                <div class="box">
                    <img src="img/logo5.png" alt="">
                </div>
            </div>
        </section>
              <?php include'footer.php';?>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
 document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.slider__slider');
    const leftArrow = document.querySelector('.left-arrow');
    const rightArrow = document.querySelector('.right-arrow');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach(slide => {
            slide.style.display = 'none';
            slide.classList.remove('active');
        });
        slides[index].style.display = 'block';
        slides[index].classList.add('active');
    }

    showSlide(currentSlide);

    rightArrow.addEventListener('click', () => {
        currentSlide++;
        if (currentSlide >= slides.length) {
            currentSlide = 0;
        }
        showSlide(currentSlide);
    });

    leftArrow.addEventListener('click', () => {
        currentSlide--;
        if (currentSlide < 0) {
            currentSlide = slides.length - 1;
        }
        showSlide(currentSlide);
    });
});

</script>
</body>
</html>