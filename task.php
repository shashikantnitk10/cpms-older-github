<?php

//to display the default value in states-dropdown
echo " <option>Select Task  </option> " ;

/*The isset() function is used to check whether a variable is set or not. If value exists in _$GET, it will be passed to a local variable*/
if(isset( $_GET['act']) ) 
{
  $act = $_GET['act'];
  }

//Creating connection to the newly created database, "cpms_old"
include "database_connect.php";

$sql4 =	"SELECT activity_cd, activity_name from cpms_activity where activity_main_cd ='$act'";
		

$query4 = mysqli_query($con,$sql4);

while($row=mysqli_fetch_array($query4))

//Displaying the values (country names fetched by the above query) in the drop down menu.

    {
           echo"<option  value =".$row["activity_cd"]."> ".$row["activity_name"]."</option>";
    }

//The mysql_close() function closes a non-persistent MySQL connection.


?>