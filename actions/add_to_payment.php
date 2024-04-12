<?php
include('../settings/connection.php');

session_start();


$user_id = $_SESSION['user_id'];


$bookingDetails = $_SESSION['bookingDetails'] ?? null;

if ($bookingDetails) {
    $bookingId = $bookingDetails['bookingId'];
    $space_id = $bookingDetails['space_id'];
    $bookingDate = $bookingDetails['bookingDate'];
    $startTime = $bookingDetails['startTime'];
    $endTime = $bookingDetails['endTime'];
}

$priceQuery = "SELECT price FROM Parkingspace WHERE space_id = '$space_id'";
$priceResult = $conn->query($priceQuery);

if ($priceResult) {
    if ($priceResult->num_rows > 0) {
        // Fetch the row
        $priceRow = $priceResult->fetch_assoc();
        $price = $priceRow['price'];
    } else {
        $price = "Price not found";
    }
} else {
    $price = "Error fetching price: " . $conn->error;
}


$sql = "INSERT INTO payments (booking_id, userid, space_id, amount, payment_date, payment_method) 
        VALUES ('$bookingId', '$user_id', '$space_id', '$price', NOW(), 'mobile money')";

if ($conn->query($sql) === TRUE) {

    header("Location: ../view/search_spot.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

