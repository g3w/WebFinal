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
            <form action="../actions/signup_user_action.php" name="form" method="POST"
                onsubmit="return system_validation()">
                <h2>SIGN UP</h2>
                <div class="type-box">
                    <i class='bx bx-user-circle'></i>
                    <input type="text" name="fname" placeholder="firstname">
                </div>

                <div class="type-box">
                    <i class='bx bx-user-circle'></i>
                    <input type="text" name="lname" placeholder="lastname">
                </div>


                <div class="type-box">
                    <i class='bx bxs-envelope'></i>
                    <input type="text" name="email" placeholder="Email">
                </div>


                <div class="type-box">
                    <i class='bx bxs-user'></i>
                    <label class="lab">Select Gender</label><br>
                    <input type="radio" id="gender_female" name="gender" value="Female">
                    <label class="lab" for="gender_female">Female</label><br>
                    <input type="radio" id="gender_male" name="gender" value="Male">
                    <label class="lab" for="gender_male">Male</label><br>
                </div>

                <div class="type-box">
                    <i class='bx bxs-user'></i>
                    <label class="lab">Select Account Type</label><br>
                    <input type="radio" id="gender_female" name="account" value="0">
                    <label class="lab" for="gender_female">Spot Owner</label><br>
                    <input type="radio" id="gender_male" name="account" value="1">
                    <label class="lab" for="gender_male">Car Owner</label><br>
                </div>

                <div class="type-box">
                    <i class='bx bxs-phone'></i>
                    <label class="lab" for="phone">Enter a phone number</label><br>
                    <input type="tel" id="phone" name="tel" placeholder="1234567890" pattern="[0-9]{10}" required>
                </div>

                <div class="type-box">
                    <i class='bx bx-lock'></i>
                    <input type="password" name="passwd" placeholder="Password">
                </div>

                <div class="type-box">
                    <i class='bx bx-lock'></i>
                    <input type="text" name="confirmPassword" placeholder="Confirm">
                </div>

                <div class="button">
                    <a href="../view/landing.php"><input type="submit" class="submit-btn" value="Sign UP"></a>
                </div>

                <div class="group">
                    <span><a href="a">Forget Password</a></span>
                    <span><a href="login.php">Login</a></span>
                </div>

            </form>
        </div>

    </div>
    <script src="../js/index.js"></script>
</body>

</html>