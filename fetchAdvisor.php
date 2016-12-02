<!-- This page is used to fetch the whole table on logged in users-->
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

$q = ( $_GET['q'] );
//$q ="SELECT id, status FROM login_details";
$con = get_sqli();

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"login");
$sql=$q;
$result = mysqli_query($con,$sql);
if (!$result) {
   printf("Error: %s\n", mysqli_error($con));
}

echo "<table>
<tr>
<th>ID</th>
<th>Status</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
</body>
</html>

