<?php
session_start();
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==2){


//upade the database to show that the user is logged in.
$name =$name = $_SESSION['id'];
require_once("db.php");
$db = get_db();
$sql = "UPDATE  login_details SET logged='1' WHERE id='$name'";
 $db->query($sql);
 $db = null;


//calls the db class
require_once("db.php");

//creates  a table to display the sql query results
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Status</th><th></th></tr>";
class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

//uses the db class to connect to the database
$db =get_db();

//function to display each logged in advisor
getLogged($db);
//display welcome message and logout link
 echo "'Welcome to the front desk'"."<br/><a href='logout.php'>Logout</a>";
 }
else{
 header("Location:index.php?err=2");
 }
?>

<?php

//function to display each logged in advisor
//takes a database connection
function getLogged($db) {
//execute query to diaply all logged in adviors
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare("SELECT id, status FROM login_details where logged =1 and level =0");
    $stmt->execute();


//populates the table with the results

     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
	        echo $v;
    }






    }

?>

<?php
//refresh page to read database updates
    header("refresh: 3;");
?>