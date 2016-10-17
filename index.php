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
</style>
</head>
<body>
<h1>Login<h1>
<form action='#' method='post'>
<table cellspacing='5' align='center'>
<tr><td>User name:</td><td><input type='text' name='name'/></td></tr>
<tr><td>Password:</td><td><input type='password' name='pwd'/></td></tr>
<tr><td></td><td><input type='submit' name='submit' value='Submit'/></td></tr>
</table>

</form>
<?php
session_start();


if(isset($_POST['submit']))
{
//connect to the db
 mysql_connect('localhost','root','') or die(mysql_error());
 mysql_select_db('login') or die(mysql_error());
 $name=$_POST['name'];
 $pwd=$_POST['pwd'];

 //if a name and password were inputted do the followin
 if($name!=''&&$pwd!='')
 {
 //check to see if the name and pasword match the database with lvl 0 clearance
   $query=mysql_query("select * from login_details where id='".$name."' and password='".$pwd."'and level = 0") or die(mysql_error());
   $res=mysql_fetch_row($query);

   //if yes proceed to the advisor page 
   if($res)
   {


//update session values
    $_SESSION['id']="$name";
    $_SESSION['access_level']= 0 ;
    header("Location:advisor.php");
    
    //check to see if the name and pasword match the database with lvl 1 clearance
   }else
{

   $query=mysql_query("select * from login_details where id='".$name."' and password='".$pwd."'and level = 1") or die(mysql_error());
      $res=mysql_fetch_row($query);

      //if yes proceed to admin page
   if($res)

   {
//update session values
    $_SESSION['id']="$name";
   $_SESSION['access_level']= 1 ;
     header("Location:admin.php");
   }
   //check to see if the name and pasword match the database with lvl 2 clearance
   else
   {

   $query=mysql_query("select * from login_details where id='".$name."' and password='".$pwd."'and level = 2") or die(mysql_error());
      $res=mysql_fetch_row($query);

 // if yes proceed to the front desk page
    if($res)
      {

	      $_SESSION['id']="$name";
	     $_SESSION['access_level']= 2 ;
     header("Location:desk.php");
   }else
   {

   if(!$res)
         {
         echo'You entered an incorrect username or password';
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