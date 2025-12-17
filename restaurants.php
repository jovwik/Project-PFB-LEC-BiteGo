<?php
session_start();
include 'db_connect.php';

$isLogin = isset($_SESSION['user_id']);
$vendors = mysqli_query($conn, "
    SELECT id, name 
    FROM users 
    WHERE role = 'vendor'
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
<body class="restaurants-page">

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


    <h1>Restaurants</h1>

    <div class="cards">

        <?php if(mysqli_num_rows($vendors) == 0): ?>
        <p>Tidak ada restoran tersedia.</p>
        <?php else: ?>

            <?php while($v = mysqli_fetch_assoc($vendors)): ?>
                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/menu1.jpg">
                        <p>Nasi Loca Healthy Indonesia Rice Bowl by Mini Calore</p>
                        <p>Kuningan</p>
                    </div>
                </a>

                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/menu1.jpg">
                        <p>Boost Juice Bars</p>
                        <p>WTC Sudirman</p>
                    </div>
                </a>

                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/menu1.jpg">
                        <p>Shigeru Sushi</p>
                        <p>Lippo Mall Puri</p>
                    </div>
                </a>

                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/menu1.jpg">
                        <p>Gado - Gado Boplo</p>
                        <p>Cassablanca</p>
                    </div>
                </a>

                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/menu1.jpg">
                        <p>Gado - Gado Boplo</p>
                        <p>Cassablanca</p>
                    </div>
                </a>

                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/menu1.jpg">
                        <p>Gado -Gado Boplo</p>
                        <p>Cassablanca</p>
                    </div>
                </a>
            <?php endwhile; ?>

        <?php endif; ?>
        
    </div>

</body>
</html>
