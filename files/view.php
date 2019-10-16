<?php

    echo $_SESSION['customer_type'];
    // if($_SESSION['customer_type'] == null) {
    //     // User not logged in
    //     header("location: login.php");
    // } else if($_SESSION['customer_type'] == 'student') {
    //     // User is a student
    //     include 'user_pending_files.php';
    // } else if ($_SESSION['customer_type'] == 'supervisor') {
    //     // User is a supervisor
    //     include 'supervisor_pending_files.php';
    // }            

?>