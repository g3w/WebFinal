<?php      
    $host = "localhost";  
    $user = "phpmyadmin";  
    $password = 'abigail2005@';  
    $db_name = "park";  
      
    $conn = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
