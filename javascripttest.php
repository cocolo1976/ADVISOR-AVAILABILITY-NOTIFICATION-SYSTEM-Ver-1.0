 <html>
<head>
<script>
    //refresh the show users function
   myVar = setInterval(showUsers, 1000);
   
   //function to call the fetch table php page
function showUsers(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","fetchTable.php?q="+str,true);
        xmlhttp.send();
    }
}

</script>
</head>
<body>
 
<br>
<!--Display the table here    -->
<div   id="txtHint"><b>Status Will be displayed here.</b></div>


</body>
</html>
