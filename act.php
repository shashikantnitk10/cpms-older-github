<?php

//to display the default value in states-dropdown
echo " <option>Select Activity  </option> " ;


/*The isset() function is used to check whether a variable is set or not. If value exists in _$GET, it will be passed to a local variable*/
if(isset( $_GET['proj']) ) 
{
  $proj = $_GET['proj'];
  $userName = $_GET['userName'];
}
echo "<script> alert('$proj')</script>";


//Creating connection to the newly created database, "cpms_old"
include "database_connect.php";


		
$sql5 =	"Select distinct a.activity_cd as act_cd, a.activity_name as act_name from
		cpms_activity a inner join cpms_task b on
		a.activity_cd = b.task_activity_cd and
		b.task_owner = '".$userName."' and
		b.task_project_id = '".$proj."'";
		

$query5 = mysqli_query($con,$sql5);

while($row=mysqli_fetch_array($query5))

//Displaying the values (country names fetched by the above query) in the drop down menu.

    {
           echo"<option  value =".$row["act_cd"]."> ".$row["act_name"]."</option>";
		   
    }

//The mysql_close() function closes a non-persistent MySQL connection.


?>