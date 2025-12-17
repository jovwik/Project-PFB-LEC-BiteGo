<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'vendor'){
    header("Location: login.php");
    exit;
}

$vendor_id = $_SESSION['user_id'];

$menus = mysqli_query($conn, "
    SELECT * FROM menus
    WHERE vendor_id = $vendor_id
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Menus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body class="vendor-page">

    <h2 class="page-title">My Menus</h2>

    <div class="menu-grid">

    <?php if(mysqli_num_rows($menus) == 0): ?>
        <p>Belum ada menu.</p>
    <?php endif; ?>

    <?php while($m = mysqli_fetch_assoc($menus)): ?>
        <a href="menu_detail.php?id=<?= $m['id']; ?>" class="menu-card">

            <img src="assets/menu1.jpg">

            <h4><?= htmlspecialchars($m['name']); ?></h4>
            <p><?= $m['calorie']; ?> cals</p>
            <p><?= htmlspecialchars($m['menu_desc']); ?></p>

            <strong>Rp<?= number_format($m['price'],0,',','.'); ?></strong>

        </a>
    <?php endwhile; ?>

    </div>

</body>
</html>
