<?php   
include('../settings/connection.php');
 
if (isset($_GET['id'])) {  
    $parking_space_id = $_GET['id'];  
    $query = "DELETE FROM parkingspace WHERE space_id = '$parking_space_id'";  
    $result = $conn->query($query);  
    if ($result === TRUE) {  
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {  
        echo "Error: " . $conn->error;  
    }  
}  
?>
