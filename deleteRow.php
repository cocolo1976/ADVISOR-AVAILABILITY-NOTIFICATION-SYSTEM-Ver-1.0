<?php
// deletes a given row from a given table
include('sqliConnect.php');


if(isset($_GET['table'])&&isset($_GET['id']))
{
    //id of table item to delete
$id = $_GET['id'];
//name of the table to delete it from
$table = $_GET['table'];
  
  $con = get_sqli();
     
 if (!$con) {
 die('Could not connect: ' . mysqli_error($con));
}



mysqli_select_db($con,"login");
$sql="DELETE FROM $table WHERE id=$id";
$result = mysqli_query($con,$sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}




header("Location: desk.php");  

}
else
{
 header("Location: desk.php");   
}