<?php
session_start();
include "database_connect.php";

$previous=$_POST['previous'];
$pname=$_POST['pname'];
$itr=$_POST['itr'];
$activity=$_POST['activity'];
$task=$_POST['task'];
$owner=$_POST['owner'];
$task_detail=$_POST['task_detail'];
$strtdt=$_POST['strtdt'];
$enddt=$_POST['enddt'];
$budget=$_POST['budget'];
$task_id=$_POST['task_id'];
$activity_cd=$_POST['activity_cd'];
$sub_activity_cd=$_POST['sub_activity_cd'];


$len=count($pname);

for($i=0;$i<$len;$i++)
{
	$temp=$pname[$i];
	if($previous[$i]=='0')
	{
		$sql=  "INSERT INTO cpms_task(task_project_id , task_iteration , task_activity_cd , task_name ,
        task_detail , task_owner , task_pln_start_dt , task_pln_end_dt ,task_pln_budget )
		values('$pname[$i]','$itr[$i]','$activity[$i]','$task[$i]','$task_detail[$i]','$owner[$i]','$strtdt[$i]','$enddt[$i]','$budget[$i]')";
				
	mysqli_query($con,$sql);
	}
	else if($previous[$i]<>'0')
	{
		$sql= "UPDATE  cpms_task SET 
		task_project_id= '$pname[$i]',
		task_iteration =  '$itr[$i]', 
		task_activity_cd = '$activity_cd[$i]', 
		task_name = '$sub_activity_cd[$i]',
        task_detail = '$task_detail[$i]', 
		task_owner = '$owner[$i]', 
		task_pln_start_dt = '$strtdt[$i]', 
		task_pln_end_dt= '$enddt[$i]', 
		task_pln_budget = '$budget[$i]'
		where task_id='$task_id[$i]'";
				
		mysqli_query($con,$sql);
		
	}
/*if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}*/

}



?>
<script>
alert("UPDATED AND INSERTED");
window.open("<?php echo "TaskMaster.php?project_cd=" .$temp ; ?>","_self");
</script>

<?php 
mysqli_close($con);
?>

