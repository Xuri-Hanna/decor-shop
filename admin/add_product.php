<?php
    include '../system/connection.php';
    session_start();
    $admin_id=$_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location :login.php');
    }
    //add product
    if(isset($_POST['publish'])){
        $id =unique_id();
        $name=$_POST['name'];
        $price=$_POST['price'];
        $detail=$_POST['content'];
        $status ='active';
        $image =$_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name =$_FILES['image']['tmp_name'];
        $image_folder='../image/'.$image;
        $select_image =$conn->prepare("SELECT * FROM `products` WHERE image =?");
        $select_image->execute([$image]);
        if(isset($image))
        {
            if($select_image->rowCount() > 0)
            {
                $warning_msg[]= 'image name repeated';
            }else if($image_size > 2000000)
            {
                $warning_msg[] = 'image size is too large';
            }else{
                move_uploaded_file($image_tmp_name,$image_folder);
            }
        }else {
            $image = '';
        }
        if($select_image->rowCount() > 0 AND $image!=''){
            $warning_msg[] ='please rename your image';
        }else {
            $insert_product =$conn->prepare("INSERT INTO `products`(id,name,price,image,product_detail,status) VALUES (?,?,?,?,?,?)");
            $insert_product->execute([$id,$name,$price,$image,$detail,$status]);
            $success_msg[] = 'product inserted successfully';
        }
    }
    //save product in database as draft
    if(isset($_POST['draft'])){
        $id =unique_id();
        $name=$_POST['name'];
        $price=$_POST['price'];
        $detail=$_POST['content'];
        $status ='deactive';
        $image =$_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name =$_FILES['image']['tmp_name'];
        $image_folder='../image/'.$image;
        $select_image =$conn->prepare("SELECT * FROM `products` WHERE image =?");
        $select_image->execute([$image]);
        if(isset($image))
        {
            if($select_image->rowCount() > 0)
            {
                $warning_msg[]= 'image name repeated';
            }else if($image_size > 2000000)
            {
                $warning_msg[] = 'image size is too large';
            }else{
                move_uploaded_file($image_tmp_name,$image_folder);
            }
        }else {
            $image = '';
        }
        if($select_image->rowCount() > 0 AND $image!=''){
            $warning_msg[] ='please rename your image';
        }else {
            $insert_product =$conn->prepare("INSERT INTO `products`(id,name,price,image,product_detail,status) VALUES (?,?,?,?,?,?)");
            $insert_product->execute([$id,$name,$price,$image,$detail,$status]);
            $success_msg[] = 'product inserted successfully';
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
            <h1>add products</h1>
        </div>
        <div class="title2">
            <a href="dashboad.php">Home</a><span> / add products</span>
        </div>
        <section class="form-container">
            <h1 class="heading">add new products</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-field">
                    <label for="">product name <sup>*</sup></label>
                    <input type="text" name="name" maxlength="100" required placeholder="product name">
                </div>
                <div class="input-field">
                    <label for="">product price <sup>*</sup></label>
                    <input type="number" name="price" maxlength="100" required placeholder="product price">
                </div>
                <div class="input-field">
                    <label for="">product image <sup>*</sup></label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <div class="input-field">
                    <label for="">product detail <sup>*</sup></label>
                    <textarea  name="content" maxlength="20000" required placeholder="product detail"></textarea>
                </div>
                <div class="flex-btn">
                    <button type="submit" name="publish" class="btn">publish product</button>
                    <button type="submit" name="draft" class="btn">save as draft</button>
                </div>
            </form>
        </section>
    </div>
      <!--sweetalert cdn link -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php 
        include 'alert.php';
    ?>
</body>
</html>