<?php

/*

Removes a student from the qeueue and alerts the advisor
*/



// connect to the database

include('sqliConnect.php');
//$form =  $_GET['id2'];
echo $_POST['formSubmit'];

//echo $_GET['id2'];

if (($_POST['formSubmit']!=NULL))
{
    //the id of the walkk in bieng removed form the queue and snet to advisor
    $walkID = $_GET['id'];
    //$walkID =$_POST['formSubmit'];
   echo $walkID;
    //code to prevent adivsor from getting astudent if the status is not correct
    //Id of the advisor selected to receive the student
    $advisorID = filter_input(INPUT_POST, "formStatus");
    // $advisorID = $_POST['formStatus'];
     
    echo $advisorID;
     
     $con = get_sqli();
     mysqli_select_db($con,"login");
$sql="SELECT * FROM `login_details` WHERE id = '$advisorID'";
$result3 = mysqli_query($con,$sql);

if (!$result3) {
    printf("Error: %s\n", mysqli_error($con));
    printf("result not working");
    exit();
}
  $row3 = mysqli_fetch_array($result3);
 
  $status3 =  $row3['Status'];
  echo $status3; 
   
   mysqli_close($con);
   
    //if ADVISOR IS READY FOR APOITMENT CONTINUE IF NOT DO RETuRN TO DESK PAGE
    if($status3 =='RFA'|| $status3 =='RFW')
    {
   
    $con = get_sqli();
    //get the id
    //
   // $advisor = $_GET['advisor'];
    


// get results from database

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
//execute delete query
mysqli_select_db($con,"login");
$sql="DELETE FROM walk_in WHERE id=$walkID";
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
$result4 = mysqli_query($con,$sql);

//echo $advisor;
mysqli_close($con);
        
 
    } 
    
        
    
  //redirect back  
header("Location: desk.php");
    

}

else

// if id isn't set, or isn't valid, redirect back to view page

{

header("Location: desk.php");

}



