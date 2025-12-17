<?php
session_start();
include 'db_connect.php';

if (isset($_POST['publish'])) {

    $vendor_id = $_SESSION['user_id'];
    $name      = $_POST['name-menu'];
    $desc      = $_POST['desc-menu'];
    $protein   = (float) $_POST['protein-menu'];
    $carbo     = (float) $_POST['carbs-menu'];
    $fat       = (float) $_POST['fat-menu'];
    $price   = (int) $_POST['price-menu'];

    $category = 'Food';
    $calorie  = ($protein * 4) + ($carbo * 4) + ($fat * 9);

    $imageName = $_FILES['image-menu']['name'];
    $tmpName   = $_FILES['image-menu']['tmp_name'];

    $folder = "uploads/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $newImageName = time() . "_" . basename($imageName);
    $imagePath = $folder . $newImageName;

    move_uploaded_file($tmpName, $imagePath);

    $query = "INSERT INTO menus 
        (vendor_id, name, price, category, calorie, carbo, fat, menu_desc, image)
        VALUES 
        ('$vendor_id', '$name', '$price', '$category', '$calorie', '$carbo', '$fat', '$desc', '$imagePath')";

    mysqli_query($conn, $query);

    header("Location: vendor_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="menu-page">
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
    <h2>Add Menu</h2>
    <div id="add_menu">
        <form id="addMenuForm" method="POST" enctype="multipart/form-data">
            <label>Menu Name</label>
            <input type="text" name="name-menu">

            <label>Description</label>
            <textarea name="desc-menu"></textarea>

            <label>Protein</label>
            <input type="text" name="protein-menu">
            
            <label>Carbo</label>
            <input type="text" name="carbs-menu">

            <label>Fat</label>
            <input type="text" name="fat-menu">

            <label>Image</label>
            <input type="file" name="image-menu">

            <label>Price</label>
            <input type="text" name="price-menu">

            
            <button type="submit" name="publish">Publish</button>
        </form>
    </div>

</body>
</html>
