<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$cart = $_SESSION['cart'] ?? [];
$orders = [];
$total = 0;

if(!empty($cart)){
    $ids = implode(',', array_keys($cart));
    $query = mysqli_query($conn, "SELECT * FROM menus WHERE id IN ($ids)");

    while($row = mysqli_fetch_assoc($query)){
        $row['qty'] = $cart[$row['id']];
        $row['subtotal'] = $row['price'] * $row['qty'];
        $total += $row['subtotal'];
        $orders[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="checkout.css">
</head>

<body class="checkout-page">

    <h2 class="page-title">Order Detail</h2>

    <div class="checkout-container">

        <div class="address-box">
            <label>Address</label>
            <textarea placeholder="Masukkan alamat lengkap pengiriman"></textarea>
        </div>

        <div class="order-list">
            <h3>Orders</h3>

            <?php foreach($orders as $o): ?>
                <div class="order-item">
                    <img src="assets/menu1.jpg" class="menu-img">

                    <div class="menu-info">
                        <h4><?= htmlspecialchars($o['name']); ?></h4>
                        <p class="nutrition">
                            Carbo <?= $o['carbo']; ?>gr •
                            Protein <?= $o['protein']; ?>gr •
                            Fat <?= $o['fat']; ?>gr
                        </p>
                        <p class="price">Rp<?= number_format($o['price'],0,',','.'); ?></p>
                    </div>

                    <span class="qty">x<?= $o['qty']; ?></span>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="cart-footer">
        <span class="total">
            Price Total: <b>Rp<?= number_format($total,0,',','.'); ?></b>
        </span>

        <button class="btn-primary">Pay Now</button>
    </div>

</body>
</html>
