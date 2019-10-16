<?php
    // include_once 'dbconfig.php';

    $con=mysqli_connect("localhost","root","","symposium");
    // Check connection
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>

<?php

    foreach($_POST['check_menus'] as $checkU) {
        //UPDATE only the values checked
        $sql = "UPDATE File 
        SET status_id='1' 
        WHERE f_id = '$checkU';";

        if ($con->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $con->error;
        }

        
    }
    
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>File Uploading With PHP and MySql</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="header">
<label>Pending Reseach Papers</label>
</div>
<div id="body">

<form action="" method="POST">
    <table width="80%" border="1">
        <tr>
        <th colspan="9">Pending Research Papers</th>
        </tr>
        <tr>
        <td>Title</td>
        <td>Category</td>
        <td>Status</td>
        <td>Student Name</td>
        <td>Faculty</td>
        <td>Supervisor</td>
        <td>View</td>
        <td>Download</td>
        <td>Update</td>


        </tr>
        <?php

            session_start();
            $supervisor_id = $_SESSION['id'];

            $sql="select f.f_id as file_id,f.name as file_name, f.title as file_title, f.category as file_category, s.name as status_name, st.f_name as first_name, st.l_name as last_name, fc.name as faculty_name, sp.f_name as supervisor_first_name, sp.l_name as supervisor_last_name FROM File f
            Join Status s ON s.s_id = f.status_id
            JOIN Student st ON f.student_id = st.s_id
            JOIN Faculty fc ON fc.f_id = f.faculty_id
            JOIN Supervisor sp ON sp.s_id = f.supervisor_id
            WHERE f.supervisor_id = '1' AND f.status_id='0'";
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
            <td><a href="files/<?php echo $row['file_name'] ?>" target="_blank">Download file</a></td>
            <td><input type="checkbox" value="<?php echo $row['file_id'] ?>" name="check_menus[]" /></td>

            </tr>
            <?php
            }
        ?>
        </table>
        <div class="form-group">
            <input type="submit" name="submit" id="submit" class="form-submit" value="Update"/>
        </div>
    </form>
</div>
</body>
</html>

<?php
    $con->close();
?>