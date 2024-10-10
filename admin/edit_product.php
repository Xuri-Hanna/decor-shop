<?php
    include '../system/connection.php';
    session_start();
    $admin_id=$_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location :login.php');
    }
    $post_id=$_GET['id'];
    // update product
    if(isset($_POST['update'])){
        $name=$_POST['name'];

        $price=$_POST['price'];

        $detail=$_POST['content'];

        $status =$_POST['status'];

        $update_product=$conn->prepare("UPDATE `products` SET name = ?,price =? ,product_detail =?,status =? WHERE id =?");
        $update_product->execute([$name,$price,$detail,$status,$post_id]);

        $success_msg[] ='product updated successfully';

        $old_iamge=$_POST['old_image'];
        $image =$_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name =$_FILES['image']['tmp_name'];
        $image_folder='../image/'.$image;

        $selecy_image=$conn->prepare("SELECT * FROM `products` WHERE image =?");
        $selecy_image->execute([$image]);

        if(!empty($image)){
            if($image_size > 20000000){
                $warning_msg[] =' image size is too large';
            }else if ($selecy_image->rowCount() > 0 and $image!=''){
                $warning_msg[]=' please rename your image';
            }else{
                $update_image = $conn->prepare("UPDATE `products` Set image =? WHERE id =?");
                $update_image->execute([$image ,$post_id]);
                move_uploaded_file($image_tmp_name,$image_folder);

                if($old_iamge != $image and $old_iamge !=''){
                    unlink('../image/'.$old_iamge);
                }
                $success_msg[] ='update image successfully';
            }
        }
    }
    // delete product
    if (isset($_POST['delete'])){
        $p_id =$_POST['product_id'];

        
        $delete_product=$conn->prepare("DELETE  FROM `products` WHERE id = ?");
        $delete_product->execute([$p_id]);
        $success_msg[] ='product deleted sucessfully';

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
            <h1>edit products</h1>
        </div>
        <div class="title2">
            <a href="dashboad.php">Home</a><span> / edit products</span>
        </div>
        <section class="edit-post">
            <h1 class="heading">edit products</h1>
            <?php 
       
                $select_product = $conn->prepare("SELECT * FROM `products` WHERE id =?");
                $select_product->execute([$post_id]);
                if($select_product->rowCount() > 0){
                    while($fetch_product =$select_product->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="old_image" value="<?= $fetch_product['image'];?>">
                    <input type="hidden" name="product_id" value="<?= $fetch_product['id'];?>">

                    <div class="input-field">
                        <label for=""> update status</label>
                        <select name="status" id="">
                            <option selected disabled value="<?= $fetch_product['status'];?>">
                                <?= $fetch_product['status'];?>
                            </option>
                            <option value="active">active</option>
                            <option value="deactive">deactive</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="">product name <sup>*</sup></label>
                        <input type="text" name="name" value="<?= $fetch_product['name'];?>">
                    </div>
                    <div class="input-field">
                        <label for="">product price <sup>*</sup></label>
                        <input type="number" name="price" value="<?= $fetch_product['price'];?>">
                    </div>
                    
                    <div class="input-field">
                        <label for="">product detail <sup>*</sup></label>
                        <textarea  name="content" > <?= $fetch_product['product_detail'];?></textarea>
                    </div>
                    <div class="input-field">
                        <label for="">product image <sup>*</sup></label>
                        <input type="file" name="image" accept="image/*" id="">
                        <img src="../image/<?= $fetch_product['image']; ?>" class="image" alt="">
                    </div>
                    <div class="flex-btn">
                        <button type="submit" name="update" class="btn">update product</button>
                        <a href="view_product.php" class="btn">go back</a>
                        <button type="submit" name="delete" class="btn">delete product</button>
                    </div>
                </form>
            </div>
            <?php           
                     }
                    }else{
                        echo'<div class="empty">
                                <p> no product added yet <br><a href="add_product.php" style="margin: top 1.5rem;" class="btn"> add product</a></p>
                            </div>';
                    }
            ?>
        </section>
    </div>
      <!--sweetalert cdn link -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php 
        include 'alert.php';
    ?>
</body>
</html>