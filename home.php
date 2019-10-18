
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
  <head></head>
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link rel="stylesheet" href="css/home_style.css">

</head>
  <!-- Coded with love by Mutiullah Samim-->
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="home.php">Symposium</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        
        <?php
                session_start();

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

    <form action="search.php" method="GET">
      <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
          <div class="searchbar">
              <input class="search_input" type="text" name="search" placeholder="Search...">
              <!-- <a href="home.php" class="search_icon"><i class="fas fa-search"></i></a> -->
              <button class="btn btn-outline-warning btn-rounded btn-sm my-0 search_icon" type="submit"></button>

          </div>
        </div>
      </div>
    </form>



    
    <footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom">
      <div class="container text-center">
        <small>Copyright &copy; Your Website</small>
      </div>
    </footer>

  </body>
</html>