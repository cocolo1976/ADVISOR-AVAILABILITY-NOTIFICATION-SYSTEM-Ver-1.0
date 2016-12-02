<?php

/* 
 * When called sets the status of the advisor to busy
 */

session_start();
require 'sqliConnect.php';

 $name = $_SESSION['id'];

 $con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
   mysqli_select_db($con,"login_details");
$sql="UPDATE login_details SET Status = 'Busy' WHERE id = '$name';";
$result = mysqli_query($con,$sql);

mysqli_close($con);

