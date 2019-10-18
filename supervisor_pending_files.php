<?php
    // include_once 'dbconfig.php';

    $con=mysqli_connect("localhost","root","","symposium");
    // Check connection
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>

<?php

    if(isset($_POST['update'])) {
        if (isset($_POST['update_list'])) {
            foreach($_POST['update_list'] as $checkU) {
                //UPDATE only the values checked
                $sql = "UPDATE File 
                SET status_id='1' 
                WHERE f_id = '$checkU';";
        
                if ($con->query($sql) === TRUE) {
                    // echo "Record updated successfully";

                    ?>

                    <script>
                        alert('Record updated successfully');
                    </script>
                    <?php
                } else {
                    // echo "Error updating record: " . $con->error;
                    ?>
                    <script>
                        alert('Record not updated!');
                    </script>
                    <?php
                }
        
                
            }
        }
    }
    
    
?>

<?php
    if(isset($_POST['download'])) {
        if(isset($_POST['download_list'])) {
            foreach($_POST['download_list'] as $item) {
                // Lets download the files
                $file_name = $item;

                $file = ("files/$file_name");

                $file_type = filetype($file);

                $file_base_name = basename($file);

                echo $file_name.'<br>'.$file.'<br>'.$file_type.'<br>'.$file_base_name;

                header ("Content-Type: application/pdf");

                header ("Content-Length: ".filesize($file));

                header ("Content-Disposition: attachment; filename=".$file_base_name);

                readfile($file);
            }
        }
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Pending Files</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

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

    <form action="" method="POST">
        <table class="table table-striped text-center">

        <thead class="thead-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Faculty</th>
                        <th scope="col">Supervisor</th>
                        <th scope="col">View</th>
                        <th scope="col">Update</th>
                        <th scope="col">Download</th>

                    </tr>
        </thead>



            </thead>
            <?php

                // session_start();
                $supervisor_id = $_SESSION['id'];

                $sql="select f.f_id as file_id,f.name as file_name, f.title as file_title, f.category as file_category, s.name as status_name, st.f_name as first_name, st.l_name as last_name, fc.name as faculty_name, sp.f_name as supervisor_first_name, sp.l_name as supervisor_last_name FROM File f
                Join Status s ON s.s_id = f.status_id
                JOIN Student st ON f.student_id = st.s_id
                JOIN Faculty fc ON fc.f_id = f.faculty_id
                JOIN Supervisor sp ON sp.s_id = f.supervisor_id
                WHERE f.supervisor_id = '$supervisor_id' AND f.status_id='0'";
                $result_set=mysqli_query($con,$sql) or die("Can not read files".mysqli_error($con));


                // select File.name, File.title, File.category, Status.name
                // from File
                // Join Status ON Status.s_id = File.status_id;
                while($row=mysqli_fetch_array($result_set,MYSQLI_ASSOC))
                {
            ?>
                <tr>
                <td><?php echo $row['file_title'] ?></td>
                <td><?php echo $row['file_category'] ?></td>
                <td><?php echo $row['status_name'] ?></td>
                <td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
                <td><?php echo $row['faculty_name'] ?></td>
                <td><?php echo $row['supervisor_first_name']." ". $row['supervisor_last_name']?></td>
                <td><a href="files/<?php echo $row['file_name'] ?>" target="_blank">View file</a></td>
                <td><input type="checkbox" value="<?php echo $row['file_id'] ?>" name="update_list[]" /></td>
                <td><input type="checkbox" value="<?php echo $row['file_name'] ?>" name="download_list[]" /></td>

                </tr>
                <?php
                }
            ?>
            </table>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary btn-lg" name="update" id="submit" class="form-submit" value="Update"/>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-secondary btn-lg" name="download" id="submit" class="form-submit" value="Download"/>
            </div>
        </form>
    </div>
    
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom">
      <div class="container text-center">
        <small>Copyright &copy; Your Website</small>
      </div>
    </footer>
</body>
</html>

<?php
    $con->close();
?>