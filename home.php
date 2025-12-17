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
        <a href="Home.php">Home</a>
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


        <button id="login-button" type="submit">Login</button>

        <div>
            <p>Don’t have an account? <a href="register.php">Register Here</a> </p>
        </div>

    </form>
    
</body>
</html>
