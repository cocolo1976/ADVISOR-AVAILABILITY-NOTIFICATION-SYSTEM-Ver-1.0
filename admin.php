

<html>
<head>
    
	<title>Advisor Status Change Page</title>
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

if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==1)
    
    {
	if(isset($_POST['formSubmit'])) 
        {
            $name=$_POST['name'];
            $pwd=$_POST['pwd'];
            if($name!=''&&$pwd!='')
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
			//$redir = "admin.php";
			switch($varCountry)
			{
				case "Remove": removeUser($name);break;
				case "Add": addUser($name,$pwd); break;
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
 }
 //database connection class
    require("db.php");
$name = $_SESSION['id'];

//upade the database to show that the user is logged in.
$db = get_db();
$sql = "UPDATE  login_details SET logged='1' WHERE id='$name'";
 $db->query($sql);
 

 echo "<br><br><br><br><br>Hello $name, This your admin page<br/><a href='logout.php'>Logout</a>";
 echo "<br>Enter the User ID  and password of the account you want to manipulate.";
 
 
}
else{
 header("Location:index.php?err=2");
 }
	
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <tr><td>User id:</td><td><input type='text' name='name'/></td></tr<br>
    <br><br> <tr><td>Password:</td><td><input type='text' name='pwd'/></td></tr> <br>	
    <label for='formStatus'>Add or Remove Account</label><br>
	<select name="formStatus">
		<option value="">Select a Status</option>
		<option value="Remove">Remove</option>
		<option value="Add">Add</option>
         </select> 
   

	<input type="submit" name="formSubmit" value="Submit" />

    <?php
//sets the status to the parameter given
function addUser( $name,$pwd)
{
    session_start();
   
    
    require("db.php");
    $db =get_db();
    $nm = $name;
    $pw = $pwd;
    $sql = "INSERT INTO login_details (id, password, level, logged, Status) VALUES ('".$nm."','".$pw."','0','0','')";
 $db->query($sql);
    
   
}

function removeUser($name)
{
    session_start();
   
    
    require("db.php");
    $db =get_db();
    $nm = $name;
    $pw = $pwd;
    $sql = "DELETE FROM login_details WHERE id='".$nm."' ";
 $db->query($sql);
    
    
}


?>
    
    

</body>
</html>
