<?php
    // include_once 'dbconfig.php';

    $con=mysqli_connect("localhost","root","","symposium");
    // Check connection
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

?>



<?php

        session_start();

        if (isset($_FILES['userfile']))  {

            // Print the selected file
            // pre_r($_FILES);

            // File information
            $file_name = $_FILES['userfile']['name'];
            $file_path = $_FILES['userfile']['tmp_name'];
            $file_size = $_FILES['userfile']['size'];
            $new_size = $file_size / 1024; // size in KB
            $file_type = $_FILES['userfile']['type'];
            $file_error = $_FILES['userfile']['error'];
            $folder="files/";

            // $supervisor_id = $_POST['supervisor'];


            // PHP upload file errors
            $phpFileUploadErrors = array(
                0 => 'There is no error, file uploaded successfully',
                1 => 'The upload file size exceeds the upload_max_file_size directive in php.ini',
                2 => 'The upload file size exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
                3 => 'The upload file was only partialy uploaded',
                4 => 'No file was uploaded',
                6 => 'Missing a temporary folder',
                7 => 'Failed to write the file to the disk',
                8 => 'A PHP extension stopped the file upload'
            );

            $ext_error = false;

            // These are the allowed files extensions to be uploaded
            $extensions = array('pdf', 'docx');

            // Divide the file name([name] => Java Tutorial.docx) into name and extension 
            $file_ext = explode('.', $file_name);

            // Get only the extension from the $file_ext (always file extension is the last item of the array)
            $file_ext = end($file_ext);

            // Uploaded file extension is not allowed
            if (!in_array($file_ext, $extensions)) {
                $ext_error = true;
            }

            // If the error of the upload file is not 0 (There is an error in the upload file)
            if ($file_error) {
                echo $phpFileUploadErrors[$_FILES['userfile']['error']];
            } else if ($ext_error) { // We have extensions errors
                echo 'Invalid file extension!';
            } else { // Success
                // Move the upladed file from the temory location to a new custom location
                if(move_uploaded_file($file_path, $folder.$file_name)) {


                    
                    $student_id =  $_SESSION['id'];

     
                    $sql="INSERT INTO File(name,size,type,status_id,student_id,supervisor_id,faculty_id) VALUES('$file_name','$new_size','$file_type','0','$student_id','5','1')";

                    
                    mysqli_query($con,$sql) or die("Can not insert files".mysqli_error($con));
                    
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
        }

    function pre_r($array) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

?>



<html>
    <head>
        <title>File Upload</title> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sign Up Form by Colorlib</title>

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
                    <form action="" method="POST" enctype="multipart/form-data" id="signup-form" class="signup-form">
                        <h2 class="form-title">Upload File</h2>
                        <div class="form-group">
                            <input type="file" name="userfile" class="form-control-file" id="email"/>
                        </div>
                        <div class="form-group">
                            <select name="supervisor">
                            <?php
                                $sql="SELECT * FROM Supervisor";
                                $result_set=mysqli_query($con,$sql) or die("Can not read files".mysqli_error($con));
                                while($row=mysqli_fetch_array($result_set,MYSQLI_ASSOC)) {
                            ?>
                        
                                <option value="<?php $row['s_id'] ?>"><?php echo $row['f_name']." ".$row['l_name']; ?></option>
                                
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="UPLOAD"/>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>


    
    </body>
</html>