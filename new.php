<?php

//adds new walk-ins to the queue 

function renderForm($first, $last,$advisor,$pid, $error)

{

?>


<html>

<head>

<title>Add Student to Queue</title>

</head>

<body>

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>



<form action="" method="post">

<div>

<strong>First Name: *</strong> <input type="text" name="firstname" value="<?php echo $first; ?>" /><br/>

<strong>Last Name: *</strong> <input type="text" name="lastname" value="<?php echo $last; ?>" /><br/>
<strong>P ID: </strong> <input type="text" name="pid" value="<?php echo $pid; ?>" /><br/>
<?php
echo "<label for='advisor'><strong>Select which advisor to see:</strong> </label>";
echo '<select name="advisor">';
$con = get_sqli();
            mysqli_select_db($con,"login");
$sql="SELECT * FROM login_details WHERE level = 0 AND logged = 1";
$result2 = mysqli_query($con,$sql);

if (!$result2)
   {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}


            //loops through all advisors for drop down menu creation
               while ($row2 = mysqli_fetch_array($result2)) 
                       {
                         $id = $row2['id'];
                         echo '<option value="'.$id.'">'.$id.'</option>';
                      }
echo'<option selected="selected"></option>';
 
echo '</select>';
?>

<p>* required</p>

<input type="submit" name="submit" value="Submit">

</div>

</form>

</body>

</html>

<?php

}









// connect to the database

include('sqliConnect.php');

$con = get_sqli();

mysqli_select_db($con,"login");

// check if the form has been submitted. 

if (isset($_POST['submit']))

{

// get form data, making sure it is valid

$firstname = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));

$lastname = mysql_real_escape_string(htmlspecialchars($_POST['lastname']));

$advisor = mysql_real_escape_string(htmlspecialchars($_POST['advisor']));
$pid = mysql_real_escape_string(htmlspecialchars($_POST['pid']));

// check to make sure both fields are entered

if ($firstname == '' || $lastname == ''|| $advisor =='')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!PID is optional';



// if either field is blank, display the form again

renderForm($firstname, $lastname,$advisor,$pid, $error);

}

else

{

// save the data to the database
$sql="INSERT walk_in SET firstname='$firstname', lastname='$lastname',advisor = '$advisor',pid='$pid'";
$result = mysqli_query($con,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
//mysql_query("INSERT walk_in SET firstname='$firstname', lastname='$lastname',pid='$pid'")

//or die(mysql_error());



// once saved, redirect back to the view page

header("Location: desk.php");

}

}

else

// if the form hasn't been submitted, display the form

{

renderForm('','','','','');

}

?>