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

.booking-box {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .countdown {
            font-size: 18px;
        }


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

    
    .booking-box {
    background-color: #f9f9f9;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.booking-info p {
    font-size: 16px;
    margin-bottom: 5px;
}

.countdown {
    font-size: 14px;
    color: #777;
    margin-top: 5px;
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

#timer {
        font-size: 36px;
        margin: 5%;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    strong, #start, #end {
      display: inline;
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
            <a href="../view/booking_history.php">
              <i class="fas fa-tasks"></i>
              <span class="nav-item">Booking History</span>
            </a>
          </li>

          <li>
            <a href="../view/booking_history.php">
                <i class="fas fa-tasks"></i>
              <span class="nav-item">Profile</span>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="fas fa-tasks"></i>
              <span class="nav-item">Notifications</span>
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
          

      
      <section class="chore-details">
          
          <div class="chores">
            <h1>Current Bookings</h1>
          </div>
          <div id="timer">Countdown Timer</div> <!--timerrrrr -->
          <div id="bookings-container" class="bookings-container">
          <?php
require_once('../settings/connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT Bookings.booking_date, Bookings.start_time, Bookings.end_time, Users.fname, Users.lname 
        FROM Bookings 
        INNER JOIN Users ON Bookings.userid = Users.userid";

$result = $conn->query($query);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $start_time = strtotime($row['start_time']);
        $end_time = strtotime($row['end_time']);
        $current_time = time();

        echo '<div class="booking-box">';
        echo '<div class="booking-info">';
        echo '<p><strong>Booking Date:</strong> ' . $row['booking_date'] . '</p>';
        echo '<strong>Start Time:</strong><p id="start">' . $row['start_time'] . '</p> <br>';
        echo '<strong>End Time:</strong><p id="end">' . $row['end_time'] . '</p>';
        echo '</div>';



        echo '</div>';
    }
} else {
    echo '<p>No bookings found.</p>';
}

$conn->close();
?>
            </div>
        </section>
    </section>
</div>

<script>
    // start and end times
    const start = document.getElementById("start").innerText;
    const end = document.getElementById("end").innerText;

    // break numbers apart
    start_ind = start.split(':');
    end_ind = end.split(':')

    // Set the start and end time
    const startTime = new Date(); // Current time
    const endTime = new Date(); // Set your end time
    
    startTime.setHours(start_ind[0], start_ind[1], start_ind[2])
    endTime.setHours(end_ind[0], end_ind[1], end_ind[2]); // Example: 11:59:59 PM


    // Update the countdown every second
    const timerInterval = setInterval(updateTimer, 1000);
    var sec = -1;
    function updateTimer() {
        sec ++;
        startTime.setSeconds(sec);
        var timeDifference = endTime - startTime;
       
        if (timeDifference <= 0) {
            clearInterval(timerInterval);
            document.getElementById("timer").innerText = "Time's up!";
            return;
        }

        const hours = Math.floor(timeDifference / (1000 * 60 * 60));
        const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

        document.getElementById("timer").innerText = `Time Left: ${hours}h ${minutes}m ${seconds}s`;
    }
</script>

  </body>
</html>



