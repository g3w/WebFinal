<?php
include('../settings/connection.php');

if (isset($_POST['submit'])) {
    $space_id = $_GET['space_id']; 
    $location = $_POST['location'];
    $number_of_spots = $_POST['number_of_spots']; 
    $price = $_POST['price'];

    $sql = "UPDATE Parkingspace SET location = '$location', number_of_spots = '$number_of_spots', price = '$price' WHERE space_id = $space_id"; 
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "Record updated successfully.";
        header('Location:../view/manage_spaces.php');
        exit();
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['space_id'])) {
    $space_id = $_GET['space_id'];
    $sql = "SELECT * FROM Parkingspace WHERE space_id='$space_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $space_id = $row['space_id'];
            $location = $row['location'];
            $number_of_spots = $row['number_of_spots'];
            $price = $row['price'];
        }
    } else {
        header('Location:../view/manage_spaces.php');
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Parking Space</title>
</head>
<body>

<h2>Edit Parking Space Form</h2>
<form action="" method="post">
    <fieldset>
        <legend>Parking Space Information:</legend>
        Location:<br>
        <input type="text" name="location" required><br><br>
        Number of Spots:<br>
        <input type="text" name="number_of_spots" required><br><br>
        Price:<br>
        <input type="text" name="price" required><br><br>
        <input type="hidden" name="space_id" value="<?php echo $space_id; ?>">
        <br><br>
        <input type="submit" value="Submit" name="submit">
    </fieldset>
</form>

</body>
</html>



