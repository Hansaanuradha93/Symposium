<?php
    // Start the session
    session_start();

    // Connect to database
    $con=mysqli_connect("localhost","root","","symposium");
    // Check connection
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $faculty = $_POST['faculty'];
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];
        $customer_type = $_POST['customer_type'];

        if ($id != null && $fname != null && $lname != null && $email != null && $faculty != null && $password != null && $re_password != null && $password == $re_password) {
            // hash the password
            $password = md5($password);

            if($faculty == 'management') {
                $faculty_id = 1;
            } else if ($faculty == 'computing') {
                $faculty_id = 2;
            } else {
                $faculty_id = 3;
            }

            if($customer_type == 'supervisor') {
                // Save the Supervisor in the database
                $sql="INSERT INTO Supervisor(s_id,f_name,l_name,email,faculty_id,password) VALUES('$id','$fname','$lname','$email','$faculty_id','$password')";
                    
                mysqli_query($con,$sql) or die("Can not insert files".mysqli_error($con));


            } else if ($customer_type == 'student') {
                // Save the Supervisor in the database
                $sql="INSERT INTO Student(s_id,f_name,l_name,email,faculty_id,password) VALUES('$id','$fname','$lname','$email','$faculty_id','$password')";
                    
                mysqli_query($con,$sql) or die("Can not insert files".mysqli_error($con));
            }

            // Save information in a session
            $_SESSION['id'] = $id;
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['email'] = $email;
            $_SESSION['faculty_id'] = $faculty_id;
            $_SESSION['customer_type'] = $customer_type;

            // Redirect to home.php
            header("location: home.php");
            ?>

            <script>
            alert('successfully uploaded');
            </script>

            <?php
            } else {
            ?>
                <script>
                alert('error while uploading file');
                </script>
            <?php
            }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="home.php">Symposium</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="upload.php">Upload <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="view.php">Pending <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="signup.php">Sign Up <span class="sr-only">(current)</span></a>
        </li><li class="nav-item active">
            <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
        </li>
        
        </ul>
    </div>
    </nav>
    
    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="" id="signup-form" class="signup-form">
                        <h2 class="form-title">Signup Here</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="fname" id="name" placeholder="First Name"/>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-input" name="lname" id="name" placeholder="Last Name"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="id" id="id" placeholder="Student ID / Employee ID"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>


                        <div class="form-group">

                            <label class="form-input">Faculty</label>
                            <label class="radio-inline"><input type="radio" value ="engineering" name="faculty"checked>Engineering</label>
                            <label class="radio-inline"><input type="radio" value ="computing"  name="faculty">Computing</label>
                            <label class="radio-inline"><input type="radio" value ="management" name="faculty">Management</label>

                        </div>

                        <div class="form-group">

                            <label class="form-input">User Type</label>
                            <label class="radio-inline"><input type="radio" value ="supervisor" name="customer_type"checked>Supervisor</label>
                            <label class="radio-inline"><input type="radio" value ="student"  name="customer_type">Student</label>

                        </div>
                        
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="login.php" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom">
      <div class="container text-center">
        <small>Copyright &copy; Your Website</small>
      </div>
    </footer>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>