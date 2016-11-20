

<html>
<head>
    
	<title>Admin Page</title>
<!-- define some style elements-->
<style>
label,a 
{
	font-family : Arial, Helvetica, sans-serif;
	font-size : 12px; 
}

</style>	
</head>

<body>
<?php
//library used for pasword_hashing compatibility on php 5.3.7 and greater
require 'lib/password.php';

session_start();

$level = $_SESSION["access_level"];

if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==1)
    
    {
  
    
    
    
	if(isset($_POST['formSubmit'])) 
        {
            $name=$_POST['name'];
            
            $pwd=$_POST['pwd'];
            $firstname = $_POST['FirstName'];
             $lastname = $_POST['LastName'];
             $clearance =$_POST['clearance'];
            if($name!='')
 {
	
 
            
                $varSelection = $_POST['formStatus'];
		$errorMessage = "";
		
		if(empty($varSelection)) 
		{
			$errorMessage = "<li>You forgot to select add or remove!</li>";
		}
		
		if($errorMessage != "") 
		{
			echo("<p>There was an error with your Selection:</p>\n");
			echo("<ul>" . $errorMessage . "</ul>\n");
                        exit();
		} 
		else 
		{
			// note that both methods can't be demonstrated at the same time
			// comment out the method you don't want to demonstrate

			// method 1: switch
			$redir = "admin.php";
			switch($varSelection)
			{
				case "Remove": removeUser($name);break;
				case "Add": addUser($name,$pwd,$firstname,$lastname,$clearance); break;
                                case "changePw": changePw($name,$pwd);break;
				default: echo("Error!"); exit(); break;
			}
			echo " redirecting to: $redir ";
			
			 header("Location: $redir");
			// end method 1
			
			

			exit();
		}
        }
 }
 //database connection class
    require("db.php");
$name = $_SESSION['id'];

//upade the database to show that the user is logged in.
$db = get_db();
$sql = "UPDATE  login_details SET logged='1' WHERE id='$name'";
 $db->query($sql);
 

 echo "<br><br><br><br><br>Hello $name, This your admin page<br/><a href='logout.php'>Logout</a>";
 
 
 //Display  registerd advisers
 require 'fetchAdminTable.php';
 /////////////////////////////////
 
 
 echo "<br>Enter the Details of the account you want to manipulate.";
 echo"<br>To remove only enter the id."; 
  echo"<br>To change password enter Id and the new password in the password field."; 
 
}
else{
 header("Location:index.php?err=2");
 }
	
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <tr><td>User id:</td><td><input type='text' name='name'/></td></tr<br>
    <br><br> <tr><td>Password:</td><td><input type='password' name='pwd'/></td></tr> <br>
    <br><br> <tr><td>First Name</td><td><input type='text' name='FirstName'/></td></tr> <br>
     <br><br> <tr><td>Last Name</td><td><input type='text' name='LastName'/></td></tr> <br>
     
     <label for='clearance'>Select the type of account:</label><br>
	<select name="clearance">
		<option value="0">Advisor</option>
		<option value="1">Admin</option>
		<option value="2">Front Desk</option>
         </select> 
   
     
    <label for='formStatus'>Add, Remove or Change Password to the Account:</label><br>
	<select name="formStatus">
		<option value="">Select an Option</option>
		<option value="Remove">Remove</option>
		<option value="Add">Add</option>
                <option value="changePw">Change PW</option>
         </select> 
   

	<input type="submit" name="formSubmit" value="Submit" />

    <?php
//sets the status to the parameter given
function addUser( $name,$pwd,$firstname,$lastname,$clearance)
{
    //require 'lib/password.php';
    session_start();
     //hash the password for security reasons
     $pw = password_hash($pwd, PASSWORD_DEFAULT);
     $nm = $name;
    $fn =$firstname;
    $ln =$lastname;  
    $clnce =$clearance;
    //connect to the database
    if($fn!=''&&$ln!=''&&$pwd!='')
    {
    require ("sqliConnect.php");
    $con2 = get_sqli();
    
      if (!$con2) 
          {
    die('Could not connect: ' . mysqli_error($con2));
}
mysqli_select_db($con2,"login");
$sql="INSERT INTO login_details (id, FirstName,Lastname, password, level, logged, Status) VALUES ('".$nm."','$firstname','$lastname','".$pw."','.$clnce.','0','')";
$result = mysqli_query($con2,$sql);

$row  = mysqli_fetch_array($result);

    
 
  
   
    
    }
   
}

function removeUser($name)
{
    $adminId = $_SESSION['id'];
    if($adminId!=$name)
    {
    session_start();
    $nm = $name;
  
    require ("sqliConnect.php");
    $con2 = get_sqli();
    
    if (!$con2) {
    die('Could not connect: ' . mysqli_error($con2));
}
//remove an adviser

mysqli_select_db($con2,"login");
$sql="DELETE FROM login_details WHERE id='".$nm."'  ";
$result = mysqli_query($con2,$sql);

$row  = mysqli_fetch_array($result);
    }
 
    }
    
 function changePw($name,$pwd)       
{ 
    // require 'lib/password.php';
    session_start();
   
     $nm = $name;
     //add hash for pw
    $pw = password_hash($pwd, PASSWORD_DEFAULT);
  
    require ("sqliConnect.php");
    $con2 = get_sqli();
    
    if (!$con2) {
    die('Could not connect: ' . mysqli_error($con2));
}

//update pw
mysqli_select_db($con2,"login");
$sql="UPDATE `login_details` SET `password` = '$pw' WHERE `login_details`.`id` = '$nm';  ";
$result = mysqli_query($con2,$sql);


    }
 
    
    



?>
    
    

</body>
</html>
