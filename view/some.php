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

$bookings = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Create DateTime objects
        $start_time = new DateTime($row['start_time']);
        $end_time = new DateTime($row['end_time']);
        $current_time = new DateTime();

        // Calculate time remaining for each booking
        $time_left = $end_time->getTimestamp() - $current_time->getTimestamp();

        // Format booking data
        $booking = [
            'booking_date' => $row['booking_date'],
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'time_left' => $time_left // Adding time left to JSON response
        ];

        $bookings[] = $booking;
    }
}

header('Content-Type: application/json');
echo json_encode($bookings);
