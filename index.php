<html>
<head>
<style type="text/css">
 input{
 border:1px solid red;
 border-radius:5px;
 }
 h1{
  color:darkblue;
  font-size:22px;
  text-align:center;
 }
 h2{
  color:darkblue;
  font-size:22px;
  text-align:center;
 }
</style>
</head>
<body>
    <h1> <br>Advisor Availability System<br/><h1>
<h2>Login</h2>
<form action='#' method='post'>
<table cellspacing='5' align='center'>
<tr><td>Username:</td><td><input type='text' name='name'/></td></tr>
<tr><td>Password:</td><td><input type='password' name='pwd'/></td></tr>
<tr><td></td><td><input type='submit' name='submit' value='Submit'/></td></tr>
</table>

</form>
<?php
session_start();
include 'lib/password.php';

if(isset($_POST['submit']))
{
    //connect to the db
   include 'sqliConnect.php';
   $con = get_sqli();
mysqli_select_db($con,"login");
 
 $name=$_POST['name'];
 $pwd=$_POST['pwd'];
 
 
  

 //if a name and password were inputted do the followin
 if($name!=''&&$pwd!='')
 {
      //check to see if the name and pasword match the database with lvl 0 clearance
     $sql="select password from login_details where id='".$name."' and level = 0";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
 $hashedpPw =$row['password'];
   

   //if yes proceed to the advisor page 
   if(password_verify($pwd, $hashedpPw))
   {


//update session values
    $_SESSION['id']="$name";
    $_SESSION['access_level']= 0 ;
    header("Location:advisor.php");
    
    //check to see if the name and pasword match the database with lvl 1 clearance
   }else
{

    $sql="select password from login_details where id='".$name."' and level = 1";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
 $hashedpPw =$row['password'];
   

   //if yes proceed to the advisor page 
   if(password_verify($pwd, $hashedpPw))

   {
//update session values
    $_SESSION['id']="$name";
   $_SESSION['access_level']= 1 ;
     header("Location:admin.php");
   }
   //check to see if the name and pasword match the database with lvl 2 clearance
   else
   {
  $sql="select password from login_details where id='".$name."' and level = 2";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
 $hashedpPw =$row['password'];
   

   //if yes proceed to the advisor page 
   if(password_verify($pwd, $hashedpPw))
      {

	      $_SESSION['id']="$name";
	     $_SESSION['access_level']= 2 ;
     header("Location:desk.php");
   }else
   {
       $sql="select password from login_details where id='".$name."' and level = 3";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
 $hashedpPw =$row['password'];
  if(password_verify($pwd, $hashedpPw))
      {

	      $_SESSION['id']="$name";
	     $_SESSION['access_level']= 3 ;
     header("Location:display.php");
   }else
   {
 $sql="select password from login_details where id='".$name."' and level = 4";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
 $hashedpPw =$row['password'];
  if(password_verify($pwd, $hashedpPw))
      {

	      $_SESSION['id']="$name";
	     $_SESSION['access_level']= 4 ;
     header("Location:StudentSignIn.php");
   }else
   {
   
         
         echo'<center>You entered an incorrect username or password</center>';
   }
   }
   
   }
   }
   }

 }
 else
 {
  echo'Enter username and password';
 }
}
?>
</body>
</html>