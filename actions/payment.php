<?php
// Include the connection file to access user details
include('../settings/connection.php');

// Start the session
session_start();

$bookingDetails = $_SESSION['bookingDetails'] ?? null;


if ($bookingDetails) {
    $bookingId = $bookingDetails['bookingId'];
    $space_id = $bookingDetails['space_id'];
    $bookingDate = $bookingDetails['bookingDate'];
    $startTime = $bookingDetails['startTime'];
    $endTime = $bookingDetails['endTime'];
}

// Execute the SQL query to fetch the price
$priceQuery = "SELECT price FROM Parkingspace WHERE space_id = '$space_id'";
$priceResult = $conn->query($priceQuery);

// Check if the query was successful
if ($priceResult) {
    // Check if there is at least one row returned
    if ($priceResult->num_rows > 0) {
        // Fetch the row
        $priceRow = $priceResult->fetch_assoc();
        // Retrieve the price from the row
        $price = $priceRow['price'];
    } else {
        // Handle the case where no rows were returned
        $price = "Price not found";
    }
} else {
    // Handle the case where the query failed
    $price = "Error fetching price: " . $conn->error;
}

// Fetch user details from the server
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $userQuery = "SELECT email, fname, lname FROM Users WHERE userid = '$user_id'";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $row = $userResult->fetch_assoc();
        $email = $row['email'];
        $first_name = $row['fname'];
        $last_name = $row['lname'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/payment.css">
    <title>Smart-Parking</title>
</head>
<body>
    <form id="paymentForm">
        <div class="form-group">
            <label for="email">Email Address</label>
            <!-- Populate the email field with user's email -->
            <input type="email" id="email-address" value="<?php echo $email; ?>" required />
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" id="amount" value="<?php echo $price; ?>" />
        </div>
        <div class="form-group">
            <label for="first-name">First Name</label>
            <!-- Populate the first name field with user's first name -->
            <input type="text" id="first-name" value="<?php echo $first_name; ?>" />
        </div>
        <div class="form-group">
            <label for="last-name">Last Name</label>
            <!-- Populate the last name field with user's last name -->
            <input type="text" id="last-name" value="<?php echo $last_name; ?>" />
        </div>
        <div class="form-submit">
            <button type="submit" onclick="payWithPaystack()"> Pay </button>
        </div>
    </form>


    <script src="https://js.paystack.co/v1/inline.js"></script> 
    <script >
      const paymentForm = document.getElementById('paymentForm');
      paymentForm.addEventListener("submit", payWithPaystack, false);
      function payWithPaystack(e) {
        e.preventDefault();

        let handler = PaystackPop.setup({
          key: 'pk_test_626697ef1b4b824407f786e142394b326163604d', // Replace with your public key
          email: document.getElementById("email-address").value,
          amount: document.getElementById("amount").value * 100,
          currency: 'GHS',
          ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
          onClose: function(){
            alert('Window closed.');
          },
          callback: function(response){
            let message = 'Payment complete! Reference: ' + response.reference;
            alert(message);
            window.location.href = '../actions/add_to_payment.php';
          }
        });

        handler.openIframe();
      }
    </script>
</body>
</html>

