<?php

/*

Removes a student from the qeueue and alerts the advisor
*/



// connect to the database

include('sqliConnect.php');
if (isset($_GET['id']) && is_numeric($_GET['id'])&&($_POST['formSubmit']))
{
    //( need to implement this )checking if advisor stastus is FRW  or FRA if not qeueu table wil net remove the student
    //$con = get_sqli();
    //$id = $_GET['id'];
   // $advisor =  $_POST['formStatus'];
    
    if(true)
    {
    
    $con = get_sqli();
    //get the id
    //
   // $advisor = $_GET['advisor'];
$id = $_GET['id'];
// get results from database

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
//execute delete query
mysqli_select_db($con,"login");
$sql="DELETE FROM walk_in WHERE id=$id";
$result = mysqli_query($con,$sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
//gets the adviser from the drop down list and uses it to say a student is on the way

	
    $advisor =  $_POST['formStatus'];
//execute delete query
mysqli_select_db($con,"login");
$sql="UPDATE `login_details` SET `student_sent` = '1' WHERE `login_details`.`id` = '$advisor'";
$result = mysqli_query($con,$sql);

//echo $advisor;

        
// redirect back 
    }
header("Location: desk.php");
    

}

else

// if id isn't set, or isn't valid, redirect back to view page

{

header("Location: desk.php");

}



?>