<?php
include('../settings/connection.php');

session_start();
$user_id = $_SESSION['user_id'];

$totalSpotsQuery = "SELECT SUM(Total_number_of_spots) AS total_spots FROM parkingspace WHERE userid = $user_id";
$totalSpotsResult = $conn->query($totalSpotsQuery);
$totalSpotsRow = $totalSpotsResult->fetch_assoc();
$totalSpots = $totalSpotsRow['total_spots'];

$availableSpotsQuery = "SELECT SUM(number_of_spots) AS available_spots FROM parkingspace WHERE userid = $user_id";
$availableSpotsResult = $conn->query($availableSpotsQuery);
$availableSpotsRow = $availableSpotsResult->fetch_assoc();
$availableSpots = $availableSpotsRow['available_spots'];

$bookedSpots = $totalSpots - $availableSpots;

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
            <a href="#">
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
            <div class="add_container">
                <a href="#" class="button" id="button">Add Space</a>
            </div>
          <h1>DASHBOARD</h1>
            <i class="fas fa-user-cog"></i>
        </div>
          <h1>Space Statistics</h1>


        <div class="main-skills">
          <a href="../view/manage_spaces.php" class="card">
            <i class="fas fa-clock"></i>
            <h3>Total Spots</h3>
            <p><?php echo $totalSpots; ?></p>
          </a>
          <a href="../view/manage_spaces.php" class="card">
            <i class="fas fa-exclamation"></i>
            <h3>Booked</h3>
            <p><?php echo $bookedSpots; ?></p>
          </a>
          <a href="../view/manage_spaces.php" class="card">
            <i class="fas fa-check"></i>
            <h3>Available</h3>
            <p><?php echo $availableSpots; ?></p>
          </a>

          <a href="../view/manage_spaces.php" class="card">
            <i class="fas fa-check"></i>
            <h3>Revenue</h3>
            <p><?php echo 'GHS'. $totalRevenue.'.00'; ?></p>
          </a>
        </div>

        <h2>Existing Spaces</h2>
        <table id="spaces-table">
          <thead>
            <tr>
              <th>Location</th>
              <th>Spots</th>
              <th>Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php 
              require_once('../settings/connection.php');
              $query = "SELECT * FROM parkingspace";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>{$row['location']}</td>";
                      echo "<td>{$row['number_of_spots']}</td>";
                      echo "<td>{$row['price']}</td>";
                      echo "<td>";
                      echo "<a class='button edit' href='../actions/edit_spaces.php?id={$row['space_id']}'>Edit</a>";
                      echo "<a class='button delete' href='../actions/delete_space.php?id={$row['space_id']}'>Delete</a>";
                      echo "</td>";
                      echo "</tr>";
                  }
              }
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

