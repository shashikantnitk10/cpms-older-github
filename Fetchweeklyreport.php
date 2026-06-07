
<html>
<head>
</head>
<body>

<?php 

session_start();
include "database_connect.php";
$username = $_SESSION["username"];
//$date=Date('y-m-d');
$datevalue = ($_GET["datevalue"]);
//$day = date('w');
$week_start = date('d-m-Y', strtotime('monday this week', strtotime($datevalue)));
$date1=date_create($week_start);
$week_mon_date = date_format($date1,"Y-m-d");	

$week_end = date('d-m-Y', strtotime('sunday this week', strtotime($datevalue)));
$date2=date_create($week_end);
$week_sun_date = date_format($date2,"Y-m-d");	


$sql2 = "Select a.efforts_dt, a.efforts_act_effort as act_effrt, b.task_project_id as tsk_prj_id, 
	(select activity_name from cpms_activity where activity_cd = b.task_activity_cd) as activity_name,
	(select activity_name from cpms_activity where activity_cd = b.task_name) as task_name,
	b.task_detail as task_detail,
	c.project_release_cd, b.task_id
	from cpms_efforts a, cpms_task b, cpms_project c
	where 
	a.efforts_dt  >= '$week_mon_date' and 
    a.efforts_dt  <= '$week_sun_date' and
	a.efforts_task_owner = '$_SESSION[username]' and
	a.efforts_task_id = b.task_id and
	b.task_project_id = c.project_cd
	order by a.efforts_dt";
	
$query1 = mysqli_query($con,$sql2);

echo "<table  id='example' class='display' cellspacing='5' width='100%'>
        <thead>
            <tr>
				<th align='left'>Date</th>
                <th align='left'>Day</th>
                <th align='left'>Release</th>
                <th align='left'>Project</th>
				<th align='left'>Activity</th>
				<th align='left'>Task</th>
				<th align='left'>Task Detail</th>
				<th align='left'>Effort</th>
				<th align='left'>RAE</th>
				
            </tr>
        </thead>";

			
			
			if(mysqli_num_rows($query1))
			{
				$subs = 0;
			while($row=mysqli_fetch_array($query1))
			{
				$subs = $subs + 1;
		echo"	 <input type='hidden' id='taskid'  name='taskid[]' value=".$row[7].">";
		echo"	 <input type='hidden' id='previous' name='previous[]' value=".$row[0].">";	
		echo"<td><input type='date'   id='date".$subs."' value=".$row[0]." name='date[]' onchange = 'getday1(".$subs.")' readonly></td>";
	 	
		echo"		<td><input type= 'text'id='day".$subs."' value=".date('l',strtotime($row[0]))." name='day[]' readonly></td>";
				
		echo"		<td><select size='1' id='release' name='release[]'>";
		echo"		<option value=".$row[6].">".$row[6]. "</option>";
        echo"       </select></td>";
		
		echo" <td><select size='1' id='project' name='project[]'>";
		echo"	<option value=".$row[2].">".$row[2]."</option>";
        echo"   </select></td>";
		
		echo" <td><select size='1' id='actname' name='actname[]'>";
		echo"	<option value=".$row[3].">".$row[3]."</option>";
        echo"   </select></td>";
		
		echo" <td><select size='1' id='tskname' name='tskname[]'>";
		echo"	<option value=".$row[4].">".$row[4]."</option>";
        echo"   </select></td>";
		
		echo" <td><select size='1' id='taskdetail' name='taskdetail[]'>";
		echo"	<option value=".$row[5].">".$row[5]."</option>";
        echo"   </select></td>";
		
		
		echo"<td><input type='text' id='effort' name='effort[]' value=".$row[1]." ></td>";
				
		echo"	<td><input type='text' id='RAE' name='RAE[]' value=".$row[1]." ></td>";

				
		echo" 	</tr>";
			}
			}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>



<!-- select release
//$sql3 =	"Select distinct a.project_release_cd as rls_cd from cpms_project a, cpms_task b where b.task_owner = '$_SESSION[username]' and a.project_cd = b.task_project_id ";
//$query3 = mysqli_query($con,$sql3);

		
?>-->