<?php

/*

Removes a student from the qeueue and alerts the advisor
*/



// connect to the database

include('sqliConnect.php');
if (isset($_GET['id']) && is_numeric($_GET['id'])&&($_POST['formSubmit']))
{
    //code to prevent adivsor from getting astudent if the status is not correct
     $advisorID =  $_POST['formStatus'];
     //echo $advisorID;
     $con = get_sqli();
     mysqli_select_db($con,"login");
$sql="SELECT * FROM `login_details` WHERE id = '$advisorID'";
$result3 = mysqli_query($con,$sql);
//echo $result3;
if (!$result3) {
    printf("Error: %s\n", mysqli_error($con));
    printf("result not working");
    exit();
}
  $row3 = mysqli_fetch_array($result3);
 
  $status3 =  $row3['Status'];
   echo $status3; 
   
   
    //if ADVISOR IS READY FOR APOITMENT CONTINUE IF NOT DO RETuRN TO DESK PAGE
    if($status3 =='RFA'|| $status3 =='RFW')
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

	
    $advisorID =  $_POST['formStatus'];
//execute delete query
mysqli_select_db($con,"login");
$sql="UPDATE `login_details` SET `student_sent` = '1' WHERE `login_details`.`id` = '$advisorID'";
$result = mysqli_query($con,$sql);

//echo $advisor;

        
 
    } 
    
        
    
  //redirect back  
header("Location: desk.php");
    

}

else

// if id isn't set, or isn't valid, redirect back to view page

{

header("Location: desk.php");

}



