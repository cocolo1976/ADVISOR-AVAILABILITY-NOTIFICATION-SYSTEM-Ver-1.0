<html>
    <head>
    <style>
.inline {
    display:inline-block;
   margin-right:5px;
}


</style>
 </head>
<body>
    
    <?php
    require 'sqliConnect.php';
$con = get_sqli();

session_start();
    if(isset($_SESSION['id']))
{
      
    echo '<h1><center>Change Password</center><h1>';
echo "<form action='#' method='post'>";
echo "<table cellspacing='5' align='center'>";
echo "<tr><td>New Password:</td><td><input type='password' name='pwd'/></td></tr>";
echo "<tr><td>Retype New Password:</td><td><input type='password' name='pwd2'/></td></tr>";
echo "<tr><td></td><td><input type='submit' class='inline' name='submit' value='Submit'/></td></tr>";
echo "<tr><td></td><td><input type='submit' class='inline' name='cancel' value='Cancel'/></td></tr>";
echo "</table>";


   
//this page is called when advisors want to change their password
//it performs a simple password change for the advisor that was called.
//based on the password inputted

 $name= $_SESSION['id'];
    echo "<center>Password Change for:  $name </center>";
//if submit is pressed
 if(isset($_POST['submit']))
 {
     //check is pwd is submitted or if 
    if ($_POST['pwd']!=''&&$_POST['pwd']==$_POST['pwd2'])
    {
 
 $pw = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
 

if(!$con) {
die('Connection failed ');
}
mysqli_select_db($con,"login");
$sql = "UPDATE `login_details` SET `password` = '$pw' WHERE `login_details`.`id` = '$name';  ";

    $query = mysqli_query($con, $sql);
    if($query)

{
    echo "Success!";
}

else{
    // echo "Error";
    die('There was an error running the query [' . $conn->error . ']');
}
  header("Location:advisor.php");
}else
{
    echo '<center>No Password entered or they do not match.</center>';
}
 }
// if cancel is pressed
if(isset($_POST['cancel']))
{
   header("Location:advisor.php"); 
}
}
else
{
    echo 'Adivsor not logged in ';
}

?>
    
  
</body>  
</html>