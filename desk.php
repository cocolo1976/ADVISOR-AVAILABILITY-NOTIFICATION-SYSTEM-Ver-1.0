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
 echo "'Welcome to the front desk'"."<br/><a href='logout.php'>Logout</a>";
 
 }
else
    {
 header("Location:index.php?err=2");
 }
?>
    <?php
    //this is he code for the qeue

// connect to the database



$con = get_sqli();

// get results from database

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"login");
$sql="SELECT * FROM walk_in";
$result = mysqli_query($con,$sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

//Table to dispaly qeueu
echo "<table border='1' cellpadding='10'>";

echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th><th>Advisor Student wants to see</th><th>P ID</th><th>Select Advisor to notify on send</th><th>Send Student</th><th> </tr>";

echo "<tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['Advisor'] . "</td>";
    echo "<td>" . $row['pid'] . "</td>";
    
    // drop down menu for selecting advisor as a form submission
    
 echo "<td>" ;
 
echo '<form action="delete.php?id=' . $row['id'] . '" method="post">';
echo '<select name="formStatus">';
$con = get_sqli();
            mysqli_select_db($con,"login");
$sql="SELECT * FROM login_details WHERE level = 0";
$result2 = mysqli_query($con,$sql);

if (!$result2) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

            //loops through all advisors for drop down menu creation
               while ($row2 = mysqli_fetch_array($result2)) {
   echo '<option value="'.$row2['id'].'">'.$row2['id'].'</option>';
}
echo'<option selected="selected"></option>';

echo '</select>';

        
      
echo '<td><input type="submit" name="formSubmit" value= "Submit" /><td>';
//echo '<td><input type="submit" name="formSubmit" value=  /><td>';
   
//echo '<td><a href="delete.php?id=' . $row['id'] . '&advisor='. "lol" .'">Send</a></td>';

echo "</tr>";

}



// close table>

echo "</table>";

?>
    
<p><a href="new.php">Add a new record</a></p>
    
    
    
<script>
    //refresh the show users function
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
<div   id="txtHint"><b>Status Will be displayed here.</b></div>


</html>






