<?php
session_start();
include 'db_connect.php';

$isLogin = isset($_SESSION['user_id']);

if(!isset($_GET['menu_id'])){
    die("Menu tidak ditemukan");
}

$menu_id = intval($_GET['menu_id']);

$query = mysqli_query($conn, "
    SELECT * FROM menus 
    WHERE id = $menu_id
");

if(mysqli_num_rows($query) == 0){
    die("Menu tidak ditemukan");
}

$menu = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detail_menu.css">
</head>
<body>

    <header>
        <div class="logo">
            <img src="PAWHUB.png" alt="Logo">
            <a href="home.php">Home</a>
        </div>

        <?php if(!$isLogin): ?>
            <a href="login.php" class="btn-login">Login</a>
        <?php else: ?>
            <div class="user-info">
                <span>Hi, <?= htmlspecialchars($_SESSION['user_name']); ?></span>
                <a href="logout.php" class="btn-login">Logout</a>
            </div>
        <?php endif; ?>
    </header>

    <header>
        <a href="detail.php?id=<?= $menu['vendor_id']; ?>" class="back-btn">← Detail Menu</a>
    </header>

    <div class="container">

        <div class="menu-card">
            <img src="assets/menu1.jpg" alt="Menu">

            <h2>
                <?= htmlspecialchars($menu['name']); ?>
                (<?= $menu['calorie']; ?> cals)
            </h2>

            <p class="desc">
                <?= htmlspecialchars($menu['menu_desc']); ?>
            </p>

            <div class="nutrition">
                <span>Carbo<br><b><?= $menu['carbo']; ?> gr</b></span>
                <span>Protein<br><b><?= $menu['protein']; ?> gr</b></span>
                <span>Fat<br><b><?= $menu['fat']; ?> gr</b></span>
            </div>
        </div>

        <div class="detail-box">
            <input type="text" placeholder="Optional note">

            <div class="bottom">
                <span class="price">
                    Rp<?= number_format($menu['price'],0,',','.'); ?>
                </span>

                <div class="qty">
                    <button>-</button>
                    <span>1</span>
                    <button>+</button>
                </div>
            </div>

            <?php if($isLogin): ?>
                <button class="add-cart">Add to Cart</button>
            <?php else: ?>
                <a href="login.php" class="add-cart login-cart">
                    Login to Add
                </a>
            <?php endif; ?>

        </div>

    </div>

</body>
</html>
