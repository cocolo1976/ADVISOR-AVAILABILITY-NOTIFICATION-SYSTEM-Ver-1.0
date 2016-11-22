 <html>
<head>
    <!--SOUNd FILE loaded into the page to be played later--->
    <audio id="sound" src="nice-cut.mp3" preload="auto"></audio> 
<?php

session_start();
//calls the sqliConnect to be used here
require_once 'sqliConnect.php';
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==2)
    {

//upade the database to show that the user is logged in.
$name =$name = $_SESSION['id'];

  $con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}



//set desk to logged in
mysqli_select_db($con,"login_details");
$sql="UPDATE  login_details SET logged='1' WHERE id='$name'";
$result = mysqli_query($con,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

//display welcome message and logout link
 echo "Welcome to the front desk"."<br/><a href='logout.php'>Logout</a>";
 
 }
else
    {
      header("Location:index.php?err=2");
    }
?>
   
 <?php
 //displays the table for walk_ins a
 echo ' <br/><br/>When an advisor logs in refresh the page to reload other tables.';
  echo ' <br/><br/>  Walk-In Queue:';
  include 'walk_inHandle.php';
  //displays the table for appointments
  echo 'Appointment Queue:';
  include 'apointment_handle.php';
 ?>
    
    
    
<script>
    //refresh the show advisors function
   myVar = setInterval(showUsers, 1000);
   
   //function to call the fetchTable.php page
function showUsers() {
    
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","fetchTable.php?",true);
        xmlhttp.send();
    
}

</script>


<script>
    //loadXMLdoc and loadXMldoc2 are both used to determine if a table gets updated and makes a sound.
    vars =setTimeout(loadXMLDoc,100);
  //function used to load the initial time stamp of the table  
function loadXMLDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     
      $v = this.responseText;
    
    }
  };
  xhttp.open("GET", "queryDB.php", true);
  xhttp.send();
}


//repeat the time stamp request to determin if the database updated


     myVar = setInterval(loadXMLDoc2, 3000); 


 //function used to keep checking if the table has changed.   
function loadXMLDoc2() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     
      $f = this.responseText;
      if ($f!=$v)
      {
          $v =$f;
         document.getElementById('sound').play();  
      }
    }
  };
  xhttp.open("GET", "queryDB.php", true);
  xhttp.send();
}



</script>


 
<br>
<!--Display the table here    -->
<?php
echo 'Advisor Status Table:';

?>
<div   id="txtHint"><b>Status Will be displayed here.</b></div>
<?php
echo 'Statuses:<br />';
echo  'Busy: With Student<br />';
echo  'RFA: Ready For Appointment<br />';
echo  'RFW: Ready For Walk-in<br />';
echo  "UA: Unavailable<br />";
echo  'OO: Out of Office<br />';
?>
</html>






