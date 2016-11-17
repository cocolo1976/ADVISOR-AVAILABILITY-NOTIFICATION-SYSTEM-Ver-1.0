<?php
session_start();
require 'sqliConnect.php';

 $name = $_SESSION['id'];

 $con = get_sqli();
 
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
   mysqli_select_db($con,"login_details");
$sql="SELECT * FROM `login_details` WHERE `login_details`.`id` = '$name';";
$result = mysqli_query($con,$sql);

 $row = mysqli_fetch_array($result); 
 
 $reslt= $row['student_name'];
 echo $reslt;

mysqli_close($con);




