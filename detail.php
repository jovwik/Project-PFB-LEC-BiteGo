<?php
session_start();
include 'db_connect.php';

$isLogin = isset($_SESSION['user_id']);

if(!isset($_GET['id'])){
    die("Vendor tidak ditemukan");
}

$vendor_id = intval($_GET['id']);

$vendorQuery = mysqli_query($conn, "
    SELECT * FROM users 
    WHERE id = $vendor_id AND role = 'vendor'
");

if(mysqli_num_rows($vendorQuery) == 0){
    die("Vendor tidak ditemukan");
}

$vendor = mysqli_fetch_assoc($vendorQuery);

$menuQuery = mysqli_query($conn, "
    SELECT * FROM menus 
    WHERE vendor_id = $vendor_id
    ORDER BY name ASC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LocalFarmer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body class="detail-page">

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
        <a href="restaurants.php" class="back-btn">← Detail</a>
    </header>

    <section class="vendor-info">
        <img src="assets/menu1.jpg" class="vendor-img">

        <div>
            <h2>Nasi Loca Healthy Indonesia Rice Bowl by Mini Calore</h2>
            <p>Indonesian, Chinese</p>
            <p>📍 Kuningan</p>
            <p>💲 40rb – 100rb</p>
        </div>
    </section>

    <h3 class="menu-title">Menu</h3>

    <div class="menu-grid">
        <?php while($menu = mysqli_fetch_assoc($menuQuery)): ?>
            <div class="menu-card">

                <a href="detail_menu.php?menu_id=<?= $menu['id']; ?>" class="menu-link">
                    <img src="assets/menu1.jpg" class="menu-img">
                    <h4><?= htmlspecialchars($menu['name']); ?></h4>
                    <p><?= $menu['calorie']; ?> Kalori</p>
                    <p><?= htmlspecialchars($menu['menu_desc']); ?></p>
                    <strong>
                        Rp<?= number_format($menu['price'],0,',','.'); ?>
                    </strong>
                </a>

                <button class="add-cart">Add to Cart</button>
            </div>
        <?php endwhile; ?>
    </div>

</body>
</html>