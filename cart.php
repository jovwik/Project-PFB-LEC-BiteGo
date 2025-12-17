<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$isLogin = true;
$cart = $_SESSION['cart'] ?? [];
$menus = [];
$total = 0;

if(!empty($cart)){
    $ids = implode(',', array_keys($cart));
    $query = mysqli_query($conn, "SELECT * FROM menus WHERE id IN ($ids)");

    while($row = mysqli_fetch_assoc($query)){
        $row['qty'] = $cart[$row['id']];
        $row['subtotal'] = $row['price'] * $row['qty'];
        $total += $row['subtotal'];
        $menus[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
</head>
<body class="cart-page">

    <h2 class="page-title">Cart</h2>

    <div class="cart-container">

    <?php if(empty($menus)): ?>
        <p>Cart masih kosong.</p>
    <?php else: ?>
        <?php foreach($menus as $m): ?>
            <div class="cart-item">
                <img src="assets/menu1.jpg" class="menu-img">

                <div class="menu-info">
                    <h4><?= htmlspecialchars($m['name']); ?></h4>
                    <p class="nutrition">
                        Carbo <?= $m['carbo']; ?>gr •
                        Protein <?= $m['protein']; ?>gr •
                        Fat <?= $m['fat']; ?>gr
                    </p>
                    <p class="price">Rp<?= number_format($m['price'],0,',','.'); ?></p>
                </div>

                <div class="qty-control">
                    <span>-</span>
                    <b><?= $m['qty']; ?></b>
                    <span>+</span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    </div>

    <div class="cart-footer">
        <span class="total">
            Price Total: <b>Rp<?= number_format($total,0,',','.'); ?></b>
        </span>

        <?php if(!empty($menus)): ?>
            <a href="pembayaran.php" class="btn-primary">Check Out</a>
        <?php endif; ?>
    </div>

</body>
</html>

