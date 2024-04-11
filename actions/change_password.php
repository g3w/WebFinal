<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('../settings/connection.php');

    $user_id = $_SESSION['user_id']; 

    $current_password_query = "SELECT password FROM Users WHERE userid = '$user_id'";
    $current_password_result = $conn->query($current_password_query);

    if ($current_password_result->num_rows > 0) {
        $row = $current_password_result->fetch_assoc();
        $current_password_db = $row['password'];

        $current_password = $_POST['current_password'];
        if (password_verify($current_password, $current_password_db)) {

            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                $update_password_query = "UPDATE Users SET password = '$hashed_password' WHERE userid = '$user_id'";
                if ($conn->query($update_password_query) === TRUE) {
                    echo "Password updated successfully.";
                    header("Location: ../Login/login.php");
                    exit();

                } else {
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                echo "New password and confirm password do not match.";
            }
        } else {
            echo "Incorrect current password.";
        }
    } else {
        echo "User not found.";
    }

    $conn->close();
}
