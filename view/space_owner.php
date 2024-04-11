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


$spaceQuery = "SELECT space_id FROM Parkingspace WHERE userid = '$user_id'";
$spaceResult = $conn->query($spaceQuery);

// Initialize total revenue variable
$totalRevenue = 0;

// 3. For each space ID, calculate the sum of payments made to that particular space ID
if ($spaceResult && $spaceResult->num_rows > 0) {
    while ($spaceRow = $spaceResult->fetch_assoc()) {
        $space_id = $spaceRow['space_id'];
        $paymentQuery = "SELECT SUM(amount) AS total_amount FROM Payments WHERE space_id = '$space_id'";
        $paymentResult = $conn->query($paymentQuery);
        if ($paymentResult && $paymentResult->num_rows > 0) {
            $paymentRow = $paymentResult->fetch_assoc();
            $totalAmount = $paymentRow['total_amount'];
            $totalRevenue += $totalAmount;
        }
    }
}
$conn->close();



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
  </head>
  <body>
    <div class="container">
      <nav>
        <ul>
          <li>
            <a href="#">
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
            <a href="../view/customer_reviews.php">
              <i class="fas fa-tasks"></i>
              <span class="nav-item">Reviews</span>
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
            <p><?php echo 'GHS' .$totalRevenue .'.00'; ?></p>
          </a>
        </div>

        <section class="chore-details">
                    <div class="chores">

                    </div>
                </section>
            </section>

  </body>
</html>

