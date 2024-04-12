<?php
include('../settings/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["passwd"];

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            $roleid = $row["roleid"];

            if ($roleid == 1 ) {
                session_start();
                $_SESSION['user_id']= $row['userid'];
                header("Location: ../view/space_owner.php");
                exit();

            } elseif ($roleid == 2) {
                session_start();
                $_SESSION['user_id']= $row['userid'];
                header("Location: ../view/car_owner.php");
                exit();

            } else {
                echo "Incorrect password. Please try again.";
                header("Location: ../Login/login.php");
                exit();
            }
        } else {
            echo "Incorrect password. Please try again.";
            header("Location: ../Login/login.php");
            exit();

        }
    } else {
        echo "User not found. Please check your email.";

        header("Location: ../Login/login.php");
        exit();
    }
}

$conn->close();

