<html> 

<head> 
  <script type="text/javascript"> //Used java script in order to know about the item selected on the drop down menu

/*function to provoke state.php script and pass the country selected on the country-dropdown in order to fetch the corresponding states from mysql database. This javascrip is executed based on the onchange event mentioned below*/

        function showstate(str){

	//state dropdown will be kept blank if the country selected is blank.
            if (str == "") {
                document.getElementById("state").innerHTML = "";
                return;
            }
	
	//xmlhttp object creation
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

	//Error Handling if the state.php file is not found
            xmlhttp.onreadystatechange = function(){
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("state").innerHTML = xmlhttp.responseText;
                }
            }

	//calling state.php script with the country name as input to it
            xmlhttp.open("GET", "state.php?country=" + str, true);
            xmlhttp.send();
        }
 </script>

</head>

<body> 

   <form > Choose your country : <select name="country"  onchange="showstate(this.value)"> <option>Select country  </option> 
/*above statements are to get the value selected in the country-dropdown list. Onchange event executes the above JavaScript when a user changes the content of the country field*/

 <?php

//Creating connection to the newly created database, "shashi"
$database="shashi"; //database name
$con=mysql_connect("localhost","root",""); //for wamp 3rd feild is balnk

//Error handling: if not able to connect to the database
if(!$con)
{
die('Could not connect:' .mysql_error()); //mysql_error holds the detail about the error occured
}

//This function sets the active MySQL database and returns TRUE on success, or FALSE on failure.
mysql_select_db($database,$con);

//SQL query to fetch countries from the country table of mysql database; it will be run when the page is initialized.
   $query = "SELECT DISTINCT country FROM country";

//Storing the result of the query in a variable.
   $result = mysql_query($query);

//Displaying the values (country names fetched by the above query) in the drop down menu.
   while($row = mysql_fetch_array($result)){
   echo"<option  value =".$row[0]."> ".$row[0]."</option>";

//The mysql_close() function closes a non-persistent MySQL connection.
mysql_close(); 
                               }   
 ?>

//Create a drop-down list
</select>
State : <select id="state" name="state"> <option>Select state</option> </select> 

</form>

</body>

</html>