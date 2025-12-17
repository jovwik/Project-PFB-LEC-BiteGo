<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="vendor-page">
     <nav>
        <img src="assets/PAWHUB.png" alt="Logo">
        <div class="nav-left">
            <a href="vendor_dashboard.php">Home</a>
            <a href="add_menu.php">Add Menu</a>
            <a href="logout.php">Logout</a>
        </div>
        
        <a class="login-btn">
            <?php isset($_SESSION['name']) ?>
                <?php echo htmlspecialchars($_SESSION['name']); ?>
        </a>
    </nav>
    
</body>
</html>
