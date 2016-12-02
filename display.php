<!--This page displays both queus for wlakings and appointments-->

<html>
    <head>
        <style type="text/css">
            
           .scroll-table1{
      
       height:50%;
       overflow: auto;
       width: 100%
      
       
    }
         .scroll-table2{
      
       height:50%;
    
       overflow: auto;
      
       
    }
                   
            
        </style> 
        
    </head>

    <body>
<?php
include 'sqliConnect.php';
//this page handles the appointment queue
//
//
// connect to the database udinh sqli
$con = get_sqli();
// get results from database

if (!$con)
    {
     die('Could not connect: ' . mysqli_error($con));
    }
//select whole list of students from walk_in
mysqli_select_db($con,"login");
$sql="SELECT * FROM apointments";
$result = mysqli_query($con,$sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
mysqli_close($con);
//Table to dispaly qeueu of students
echo '<div class="scroll-table1">';
echo "<table width =100%  border='1' cellpadding='10'>";

echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th><th>Arrival Time</th><th>Appointment Time</th></tr>";

echo "<tr>";


//create a table of students by displaying all the data from result and adding a button
while($row = mysqli_fetch_array($result)) 
   {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['arrival_time'] . "</td>";
    echo "<td>" . $row['appointment_time'] . "</td>";
   
 
    


echo "</tr>";

}
// close table>
echo "</table>";

echo '</div>';

?>
        
    <?php

   //This page handles the walk in queue

// connect to the database udinh sqli
$con = get_sqli();
// get results from database

if (!$con)
    {
     die('Could not connect: ' . mysqli_error($con));
    }
//select whole list of students from walk_in
mysqli_select_db($con,"login");
$sql="SELECT * FROM walk_in";
$result = mysqli_query($con,$sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
mysqli_close($con);
//Table to dispaly qeueu of students
echo '<div class="scroll-table2">';
echo "<table width = 100% border='1' cellpadding='10'>";

echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th><th>Arrival Time</th></tr>";

echo "<tr>";


//create a table of students by displaying all the data from result and adding a button
while($row = mysqli_fetch_array($result)) 
   {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['ts_updte'] . "</td>";
    
   // echo '<form action="delete.php?id2=' . $row['id'] . '" method="post">';
    // drop down menu for selecting advisor as a form submission
    
    // used to name each submit button with the id from walk_in
  
    

 //create a form to submit the sleected advisor and the selected student to be removed from the queue
 
 //another query used to retreive the list of advisors  to pupulate the drop down menu
 //create a drop down menu with advisors resulting from the queue


echo "</tr>";

}
// close table>
echo "</table>";
echo "</div>"

?>    
        
        

    </body>   
</html>