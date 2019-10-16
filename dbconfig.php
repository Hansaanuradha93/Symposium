?<php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "symposium";
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('cannot connect to the server', ); 
<!-- mysqli_select_db($dbname) or die('database selection problem'); -->
?>