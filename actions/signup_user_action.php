?<?php

include('../settings/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $account = $_POST["account"];
    $phone = $_POST["tel"];
    $email = $_POST["email"];
    $password = password_hash($_POST["passwd"], PASSWORD_DEFAULT);

    $genderString = ($gender == 0) ? "Female" : "Male";

    if ($account == 0) {
        $rolename = 'Spot owner';
    } elseif ($account == 1) {
        $rolename = 'Car owner';
    }

    // Query the Role table to get the roleid based on the rolename
    $roleQuery = "SELECT roleid FROM role WHERE rolename = '$rolename'";
    $roleQueryResult = $conn->query($roleQuery);

    if ($roleQueryResult === FALSE) {
        echo "Error: " . $roleQuery . "<br>" . $conn->error;
    } elseif ($roleQueryResult->num_rows > 0) {
        $RoleRow = $roleQueryResult->fetch_assoc();
        $roleid = $RoleRow["roleid"];

        // Check if there is already a user with the same email
        $checkEmailQuery = "SELECT email FROM users WHERE email = '$email'";
        $stmt = $conn->prepare($checkEmailQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "A user with this email already exists.";
            error_log("User with the same email already exists");
            header("Location: ../view/signup.php");
            exit();
        }

        // Insert the user data into the users table
        $sql = "INSERT INTO users (fname, lname, gender, phone, email, password, roleid) 
                VALUES ('$fname', '$lname', '$gender', '$phone', '$email', '$password', '$roleid')";

        if ($conn->query($sql) === TRUE) {
            // Redirect the user based on their role

            header("Location: ../Login/login.php");
            exit();

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Role not found.";
        echo "Error: " . $roleQuery . "<br>" . $conn->error;
    }
} else {
    echo "Error: Family role not found.";
    echo "Error: " . $roleQuery . "<br>" . $conn->error;
}

$conn->close();
