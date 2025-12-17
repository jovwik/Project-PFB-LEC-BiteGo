<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = $_POST['email'];
    $password = $_POST['pass'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role']    = $user['role'];
            $_SESSION['name']    = $user['name'];

            if ($user['role'] === 'vendor') {
                header("Location: vendor_dashboard.php");
            } else {
                header("Location: home_user.php");
            }
            exit;
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-login">
    <nav>
        <img src="assets/PAWHUB.png" alt="Logo">
        <a href="home_guest.php">Home</a>
    </nav>

    <form id="login-form" action="login.php" method="POST">
         <img src="assets/PAWHUB.png" alt="BiteJoe" class="card-logo">
        <h3>Log In</h3>
    
        <div>
            <input type="text" id="reg-username"  name="username" placeholder="Username">
        </div>

        <div>
            <input type="text" id="reg-email" name="email" placeholder="Email">
        </div>

        <div>
            <input type="password" id="reg-pass" name="pass" placeholder="Password">
        </div>


        <button id="login-button" type="submit">SIGN IN</button>

        <div>
            <p>Don’t have an account? <a href="register.php">Sign Up</a> </p>
        </div>

    </form>
    
</body>
</html>
