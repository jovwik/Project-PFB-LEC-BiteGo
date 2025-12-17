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
    <title>Detail-Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body class="detail-menu-page">
     <nav>
        <img src="assets/PAWHUB.png" alt="Logo">
        <div class="nav-left">
            <a href="home_guest.php">Home</a>
            <a href="cart.php">Cart</a>
            <a href="logout.php">Logout</a>
        </div>
        
        <a class="login-btn">
            <?php isset($_SESSION['name']) ?>
                <?php echo htmlspecialchars($_SESSION['name']); ?>
        </a>
    </nav>
    <header>
        <a href="detail.php?id=<?= $menu['vendor_id']; ?>" class="back-btn">← ‎ ‎ Detail Menu</a>
    </header>

    <div class="container">

        <div class="menu-card">
            <img src="assets/NasiLoca.jpg" alt="Menu">

            <h2>
                <?= htmlspecialchars($menu['name']); ?>
                (<?= $menu['calorie']; ?> cals)
            </h2>

            <p class="desc">
                <?= htmlspecialchars($menu['menu_desc']); ?>
            </p>

            <div class="nutrition">
                <span>Carbo<br><b><?= $menu['carbo']; ?> gr</b></span>
                <span>Protein<br><b><?= $menu['calorie']; ?> gr</b></span>
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
