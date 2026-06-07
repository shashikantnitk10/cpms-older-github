<?php

//to display the default value in states-dropdown

/*The isset() function is used to check whether a variable is set or not. If value exists in _$GET, it will be passed to a local variable*/
if(isset( $_GET['tskcd']) ) 
{
  $tskcd = $_GET['tskcd'];
  $userName = $_GET['userName'];
  $acty = $_GET['acty'];
  $proj = $_GET['proj'];
  $tskdtl = $_GET['tskdtll'];
}


//Creating connection to the newly created database, "cpms_old"
include "database_connect.php";

$sql7 =	"Select distinct task_pln_budget as tsk_detail,task_act_budget as actual_budget from
		cpms_task where task_activity_cd = '$acty' and
		task_owner = '$userName' and
		task_name = '$tskcd' and 
		task_detail = '$tskdtl' and 
		task_project_id = '$proj'" ;
		
$query7 = mysqli_query($con,$sql7);		

while($row=mysqli_fetch_array($query7))

//Displaying the values (country names fetched by the above query) in the drop down menu.

    {
         //  echo "<script>alert('$row[0]');</script>";
		   echo "Init = ".$row[0]." Consumed = ".$row[1];
    }

//The mysql_close() function closes a non-persistent MySQL connection.


?>
