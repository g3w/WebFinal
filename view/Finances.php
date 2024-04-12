<?php
include('../settings/connection.php');
session_start();

// 1. Retrieve the current user's ID
$user_id = $_SESSION['user_id'];
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
    <ion-icon src="/path/to/external/file.svg"></ion-icon>
    
     <style>


      .add_container {
        position: absolute;
        top:  10%;
        left: 80%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: fit-content;

    }

    .add_container h1{
        color: #fff;
        font-size: 36px;
        margin-bottom: 40px;
    }

    .button {
        background: #fff;
        padding: 10px 1px;
        color: #fff;
        border-radius: 5px;
        box-shadow: 6px 6px 29px -4px rgba(0, 0, 0, 0.75);
        margin-top: 25px;
        text-decoration: none;
        transition: 0.4s;
        display: inline-block;
        width: 90px;
        text-align:center;
    }





    .button:hover{
        background : #34495e;
        color: #fff;
    }

    



    #chore-table-body{
      background-color: #6d8792;
    }

    table{
      font-size: 30px;
    }

     .button, td{
      font-size: 18px;
    }

    .button {
      background-color: #34495e;
    }

    .popup {
        background: rgba(0, 0, 0, 0.6) ;
        width: 100%;
        height:100%;
        position: absolute;
        top: 0;
        display: none;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .popup-content{
        height: 300px;
        width: 500px;
        background:#fff;
        padding: 20px;
        border-radius: 5px;
        position: relative;

    }

    input {
        margin: 20px auto;
        display: block;
        width: 50%;
        padding: 8px;
        border: 1px solid gray;
    }

    .close   {
        position: absolute;
        top: -15px;
        right: -15px;
        background: #fff;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        box-shadow: 6px 6px 29px -4px rgba(0, 0, 0, 0.75);
        cursor: pointer;

    }

    #edit{
      margin-right: 10px;
    }

    </style>

  </head>
  <body>


    <div class="container">
      <nav>
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
            <a href="#">
                <i class="fas fa-university"></i>
              <span class="nav-item">Manage Finances</span>
            </a>
          </li>

          
          <li>
            <a href="../view/space_owner_profile.php">
              <i class="fas fa-tasks"></i>
              <span class="nav-item">Profile</span>
            </a>
          </li>



          <li>
            <a href="../view/space_change_password.php" class="settings">
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

      
      <section class="main">
        <div class="main-top">
        </div>
          <h1>My Finances</h1>


          <?php


// 2. Use the user ID to retrieve the space IDs corresponding to the spaces added by this user
$spaceQuery = "SELECT space_id FROM parkingspace WHERE userid = '$user_id'";
$spaceResult = $conn->query($spaceQuery);

// Initialize total revenue variable
$totalRevenue = 0;

// 3. For each space ID, calculate the sum of payments made to that particular space ID
if ($spaceResult && $spaceResult->num_rows > 0) {
    while ($spaceRow = $spaceResult->fetch_assoc()) {
        $space_id = $spaceRow['space_id'];
        $paymentQuery = "SELECT SUM(amount) AS total_amount FROM payments WHERE space_id = '$space_id'";
        $paymentResult = $conn->query($paymentQuery);
        if ($paymentResult && $paymentResult->num_rows > 0) {
            $paymentRow = $paymentResult->fetch_assoc();
            $totalAmount = $paymentRow['total_amount'];
            $totalRevenue += $totalAmount;
        }
    }
}

// Display the total revenue for all spaces
echo "<div class='main-skills'>";
echo "<div class='card'>";
echo "<h3>Total Revenue for All Spaces</h3>";
echo "<p> GHS$totalRevenue .00</p>";
echo "</div>";
echo "</div>";
?>







            <table id="spaces-table">
                      <thead>
                        <tr>
                          <th>User name</th>
                          <th>Payment Date</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>


                      <?php

          // Query to fetch booking information along with user's first and last name
          $query = "SELECT payments.payment_date, payments.amount,users.fname, users.lname 
                    FROM payments 
                    INNER JOIN users ON payments.userid = users.userid";

          $result = $conn->query($query);

          // Check if the query execution was successful
          if ($result === false) {
              die("Error executing query: " . $conn->error);
          }

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>{$row['fname']} {$row['lname']}</td>"; // Displaying user's full name
                  echo "<td>{$row['payment_date']}</td>";
                  echo "<td>{$row['amount']}</td>";
                  echo "</tr>";
              }
          } else {
              echo "No bookings found.";
          }

          // Close the database connection
          $conn->close();
          ?>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </body>
</html>

