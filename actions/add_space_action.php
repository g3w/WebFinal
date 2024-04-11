<?php
include('../settings/connection.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $location = $_POST["location"];
    $number = $_POST["number"];
    $price = $_POST["price"];

    $sql = "INSERT INTO parkingspace (location, number_of_spots, price, userid, Total_number_of_spots) VALUES ('$location', '$number','$price', '$user_id', '$number')";

    if ($conn->query($sql) === TRUE) {
        echo "the query obviouly worked";

        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    echo $user_id;
}

$conn->close();



