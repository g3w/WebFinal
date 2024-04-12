<?php
session_start();
include('../settings/connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$current_date = date("Y-m-d");

$query = "SELECT bookings.booking_date, bookings.start_time, bookings.end_time, parkingspace.location, parkingspace.price
          FROM bookings 
          INNER JOIN parkingspace ON bookings.space_id = parkingspace.space_id
          WHERE bookings.userid = '$user_id' AND bookings.booking_date <'$current_date'";

$result = $conn->query($query);

if ($result === false) {
    die("Error executing query: " . $conn->error);
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

        .profile-info {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-info p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .profile-info h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

.add_container {
        position: absolute;
        top:  10%;
        left: 80%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: fit-content;

    }
    
    .container{
      width: 100% !important;
      /* margin: 0 5% !important; */
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
        width: 120px;
        text-align:center;
    }

    nav a{
      color: black;
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
        height: 400px;
        width: 500px;
        background:#fff;
        padding: 20px;
        border-radius: 5px;
        position: relative;

    }


    .popup-content2{
        height: 600px;
        width: 500px;
        background:#fff;
        padding: 10px;
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

.parkingSpot {
    width: 200px;
    height: 200px;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    margin: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    cursor: pointer;
}

.parkingSpot:hover {
    background-color: #e0e0e0;
}

.price{
  margin-top: 5px;
}

    </style>
  </head>
  <body>
    <div class="container-fluid row">
      <nav class="col-2">
      <ul>
          <li>
            <a href="../view/car_owner.php">
              <i class="fas fa-home"></i>
              <span class="nav-item">Current Bookings</span>
            </a>
          </li>
          <li>
            <a href="../view/search_spot.php">
              <i class="fas fa-tasks"></i>
              <span class="nav-item">Search Parking</span>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="fas fa-tasks"></i>
              <span class="nav-item">Booking History</span>
            </a>
          </li>

          <li>
            <a href="../view/profile.php">
                <i class="fas fa-tasks"></i>
              <span class="nav-item">Profile</span>
            </a>
          </li>



          <li>
            <a href="../view/change_password.php" class="settings">
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

      
      <section class="main col-10">
        <div class="main-top">
            <i class="fas fa-user-cog"></i>
        </div>
          




        <section class="chore-details m-5">
            <div class="chores">
                <h1>Welcome To Smart-Parking</h1>
                <h1>Booking History</h1>
            </div>
            <div class="profile-info">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Location</th>
                        <th>Price Paid</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['booking_date'] . "</td>";
                            echo "<td>" . $row['start_time'] . "</td>";
                            echo "<td>" . $row['end_time'] . "</td>";
                            echo "<td>" . $row['location'] . "</td>";
                            echo "<td>$" . $row['price'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr><td colspan="5">No bookings found.</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </section>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
