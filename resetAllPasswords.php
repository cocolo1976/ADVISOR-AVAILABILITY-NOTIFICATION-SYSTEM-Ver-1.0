
<?php
//replace all passwords in login_details witht he following password
    $newPwd = '12345';
    require 'sqliConnect.php';
$con = get_sqli();

 $pw = password_hash($newPwd, PASSWORD_DEFAULT);
 

if(!$con) {
die('Connection failed ');
}
mysqli_select_db($con,"login");
$sql = "UPDATE `login_details` SET `password` = '$pw';  ";

    $query = mysqli_query($con, $sql);





    
  
