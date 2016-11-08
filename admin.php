

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
session_start();
$id = $_SESSION["access_level"];

if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==1)
    
    {
    // Display a table of all advisors( to teremine if a user was succesfully added or removed
    
    
    
	if(isset($_POST['formSubmit'])) 
        {
            $name=$_POST['name'];
            $pwd=$_POST['pwd'];
            $firstname = $_POST['FirstName'];
             $lastname = $_POST['LastName'];
            if($name!=''&&$pwd!='')
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
				case "Remove": removeUser($name,$pwd);break;
				case "Add": addUser($name,$pwd,$firstname,$lastname); break;
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
 
 
 //Display  registerd advisors
 require 'fetchAdminTable.php';
 /////////////////////////////////
 
 
 echo "<br>Enter the Details of the account you want to manipulate.";
 echo"<br>To remove only enter the id and password."; 
 
 
}
else{
 header("Location:index.php?err=2");
 }
	
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <tr><td>User id:</td><td><input type='text' name='name'/></td></tr<br>
    <br><br> <tr><td>Password:</td><td><input type='text' name='pwd'/></td></tr> <br>
    <br><br> <tr><td>First Name</td><td><input type='text' name='FirstName'/></td></tr> <br>
     <br><br> <tr><td>Last Name</td><td><input type='text' name='LastName'/></td></tr> <br>
    <label for='formStatus'>Add or Remove Account</label><br>
	<select name="formStatus">
		<option value="">Select a Status</option>
		<option value="Remove">Remove</option>
		<option value="Add">Add</option>
         </select> 
   

	<input type="submit" name="formSubmit" value="Submit" />

    <?php
//sets the status to the parameter given
function addUser( $name,$pwd,$firstname,$lastname)
{
    session_start();
   
    
    require("db.php");
    $db =get_db();
    $nm = $name;
    $pw = $pwd;
    $fn =$firstname;
    $ln =$lastname;       
    $sql = "INSERT INTO login_details (id, FirstName,Lastname, password, level, logged, Status) VALUES ('".$nm."','$firstname','$lastname','".$pw."','0','0','')";
 $db->query($sql);
    
   
}

function removeUser($name,$pwd)
{
    session_start();
    $nm = $name;
    $pw = $pwd;
 //the two requires offer the same function jsut different methods.
    require("db.php");
    require ("sqliConnect.php");
    $con2 = get_sqli();
    
    if (!$con2) {
    die('Could not connect: ' . mysqli_error($con));
}
//selects all advisor 
//SELECT * FROM `login_details` ORDER BY `login_details`.`lastupdate` ASC 
mysqli_select_db($con,"login");
$sql=" SELECT password FROM login_details where level =0 AND id ='$name' ORDER BY `login_details`.`lastupdate` DESC";
$result = mysqli_query($con2,$sql);

$row  = mysqli_fetch_array($result);
    
    
    
    $respw = $row['password'];
    
    if($respw==$pw)
    {
    $db =get_db();
    $nm = $name;
    $pw = $pwd;
    $fn =$firstname;
    $ln =$lastname;       
    $sql = "DELETE FROM login_details WHERE id='".$nm."'  ";
 $db->query($sql);
    }
    
    }
    



?>
    
    

</body>
</html>
