<!-- This page is used to fethc alist of all registered advisors-->
<!DOCTYPE html>
<html>
<head>  
    <style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
require_once ('sqliConnect.php');

$con = get_sqli();
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
//selects all advisor 
//SELECT * FROM `login_details` ORDER BY `login_details`.`lastupdate` ASC 
mysqli_select_db($con,"login");
$sql="SELECT id, status,FirstName,LastName,password,level,lastupdate FROM login_details ORDER BY `login_details`.`lastupdate` DESC";
$result = mysqli_query($con,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

echo "<table>
<tr>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Status</th>
<th>Level</th>
<th>LastUpdate</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>" . $row['level'] . "</td>";
    echo "<td>" . $row['lastupdate'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>