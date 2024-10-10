<?php
    include '../system/connection.php';
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $id = unique_id();  
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../image/' . $image;
        

        $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ?");
        $select_admin->execute([$email]);
        
        if ($select_admin->rowCount() > 0) {
            $warning_msg[]='user email already exit';
        } else {
            if ($pass != $cpass) {
            $warning_msg[]= 'Confirm your password wrong';
            } else {
   
                $add_admin = $conn->prepare("INSERT INTO `admin` (id, name,email, password, profile) VALUES (?, ?, ?, ?, ?)");
                $add_admin->execute([$id, $name,$email, $pass, $image]);

                move_uploaded_file($image_tmp_name, $image_folder);
                
                $success_msg[]= 'Admin registered successfully';
                header('location : login.php');
            }
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
    <title>SHOP ADMIN Register</title>
</head>
<body> 
    <div class="main">
        <section>
            <div class="form-container" id="admin_login">
                <form action="" method="post" enctype="multipart/form-data">
                    <h3>Register now</h3>
                    <div class="input-field">
                        <label for="">user name <sup>*</sup></label>
                        <input type="text" name="name" maxlength="20" required placeholder="Enter your name" oninput="">
                    </div>
                    <div class="input-field">
                        <label for="">user email <sup>*</sup></label>
                        <input type="email" name="email"  required placeholder="Enter your email" oninput="">
                    </div>
                    <div class="input-field">
                        <label for="">Password <sup>*</sup></label>
                        <input type="password" name="password" maxlength="20" required placeholder="Enter your password" oninput="">
                    </div>
                    <div class="input-field">
                        <label for="">confirm Password <sup>*</sup></label>
                        <input type="password" name="cpassword" maxlength="20" required placeholder="Confirm your password" oninput="">
                    </div>
                    <div class="input-field">
                        <label for="">select profile <sup>*</sup></label>
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <button type="submit" name="register" class="btn ">Register now</button>
                    <p>already have an account ? <a href="login.php">Login now</a></p>
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