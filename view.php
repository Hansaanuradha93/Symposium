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
<title>File Uploading With PHP and MySql</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="header">
<label>File Uploading With PHP and MySql</label>
</div>
<div id="body">
 <table width="80%" border="1">
    <tr>
    <th colspan="5">Research Papers</th>
    </tr>
    <tr>
    <td>File Name</td>
    <td>File Type</td>
    <td>File Size(KB)</td>
    <td>Status</td>
    <td>View File</td>
    </tr>
    <?php
        $sql="SELECT * FROM files";
        $result_set=mysqli_query($con,$sql) or die("Can not read files".mysqli_error($con));
        while($row=mysqli_fetch_array($result_set,MYSQLI_ASSOC))
        {
    ?>
        <tr>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['size'] ?></td>
        <td><?php echo $row['status'] ?></td>
        <td><a href="files/<?php echo $row['name'] ?>" target="_blank">view file</a></td>
        </tr>
        <?php
        }
    ?>
    </table>
    
</div>
</body>
</html>