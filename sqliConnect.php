<?php
//sqli database connection  method
//function to connect to database
function get_sqli(){
 $db_name="login"; // Database name
 $host="localhost";
 $username="root";
 $password="";
 $con = mysqli_connect("$host","$username","$password","$db_name");

 return $con;
}
