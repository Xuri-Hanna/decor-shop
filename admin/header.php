<header class="header">
    <div class="flex">
        <a href="dashboad.php" class="logo"><img src=""></a>
        <nav class="navbar">
            <a href="dashboad.php">dashboard</a>
            <a href="add_product.php">add product</a>
            <a href="view_product.php">View product</a>
            <a href="account.php">accounts</a>
        </nav>
        <div class="icon">
            <i class="bx bxs-user" id="user-btn"></i>
            <i class="bx bx-list-plus" id="menu-btn"></i>
        </div>
        <div class="profile-detail" id="profile-detail">
            <?php
            $select_profile= $conn->prepare("SELECT * FROM `admin` WHERE id=?");
            $select_profile->execute([$admin_id]);
            if($select_profile->rowCount()>0){
                $fetch_profile =$select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="profile">
                <img src="../image/<?= $fetch_profile['profile']?>" alt="" class="logo-img">
                <p style="color: #000;"><?= $fetch_profile['name']?></p>
            </div>
            <div class="flex-btn">
                <a href="profile.php" class="btn">profile</a>
                <a href="logout.php" onclick="return confirm('logout from this website');" class="btn">logout</a>
            </div>
            <?php
            }
            ?>
        </div>   
    </div>
    <script>
        const userbox= document.getElementById('profile-detail');

document.getElementById("user-btn").onclick = function (){
    const subMenuStyle = getComputedStyle(userbox).display;
    if(subMenuStyle == 'none'){
       userbox.style.display = 'block';
    }
    else{
        userbox.style.display = 'none';
    }

}
    </script>
</header>