<?php

session_start();
if(isset($_SESSION["access_level"]))
    {
//database connection class
  require 'sqliConnect.php';
require("db.php");
//session id used to update database
$name = $_SESSION['id'];

$con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
 //upade the database to show that the user is logged out (logged = 0).
mysqli_select_db($con,"login");
$sql="UPDATE  login_details SET logged='0' WHERE id='$name'";
$result = mysqli_query($con,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}






//upade the database to show that the user is logged out (logged = 0).


 
 
 session_destroy();
header("Location:index.php?err=5");
 
}



?>