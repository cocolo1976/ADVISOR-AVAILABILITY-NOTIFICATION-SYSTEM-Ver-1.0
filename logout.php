<?php

session_start();
if(isset($_SESSION["access_level"]))
    {
//database connection class
require("db.php");
//session id used to update database
$name = $_SESSION['id'];

//upade the database to show that the user is logged out (logged = 0).
$db = get_db();
$sql = "UPDATE  login_details SET logged='0' WHERE id='$name'";
 $db->query($sql);


 
 
 session_destroy();
header("Location:index.php?err=5");
 
}



?>