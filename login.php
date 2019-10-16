<?php
    // Start the session
    session_start();

    // Connect to database
    $con=mysqli_connect("localhost","root","","symposium");
    // Check connection
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
<?php


    if(isset($_POST['id']) && isset($_POST['password'])) {
        $id = mysqli_real_escape_string($con,$_POST['id']);
        $password = mysqli_real_escape_string($con,$_POST['password']); 


        if (empty($id) && empty($password)) {
            $error = "ID and Password are required";
            echo $error;
        } else if(empty($id)) {
            $error = "ID is required";
            echo $error;
        } else if(empty($password)) {
            $error = "Password is required";            
            echo $error;
        }
        else {
            // Looking good
            // Hash the password
            $password = md5($password);


            $student_sql="select st.s_id as student_id,st.f_name as student_first_name,st.l_name as student_last_name,st.email as student_email,st.faculty_id as student_faculty_id,st.password as student_password  FROM Student st 
            WHERE st.s_id = '$id' AND st.password='$password';";
            $student_result=mysqli_query($con,$student_sql) or die("Can not read files".mysqli_error($con));
            $student_row = mysqli_fetch_array($student_result,MYSQLI_ASSOC);
            $student_count = mysqli_num_rows($student_result);

            $supervisor_sql="select sp.s_id as supervisor_id,sp.f_name as supervisor_first_name,sp.l_name as supervisor_last_name,sp.email as supervisor_email,sp.faculty_id as supervisor_faculty_id,sp.password as supervisor_password  FROM Supervisor sp
            WHERE sp.s_id = '$id' AND sp.password='$password';";
            $supervisor_result=mysqli_query($con,$supervisor_sql) or die("Can not read files".mysqli_error($con));
            $supervisor_row = mysqli_fetch_array($supervisor_result,MYSQLI_ASSOC);
            $supervisor_count = mysqli_num_rows($supervisor_result);


            $student_row['student_id'];

            if($student_count == 1) {
                echo 'Student Logged in';
                // Save information in a session
                $_SESSION['id'] = $student_row['student_id'];
                $_SESSION['fname'] = $student_row['student_first_name'];
                $_SESSION['lname'] = $student_row['student_last_name'];
                $_SESSION['email'] =$student_row['student_email'];
                $_SESSION['faculty_id'] = $student_row['student_faculty_id'];
                $_SESSION['customer_type'] = 'student';

                // Redirect to home.php
                header("location: home.php");
            } else if ($supervisor_count == 1) {
                echo 'Supervisor Logged in';
                // Save information in a session
                $_SESSION['id'] = $supervisor_row['supervisor_id'];
                $_SESSION['fname'] = $supervisor_row['supervisor_first_name'];
                $_SESSION['lname'] = $supervisor_row['supervisor_last_name'];
                $_SESSION['email'] =$supervisor_row['supervisor_email'];
                $_SESSION['faculty_id'] = $supervisor_row['supervisor_faculty_id'];
                $_SESSION['customer_type'] = 'supervisor';

                // Redirect to home.php
                header("location: home.php");
            } else {
                echo 'Loggin failed';
            }

        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form action="" method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Login Here</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="id" id="email" placeholder="Student ID / Employee ID"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Login"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        New Here ? <a href="signup.php" class="loginhere-link">Signup here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>