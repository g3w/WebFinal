<?php

include('../settings/connection.php');
session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE Users SET fname='$fname', lname='$lname', email='$email', phone='$phone' WHERE userid='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}

