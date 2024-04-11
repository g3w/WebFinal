<?php
include('../settings/connection.php');

session_start();
$user_id = $_SESSION['user_id'];

$totalSpotsQuery = "SELECT SUM(Total_number_of_spots) AS total_spots FROM Parkingspace WHERE userid = $user_id";
$totalSpotsResult = $conn->query($totalSpotsQuery);
$totalSpotsRow = $totalSpotsResult->fetch_assoc();
$totalSpots = $totalSpotsRow['total_spots'];

$availableSpotsQuery = "SELECT SUM(number_of_spots) AS available_spots FROM Parkingspace WHERE userid = $user_id";
$availableSpotsResult = $conn->query($availableSpotsQuery);
$availableSpotsRow = $availableSpotsResult->fetch_assoc();
$availableSpots = $availableSpotsRow['available_spots'];

$bookedSpots = $totalSpots - $availableSpots;

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

    .topping{
      margin-top: 120px;
    }

    #edit{
      margin-right: 10px;
    }

    #spaces-table{
      margin-top: 80px;
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
            <a href="#">
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
            <a href="../view/space_owner_profile.php">
              <i class="fas fa-tasks"></i>
              <span class="nav-item">Profile</span>
            </a>
          </li>

          <li>
            <a href="../view/customer_reviews.php">
              <i class="fas fa-tasks"></i>
              <span class="nav-item">Reviews</span>
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

        <h2 class="topping">Currently Booked Spots</h2>
        <table id="spaces-table">
          <thead>
            <tr>
              <th>User name</th>
              <th>Booking Date </th>
              <th>Start Time</th>
              <th>End Time</th>
            </tr>
          </thead>
          <tbody>
          <?php 
          require_once('../settings/connection.php');

          // Check if the connection was successful
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Query to fetch booking information along with user's first and last name
          $query = "SELECT Bookings.booking_date, Bookings.start_time, Bookings.end_time, Users.fname, Users.lname 
                    FROM Bookings 
                    INNER JOIN Users ON Bookings.userid = Users.userid";

          $result = $conn->query($query);

          // Check if the query execution was successful
          if ($result === false) {
              die("Error executing query: " . $conn->error);
          }

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>{$row['fname']} {$row['lname']}</td>"; // Displaying user's full name
                  echo "<td>{$row['booking_date']}</td>";
                  echo "<td>{$row['start_time']}</td>";
                  echo "<td>{$row['end_time']}</td>";
                  echo "</tr>";
              }
          } else {
              echo "No bookings found.";
          }

          // Close the database connection
          $conn->close();
          ?>
          </tbody>
        </table>
    
        <div id="space-details">
          <!-- Space details will be displayed here -->
        </div>
      </div>
    



    <div class="popup">
        <form id="chore-form" action="../actions/add_space_action.php" method="POST">
            <div class="popup-content">
                <ion-icon name="close" class="close"></ion-icon>
                <input type="text" name="location" id="location" placeholder="Space Location" required>
                <input type="text" name="number" id="number" placeholder="Number of  Spots" required>
                <input type="number" name="price" id="price" placeholder="Price" required>
                <button type="submit" class="button">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // jQuery script for handling the popup form
    $(document).ready(function () {
        $('#button').click(function () {
            $('.popup').css('display', 'flex');
        });

        $('.close').click(function () {
            $('.popup').css('display', 'none');
        });
    });
</script>






    </script>
  </body>
</html>

