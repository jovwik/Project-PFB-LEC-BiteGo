<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
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
            <div class="menu-card">
                <img src="assets/NasiLoca.jpg" alt="Nasi Loca">
                <div class="info">
                    <h3>Nasi Loca Healthy Indonesian Rice Bowl Mini Calore</h3>
                    <br>
                    <p>Location: Kuningan</p>
                </div>
            </div>

            <div class="menu-card">
                <img src="assets/Boost.jpg" alt="Boost Juice Bars">
                <div class="info">
                    <h3>Boost Juice Bars</h3>
                    <br>
                    <br>
                    <br>
                    <p>Location: Sudirman</p>
                </div>
            </div>
            <div class="menu-card">
                <img src="assets/Shigeru.jpg" alt="Shigeru Sushi">
                <div class="info">
                    <h3>Shigeru Sushi</h3>
                    <br>
                    <br>
                    <br>
                    <p>Location: Lippo Mall Puri</p>
                </div>
            </div>
        </div>
        <div class="button-container">
            <a href="" class="show-all">Show All</a>
        </div>

    </div>
</body>
</html>
