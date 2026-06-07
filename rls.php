<?php

//to display the default value in states-dropdown
echo " <option>Select Project  </option> " ;

/*The isset() function is used to check whether a variable is set or not. If value exists in _$GET, it will be passed to a local variable*/
if(isset( $_GET['rel']) ) 
{
  $rel = $_GET['rel'];
  $userName = $_GET['userName'];
}

//Creating connection to the newly created database, "cpms_old"
include "database_connect.php";

$sql4 =	"Select distinct a.project_cd as prj_cd
		from cpms_project a, cpms_task b 
		where
		a.project_cd = b.task_project_id and
		a.project_release_cd = '".$rel."' and
		b.task_owner = '".$userName."'";
		

$query4 = mysqli_query($con,$sql4);

while($row=mysqli_fetch_array($query4))

//Displaying the values (country names fetched by the above query) in the drop down menu.

    {
           echo"<option  value =".$row["prj_cd"]."> ".$row["prj_cd"]."</option>";
    }

//The mysql_close() function closes a non-persistent MySQL connection.


?>