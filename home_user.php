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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="home-page">
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

    <div class="hero">
        <img src="assets/asa.jpg" alt="Hero Image">
    </div>

    <div class="menu-section">
        <h2>What's on your mind?</h2>

        <div class="menu-grid">
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
        </div>
        <div class="button-container">
            <a href="" class="show-all">Show All</a>
        </div>

    </div>
</body>
</html>
