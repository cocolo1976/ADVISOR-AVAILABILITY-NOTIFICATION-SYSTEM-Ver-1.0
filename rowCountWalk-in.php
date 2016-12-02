<?php

/* 
 *Returns the number of rows from a specified table
 */
include 'sqliConnect.php';
$con = get_sqli();
if (!$con)
    {
     die('Could not connect: ' . mysqli_error($con));
    }
//select whole list of students from walk_in
mysqli_select_db($con,"login");
$sql= "SELECT COUNT(*) AS NumberOfrows FROM apointments";
$result = mysqli_query($con,$sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

$row = mysqli_fetch_array($result);
$output = $row['NumberOfrows'];


// get results from database

if (!$con)
    {
     die('Could not connect: ' . mysqli_error($con));
    }
//select whole list of students from walk_in
mysqli_select_db($con,"login");
$sql= "SELECT COUNT(*) AS NumberOfrows FROM walk_in";
$result = mysqli_query($con,$sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
mysqli_close($con);

$row = mysqli_fetch_array($result);
$output = $output + $row['NumberOfrows'];
echo $output;


