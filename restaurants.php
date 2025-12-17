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
    <title>Restaurants</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="restaurants-page">
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

    <h2>Restaurants</h2>

    <div class="cards">

        <?php if(mysqli_num_rows($vendors) == 0): ?>
        <p>Tidak ada restoran tersedia.</p>
        <?php else: ?>

            <?php while($v = mysqli_fetch_assoc($vendors)): ?>
                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/NasiLoca.jpg">
                        <p>Nasi Loca Healthy Indonesia Rice Bowl by Mini Calore</p>
                        <br>
                        <div class="location">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Kuningan</span>
                        </div>
                    </div>
                </a>

                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/Boost.jpg">
                        <p>Boost Juice Bars</p>
                        <br>
                        <br>
                        <div class="location">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>WTC Sudirman</span>
                        </div>
                    </div>
                </a>

                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/Shigeru.jpg">
                        <p>Shigeru Sushi</p>
                        <br>
                        <br>
                        <div class="location">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Lippo Mall Puri</span>
                        </div>
                    </div>
                </a>

                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/diet go.png">
                        <p>Diet Go (Nasi Ayam Beef Healthy)</p>
                        <br>
                        <div class="location">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Kuningan</span>
                        </div>
                    </div>
                </a>

                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/IG-2024-2.jpg">
                        <p>Subway</p>
                        <br>
                        <br>
                        <div class="location">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Lippo Mall Nusantara</span>
                        </div>
                    </div>
                </a>

                <a href="detail.php?id=<?= $v['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="assets/c590dc9b-232c-4ee2-a1ea-5d22b3101cd8_gobiz-dashboard-image_1713933242794.jpg">
                        <p>Greenly (Healthy Salad, Bowl, Juice)</p>
                        <br>
                        <div class="location">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Sudirman</span>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>

        <?php endif; ?>
        
    </div>

</body>
</html>
