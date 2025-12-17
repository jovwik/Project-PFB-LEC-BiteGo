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

$menu_id   = intval($_GET['id']);
$vendor_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "
    SELECT * FROM menus
    WHERE id = $menu_id AND vendor_id = $vendor_id
");

if(mysqli_num_rows($query) == 0){
    die("Menu tidak ditemukan");
}

$menu = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $name   = mysqli_real_escape_string($conn, $_POST['name']);
    $desc   = mysqli_real_escape_string($conn, $_POST['menu_desc']);
    $price  = intval($_POST['price']);
    $protein= intval($_POST['protein']);
    $carbo  = intval($_POST['carbo']);
    $fat    = intval($_POST['fat']);

    mysqli_query($conn, "
        UPDATE menus SET
            name = '$name',
            menu_desc = '$desc',
            price = $price,
            protein = $protein,
            carbo = $carbo,
            fat = $fat
        WHERE id = $menu_id AND vendor_id = $vendor_id
    ");

    header("Location: menu_detail.php?id=$menu_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body class="vendor-page">

    <h2 class="page-title">Edit Menu</h2>

    <form class="edit-form" method="POST" enctype="multipart/form-data">

        <label>Menu Name</label>
        <input type="text" name="name"
            value="<?= htmlspecialchars($menu['name']); ?>" required>

        <label>Description</label>
        <textarea name="menu_desc" required><?= htmlspecialchars($menu['menu_desc']); ?></textarea>

        <label>Price</label>
        <input type="number" name="price"
            value="<?= $menu['price']; ?>" required>

        <label>Protein</label>
        <input type="number" name="protein"
            value="<?= $menu['protein']; ?>" required>

        <label>Carbo</label>
        <input type="number" name="carbo"
            value="<?= $menu['carbo']; ?>" required>

        <label>Fat</label>
        <input type="number" name="fat"
            value="<?= $menu['fat']; ?>" required>

        <label>Image</label>
        <input type="file" name="image">

        <button type="submit" name="update" class="btn-primary">
            Publish
        </button>

    </form>

</body>
</html>
