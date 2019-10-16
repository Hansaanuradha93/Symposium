<?php
    $con=mysqli_connect("localhost","root","","symposium");
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql="INSERT INTO File(name,type,size) VALUES('hello','hello','102.318359375')";
                    
    mysqli_query($con,$sql);
?>