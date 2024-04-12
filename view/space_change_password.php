
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Parking</title>
    <link rel="stylesheet" href="../css/dash_style.css" />
    <link rel="stylesheet" href="../css/admin_style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>


.container-fluid {
            margin-top: 20px;
        }

        .nav-item {
            font-size: 18px;
        }

        .main-top {
            font-size: 24px;
            margin-bottom: 20px;
        }


        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            font-weight: bold;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #34495e;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }


    </style>
  </head>
  <body>
    <div class="container-fluid row">
      <nav class="col-2">
      <ul>
      <li>
            <a href="../view/space_owner.php">
              <i class="fas fa-home"></i>
              <span class="nav-item">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="../view/manage_spaces.php">
              <i class="fas fa-tasks"></i>
              <span class="nav-item">Manage Spaces</span>
            </a>
          </li>

          <li>
            <a href="../view/bookings.php">
              <i class="fas fa-tasks"></i>
              <span class="nav-item">Bookings</span>
            </a>
          </li>

          <li>
            <a href="../view/Finances.php">
              <i class="fas fa-university"></i>
              <span class="nav-item">Manage Finances</span>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="fas fa-tasks"></i>
              <span class="nav-item">Profile</span>
            </a>
          </li>


          <li>
            <a href="#" class="settings">
              <i class="fas fa-cog"></i>
              <span class="nav-item">Change Password</span>
            </a>
          </li>
          <li>
            <a href="#" class="help">
              <i class="fas fa-question-circle"></i>
              <span class="nav-item">Help</span>
            </a>
          </li>
          <li>
            <a href="../Login/logout.php" class="logout">
              <i class="fas fa-sign-out-alt"></i>
              <span class="nav-item">Log out</span>
            </a>
          </li>
        </ul>
      </nav>
      <section class="chore-details m-5">
          <div class="chores">
              <h1>Welcome To Smart-Parking</h1>
              <h1>Password Settings</h1>
          </div>


    <form action="../actions/change_password.php" method="POST">
    <label for="current_password">Current Password:</label><br>
        <input type="password" id="current_password" name="current_password" required><br><br>
        
        <label for="new_password">New Password:</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>
        
        <label for="confirm_password">Confirm New Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        
        <button type="submit">Change Password</button>
    </form>



        </section>
      </section>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  </body>
</html>


