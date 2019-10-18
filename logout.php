<?php
    if(isset($_POST['submit'])) {
        session_start();

        // Unset session values
        unset($_SESSION['id']);
        unset($_SESSION['fname']);
        unset($_SESSION['lname']);
        unset($_SESSION['email']);
        unset($_SESSION['faculty_id']);
        unset($_SESSION['customer_type']);

        // Destroy the session
        session_destroy();
        
        header("Location: home.php");
        exit;
        }
?>