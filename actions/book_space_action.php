<?php
include('../settings/connection.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $space_id = $_POST['space_id'];
    $bookingDate = $_POST["bookingDate"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];

    $currentDateTime = strtotime(date("Y-m-d H:i:s"));
    $selectedDateTime = strtotime("$bookingDate $startTime");

    // if ($selectedDateTime < $currentDateTime) {
    //     echo "Booking date and time cannot be in the past.";
    //     exit(); 
    // }

    if ($endTime <= $startTime) {
        echo "End time must be greater than start time.";
        exit();
    }

    $priceQuery = "SELECT price FROM parkingspace WHERE space_id = '$space_id'";
    $priceResult = $conn->query($priceQuery);
    $row = $priceResult->fetch_assoc();
    $price = $row['price'];

    $bookingSql = "INSERT INTO bookings (userid, space_id, booking_date, start_time, end_time) 
            VALUES ('$user_id', '$space_id', '$bookingDate', '$startTime', '$endTime')";

    if ($conn->query($bookingSql) === TRUE) {
        // Obtain the booking ID after successful insertion
        $bookingId = $conn->insert_id;

        // Store booking details and booking ID in session
        $_SESSION['bookingDetails'] = [
            'bookingId' => $bookingId,
            'space_id' => $space_id,
            'bookingDate' => $bookingDate,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'price' => $price
        ];

        // Update the status of the parking space
        $updateStatusSql = "UPDATE parkingspace SET number_of_spots = CASE 
                            WHEN number_of_spots > 0 THEN number_of_spots - 1 
                            ELSE number_of_spots END,               
                        status_id = CASE 
                        WHEN number_of_spots <= 0 THEN 1 
                        ELSE status_id  END WHERE space_id = $space_id";

        if ($conn->query($updateStatusSql) === TRUE ) {
            header("Location: ../actions/payment.php");
            exit();
        } else {
            echo "Error updating status: " . $conn->error;
        }
    } else {
        echo "Error inserting booking: " . $conn->error;
    }
}

$conn->close();
