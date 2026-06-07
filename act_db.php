<?php
session_start();
include "database_connect.php";



if(isset($_SESSION['username']))
{	$user=$_SESSION['username'];	
}


$taskid=$_POST['taskid'];
$date=$_POST['date'];
$previous=$_POST['previous'];
$day=$_POST['day'];
$release=$_POST['release'];
$project=$_POST['project'];
$actname=$_POST['actname'];
$taskname=$_POST['tskname'];
$effort=$_POST['effort'];
$taskdetail=$_POST['taskdetail'];
$rae = $_POST['RAE'];
$len=count($date);


for($i=0;$i<$len;$i++)
{
	if($previous[$i]=="0")
	{
	$sql=  "INSERT INTO cpms_efforts(efforts_task_id,efforts_task_owner,efforts_dt,efforts_act_effort,efforts_task_ttf) values((SELECT task_id from cpms_task where task_project_id = '$project[$i]' and task_activity_cd = '$actname[$i]' and task_name = '$taskname[$i]' and task_owner = '$_SESSION[username]'),'$user','$date[$i]','$effort[$i]','$rae[$i]')";
	mysqli_query($con,$sql);
	}	
	else if($previous[$i]!=0)
	{
		$sql="UPDATE cpms_efforts SET   efforts_act_effort='$effort[$i]',efforts_task_ttf  = '$rae[$i]' where efforts_task_id='$taskid[$i]' and efforts_dt='$date[$i]' and efforts_task_owner = '$_SESSION[username]'";
		mysqli_query($con,$sql);
		
	}
		
}
$sqltaskid = "SELECT task_id , task_act_start_dt, task_act_end_dt, task_ttf  from cpms_task a where  task_owner = '$_SESSION[username]'  and task_id IN (Select efforts_task_id from cpms_efforts where efforts_task_owner = '$_SESSION[username]') and task_act_end_dt is NULL order by task_id";
			
		
			$task_usertasks =mysqli_query($con,$sqltaskid);
			while($row=mysqli_fetch_array($task_usertasks))
			{
				$task_id1 = $row[0];
				if($row['task_act_start_dt'] == null)
				{
					$sql1 = "SELECT efforts_task_id, MIN(efforts_dt)  from cpms_efforts where efforts_task_id = '$task_id1' and efforts_task_owner = '$_SESSION[username]'";
				    $efforts_mindates = mysqli_query($con,$sql1);
					$row1 = mysqli_fetch_array($efforts_mindates);
					$update_act_start_dt = "UPDATE cpms_task SET task_act_start_dt = '$row1[1]' where task_id = '$task_id1'";
					mysqli_query($con,$update_act_start_dt);
				}
				
				$sql2 = "SELECT efforts_task_id, efforts_dt, efforts_task_ttf  from cpms_efforts where efforts_task_id = '$task_id1' and efforts_task_owner = '$_SESSION[username]' and efforts_dt = (SELECT MAX(efforts_dt)  from cpms_efforts where efforts_task_id = '$task_id1' and efforts_task_owner = '$_SESSION[username]')";
				$efforts_maxdates = mysqli_query($con,$sql2);
			    $row2 = mysqli_fetch_array($efforts_maxdates);
				if($row2[2] == 0 )
				{
					$update_act_end_dt = "UPDATE cpms_task SET task_act_end_dt = '$row2[1]' , task_ttf = '$row2[2]'where task_id = '$task_id1'";
					mysqli_query($con,$update_act_end_dt);
				}
				
				else 
				{
					$update_task_ttf = "UPDATE cpms_task SET  task_ttf = '$row2[2]'where task_id = '$task_id1'";
					mysqli_query($con,$update_task_ttf);
				}
			    
			}
			



?>
<script>
alert("UPDATED AND INSERTED");
setTimeout(window.open('activity_report.php','_self'),5000);
</script>
<?php 
mysqli_close($con);
?>