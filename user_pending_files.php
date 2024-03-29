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

    <div id="body" class="container-fluid">

        <h1 class="display-4">Pending Reseach Papers</h1>

        <table class="table table-striped text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Supervisor</th>
                        <th scope="col">Faculty</th>
                        <th scope="col">Supervisor</th>
                    </tr>

                </thead>

            </tr>
            <?php

                // session_start();
                $student_id = $_SESSION['id'];

                $sql="select f.name as file_name, f.title as file_title, f.category as file_category, s.name as status_name, st.f_name as first_name, st.l_name as last_name, fc.name as faculty_name, sp.f_name as supervisor_first_name, sp.l_name as supervisor_last_name FROM File f
                Join Status s ON s.s_id = f.status_id
                JOIN Student st ON f.student_id = st.s_id
                JOIN Faculty fc ON fc.f_id = f.faculty_id
                JOIN Supervisor sp ON sp.s_id = f.supervisor_id
                WHERE f.student_id = '$student_id'
                AND f.status_id='0'";
                $result_set=mysqli_query($con,$sql) or die("Can not read files".mysqli_error($con));


                // select File.name, File.title, File.category, Status.name
                // from File
                // Join Status ON Status.s_id = File.status_id;
                while($row=mysqli_fetch_array($result_set,MYSQLI_ASSOC))
                {
            ?>
                <tr>
                <th scope="row"><?php echo $row['file_title'] ?></th>
                <td><?php echo $row['file_category'] ?></td>
                <td><?php echo $row['status_name'] ?></td>
                <td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
                <td><?php echo $row['faculty_name'] ?></td>
                <td><?php echo $row['supervisor_first_name']." ". $row['supervisor_last_name']?></td>
                <td><a href="files/<?php echo $row['file_name'] ?>" target="_blank">View file</a></td>
                </tr>
                <?php
                }
            ?>
        </table>
    
</div>

    <footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom">
      <div class="container text-center">
        <small>Copyright &copy; Your Website</small>
      </div>
    </footer>
</body>
</html>