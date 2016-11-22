

<?php
//returns  a time stamp from the msgs database.
session_start();

require 'sqliConnect.php';

$con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"login_details");
$sql="SELECT ts_update FROM msgs where id =1";
$result = mysqli_query($con,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
 
$row = mysqli_fetch_array($result);

 
echo  $row['ts_update'];
