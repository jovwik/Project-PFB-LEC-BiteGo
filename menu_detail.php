<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'vendor'){
    header("Location: login.php");
    exit;
}

if(!isset($_GET['id'])){
    die("Menu tidak ditemukan");
}

$menu_id = intval($_GET['id']);
$vendor_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "
    SELECT * FROM menus
    WHERE id = $menu_id AND vendor_id = $vendor_id
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
    <title>Menu Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body class="vendor-page">

    <h2 class="page-title">Menu Detail</h2>

    <div class="menu-detail-card">

        <img src="assets/menu1.jpg">

        <h3>
            <?= htmlspecialchars($menu['name']); ?>
            (<?= $menu['calorie']; ?> cals)
        </h3>

        <p><?= htmlspecialchars($menu['menu_desc']); ?></p>

        <div class="nutrition">
            <span>Carbo<br><b><?= $menu['carbo']; ?> gr</b></span>
            <span>Protein<br><b><?= $menu['protein']; ?> gr</b></span>
            <span>Fat<br><b><?= $menu['fat']; ?> gr</b></span>
        </div>

        <h4>Rp<?= number_format($menu['price'],0,',','.'); ?></h4>

        <div class="actions">
            <a href="edit_menu.php?id=<?= $menu['id']; ?>" class="btn-edit">Edit</a>
            <form action="delete_menu.php" method="POST"
                onsubmit="return confirm('Hapus menu ini?');">
                <input type="hidden" name="menu_id" value="<?= $menu['id']; ?>">
                <button type="submit" class="btn-delete">Delete</button>
            </form>
        </div>

    </div>

</body>
</html>
