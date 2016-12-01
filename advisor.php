<html>
<head>
    
	<title>Advisor Status Change Page</title>
<!-- define some style elements-->

    <style type="text/css">

 h1{
  color:darkblue;
  font-size:22px;
  text-align:center;
 }



  

label,a 
{
	font-family : Arial, Helvetica, sans-serif;
	font-size : 12px; 
}

</style>


</head>

<body>
    <h1> <br>Advisor Availability System<br/></h1>
    
    <audio id="sound" src="nice-cut.mp3" preload="auto"></audio>
<?php
	if(isset($_POST['formSubmit'])) 
	{
		$varCountry = $_POST['formStatus'];
		$errorMessage = "";
		
		if(empty($varCountry)) 
		{
			$errorMessage = "<li>You forgot to select a Status!</li>";
		}
		
		if($errorMessage != "") 
		{
			echo("<p>There was an error with your Selection:</p>\n");
			echo("<ul>" . $errorMessage . "</ul>\n");
		} 
		else 
		{
			// note that both methods can't be demonstrated at the same time
			// comment out the method you don't want to demonstrate

			// method 1: switch
			$redir = "advisor.php";
			switch($varCountry)
			{
				case "RFA": setStatus('RFA'); break;
                                case "RFW": setStatus('RFW'); break;
                                case "OO": setStatus('OO'); break;
                                case "UA": setStatus('UA'); break;
				case "Busy": setStatus('Busy'); break;
				default: echo("Error!"); exit(); break;
			}
			echo " redirecting to: $redir ";
			
			 header("Location: $redir");
			// end method 1
			
			// method 2: dynamic redirect
			//header("Location: " . $varCountry . ".html");
			// end method 2

			exit();
		}
	}
?>




<?php
session_start();
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==0)
    
    {
//database connection class
require 'sqliConnect.php';;
$name = $_SESSION['id'];

$con = get_sqli();

//upade the database to show that the user is logged in.
$sql="UPDATE  login_details SET logged='1' WHERE id='$name'";
$result = mysqli_query($con,$sql);

 
 
 
 // display a message and logout link
 echo " <center><br>Hello $name, this is your status page.<br/><a href='logout.php'>Logout</a>";
 //displays a change pw link 
 echo "<br/><a href='changeAdvisorPw.php'>Change Password</a>";
 echo '<br/><font color ="red">Remember to Change your Status when you finish with a student:</center></font.';

 //display status of advisor
 include 'advisorTable.php';
 

}
else{
 header("Location:index.php?err=2");
 }
?>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<label for='formStatus'></label>
	<br><center><select name="formStatus">
		<option value="">Select a Status</option>
                <option value="Busy">Busy:With Student</option>
                <option value="RFA">RFA:Ready For Next App.</option>
                <option value="RFW">RFW:Ready For Next Walk-In</option>
                <option value="OO">OO:Out of Office</option>
                <option value="UA">UA:Unavailable</option>
		
            </select> </center></br>
            <center><input type="submit" name="formSubmit" value="Submit" /></center>

            <br/><center><font color ="red" size ="12">Remember to Logout Before Closing the Browser</font></center>
<?php
//sets the status to the parameter given
function setStatus( $status)
{
    session_start();
    require("sqliConnect.php");
    
    $con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
    
    mysqli_select_db($con,"login_details");
    $name = $_SESSION['id'];
    $st = $status;
    $sql = "UPDATE  login_details SET Status= '$st' WHERE id='$name'";
$result = mysqli_query($con,$sql);



  //if the status is ready, force the table to update to signal front desk of a log in   
 If ($status=="RFA"||$status=="RFW")
 {
 $con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"msgs");
$sql="UPDATE  msgs SET msg= 'change' WHERE id='1'";
$result = mysqli_query($con,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

$con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"msgs");
$sql="UPDATE  msgs SET msg= '$st' WHERE id='1'";
$result = mysqli_query($con,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}



 }
    
}

 


?>
        


<script>
       
     myVar = setInterval(loadXMLDoc2, 5000); 
 
var inFormOrLink;
$('a').on('click', function() { inFormOrLink = true; });
$('form').on('submit', function() { inFormOrLink = true; });

$(window).on("beforeunload", function() { 
    return inFormOrLink ? "Do you really want to close?" : null; 
})
 //function used to keep checking if the table has changed. 
 //if student logged is 1 then a function is called to set it to 0
function loadXMLDoc2() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     
      $f = this.responseText;
      if ($f!=0)
      {
          setToZero();
         fetchStudntNme ();
         document.getElementById('sound').play(); 
         
        
      }
    }
  };
  xhttp.open("GET", "checkStudent.php", true);
  xhttp.send();
  

}
//set student sent to 0 in database to prevent the alert ot be called on loop
function setToZero()
{
     var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     
      $f = this.responseText;
      if ($f!=0)
      {
          setToZero();
         fetchStudntNme ();
         document.getElementById('sound').play(); 
         
        
      }
    }
  };
  xhttp.open("GET", "setSendStudento0.php", true);
  xhttp.send();
  
    
}

//fietch the student being sent and display an alert
function fetchStudntNme ()
{
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     
      name = this.responseText;
        alert( "Student " + name + " on the way." );
        setToBusy();
     
    }
  };
  xhttp.open("GET", "getStudentName.php", true);
  xhttp.send();
}
//set the status of the advisor to busy
function setToBusy()
{
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) 
    {
        //reload the page to display the new status
     location.reload(true);
     
        
    }
  };
  xhttp.open("GET", "setToBusy.php", true);
  xhttp.send();
}


        </script>

</form>

</body>
</html>
