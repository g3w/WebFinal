<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parking</title>
    <link rel="stylesheet" href="../css/register.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
</head>

<body>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <div class="container">
        <div class="form-area">
            <form action="../actions/login_user_action.php" name="form" method="POST" onsubmit="return login_validation()">
                <p id="result">result</p>
                <h2>Login</h2>
                <div class="type-box">
                    <i class='bx bxs-envelope'></i>
                    <input type="text" name="email" placeholder="Email">
                </div>

                <div class="type-box">
                    <i class='bx bx-lock'></i>
                    <input type="password" name="passwd" placeholder="Password">
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>


                <div class="button">
                    <input type="submit" class="submit-btn" value="Login">
                </div>

                <div class="group">
                    <span><a href="#">Forget Password</a></span>
                    <span><a href="../Login/signup.php">Sign Up</a></span>
                </div>

            </form>
        </div>

    </div>
    <script src="../js/index.js"></script>
</body>

</html>