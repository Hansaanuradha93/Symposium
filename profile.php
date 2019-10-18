<?php
    // include_once 'dbconfig.php';

    $con=mysqli_connect("localhost","root","","symposium");
    // Check connection
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Pending Files</title>
    <link rel="stylesheet" href="style.css" type="text/css" /><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="css/card.css">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="home.php">Symposium</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <?php
                session_start();
                if($_SESSION['id'] == null) {
                    ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
                        </li>
                    <?php
                } else {
                    ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="upload.php">Upload <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="view.php">Pending <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="profile.php">Profile <span class="sr-only">(current)</span></a>
                        </li>
                    <?php
                }
            ?>
        
        </ul>
    </div>
    </nav>


    <?php

        // session_start();
        $id = $_SESSION['id'];
        

        if ($_SESSION['customer_type'] == 'student') {
            $sql="select *
            FROM Student
            WHERE s_id = '$id'";
        } else if($_SESSION['customer_type'] == 'supervisor') {
            $sql="select *
            FROM Supervisor
            WHERE s_id='$id'";
        }
        
        $result_set=mysqli_query($con,$sql) or die("Can not read files".mysqli_error($con));

        // select File.name, File.title, File.category, Status.name
        // from File
        // Join Status ON Status.s_id = File.status_id;
        while($row=mysqli_fetch_array($result_set,MYSQLI_ASSOC))
        {
    ?>
        
    <div class="card">
    <img src="images/user.png" alt="John" style="width:100%">
    <h1><?php echo $row['f_name'].' '.$row['l_name'] ?></h1>
    <p class="title"><?php echo $_SESSION['customer_type'] ?></p>
    <p>NSBM Green University</p>
    <a href="#"><i class="fa fa-dribbble"></i></a> 
    <a href="#"><i class="fa fa-twitter"></i></a> 
    <a href="#"><i class="fa fa-linkedin"></i></a> 
    <a href="#"><i class="fa fa-facebook"></i></a> 
    <form action="logout.php" method="POST">
        <input type="submit" value="Logout" name="submit">
    </form>
    </div>

    <?php
        }
    ?>
    

    <footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom">
      <div class="container text-center">
        <small>Copyright &copy; Your Website</small>
      </div>
    </footer>
</body>
</html>