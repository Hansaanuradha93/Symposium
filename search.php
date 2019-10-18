<?php
    // include_once 'dbconfig.php';

    $con=mysqli_connect("localhost","root","","symposium");
    // Check connection
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
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

<html>
    <head>
        <title>Search Results</title> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="style.css" type="text/css" /><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <a class="navbar-brand" href="home.php">Symposium</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                
                <?php

                if(isset($_SESSION['id'])) {
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
                } else {
                    ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
                        </li>
                    <?php
                }

                
            ?>
            
                </ul>
            </div>
        </nav>

        
        
    
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    
    

    <div id="body" class="container-fluid">

        <div id="header">
        <h1 class="display-4">Search Results</h1>

        </div>

        <form action="" method="POST">
                <table class="table table-striped text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
                        <th scope="col">Faculty</th>
                        <th scope="col">Supervisor</th>
                        <th scope="col">Download</th>
                    </tr>

                </thead>
 
                <?php

                    if(isset($_GET['search'])) {

                        $keywords = $con->escape_string($_GET['search']);

                        $query = $con->query("select f.f_id as file_id,f.name as file_name, f.title as file_title, f.category as file_category, s.name as status_name, st.f_name as first_name, st.l_name as last_name, fc.name as faculty_name, sp.f_name as supervisor_first_name, sp.l_name as supervisor_last_name FROM File f
                        Join Status s ON s.s_id = f.status_id
                        JOIN Student st ON f.student_id = st.s_id
                        JOIN Faculty fc ON fc.f_id = f.faculty_id
                        JOIN Supervisor sp ON sp.s_id = f.supervisor_id
                        WHERE f.status_id='1' AND (
                        f.name LIKE '%{$keywords}%'
                        OR f.title LIKE '%{$keywords}%'
                        OR f.category LIKE '%{$keywords}%')");


                        if($query->num_rows) {
                            while($row = $query->fetch_object()) {
                                ?>
                                    <tr>
                                    <th scope="row"><?php echo$row->file_title; ?></th>
                                    <td><?php echo$row->file_category; ?></td>
                                    <td><?php echo $row->first_name." ".$row->last_name ?></td>
                                    <td><?php echo$row->faculty_name; ?></td>
                                    <td><?php echo $row->supervisor_first_name. $row->supervisor_last_name ?></td>
                                    <td><input type="checkbox" value="<?php  echo$row->file_name ?>" name="download_list[]" /></td>

                                    </tr>

                                <?php
                            }
                        }

                    }
                ?>

                </table>

            <div class="form-group">
                    <input type="submit" name="download" id="submit" class="btn btn-secondary btn-lg" value="Download"/>
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

