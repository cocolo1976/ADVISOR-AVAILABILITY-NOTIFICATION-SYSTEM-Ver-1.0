<?php

/* 
 * Returns 1 or 0 if front desks is sending a student
 */
 session_start();
 
 require 'sqliConnect.php';

 $name = $_SESSION['id'];

 $con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"login_details");
$sql="SELECT `student_sent` FROM `login_details` WHERE id='$name'";
$result = mysqli_query($con,$sql);

$row = mysqli_fetch_array($result);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
//stores a 0 or a 1
$reslt = $row['student_sent'];





echo $reslt;

 

