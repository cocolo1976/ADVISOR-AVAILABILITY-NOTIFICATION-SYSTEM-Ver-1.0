<?php
$DB_HOST = 'xxx';
$DB_USER = 'xxx';
$DB_PASS = 'xxx';
$DB_NAME = 'xxx';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if($conn->connect_errno > 0) {
die('Connection failed [' . $conn->connect_error . ']');
}

$password = "rasmuslerdorf";
$first_name = "john";
$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (`name`, `password`) VALUES ('" .$first_name ."', '" .$password ."')";

    $query = mysqli_query($conn, $sql);
    if($query)

{
    echo "Success!";
}

else{
    // echo "Error";
    die('There was an error running the query [' . $conn->error . ']');
}