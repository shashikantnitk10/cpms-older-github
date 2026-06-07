<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="activity_report.css">
<script>


</script>
</head>
<body >

<?php 


$prjcd=$_GET["project_cd"];
include "database_connect.php";
	
// Db query section//	

  //$proj = $_SESSION['proj'];
  
  
   

$sql1 = "Select t.task_iteration, a.activity_name, t.task_detail, 
		(Select user_name from CPMS_USER where user_trgm = t.task_owner),
		t.task_pln_budget, t.task_act_budget, t.task_nit, t.task_ttf, t.task_pln_start_dt, t.task_pln_end_dt, t.task_act_start_dt, t.task_act_end_dt from cpms_task t inner join cpms_activity a 
		on
		t.task_name = a.activity_cd and
		t.task_project_id = '$prjcd'";

$query1 = mysqli_query($con,$sql1);

?>


<div class="home">
    <a href="project_report_gen.php" style= width:auto;>Projects Summary</a>
	<?phpsession_destroy();
	?>
</div>


<br>
<br>


<form action="act_db.php" method="POST" >

<br>
<br>


<table  id="example" class="display" cellspacing="5" width="100%">
        <thead>
            <tr>
				<th align="left">Iteration</th>
                <th align="left">Task</th>
                <th align="left">Task Detail</th>
                <th align="left">Task Owner</th>
				<th align="left">Planned Budget</th>
				<th align="left">Consumed</th>
				<th align="left">Progress</th>
				<th align="left">NIT</th>
				<th align="left">RAE</th>
				<th align="left">Planned Start Dt</th>
				<th align="left">Planned End Dt</th>
				<th align="left">Actual Start Dt</th>
				<th align="left">Actual End Dt</th>
				
            </tr>
        </thead>
        <tbody> 
        

			<?php
			
			// fetch rows from db section//
			
			if(mysqli_num_rows($query1))
			{				
			while($row=mysqli_fetch_array($query1))
			{
			$progress = ($row[5]/($row[5] + $row[7])) * 100;
			
			
			?>		
			<tr>
				<input type="hidden" id="previous" value=<?php echo $row[0]?>  name="previous[]">				
				
				<td><input type="text" id="iteration" name="itration[]" readonly value=<?php echo $row[0]?> ></td>
				
				<td><input type="text" id="task" name="task[]" readonly value=<?php echo $row[1]?> ></td>
				
				<td><input type="text" id="taskdetail" name="taskdetail[]" readonly value=<?php echo $row[2]?> ></td>
				
				<td><input type="text" id="taskowner" name="taskowner[]" readonly value=<?php echo $row[3]?> ></td>
				
				<td><input type="text" id="pbudget" name="pbudget[]" readonly value=<?php echo $row[4]?> ></td>
				
				<td><input type="text" id="consumed" name="consumed[]" readonly value=<?php echo $row[5]?> ></td>
				
				<td><input type="text" id="progress" name="progress[]" readonly value=<?php echo $progress?> ></td>
				
				<td><input type="text" id="nit" name="nit[]" readonly value=<?php echo $row[6]?> ></td>
				
				<td><input type="text" id="rae" name="rae[]" readonly value=<?php echo $row[7]?> ></td>
				
				<td><input type="date" id="pstdt" value=<?php echo $row[8]?>  name="pstdt[]"</td>
				
				<td><input type="date" id="pendt" value=<?php echo $row[9]?>  name="pendt[]"</td>
				
				<td><input type="date" id="astdt" value=<?php echo $row[10]?>  name="astdt[]"</td>
				
				<td><input type="date" id="pendt" value=<?php echo $row[11]?>  name="pendt[]"</td>
				
			
			</tr>
			
			<?php
			}
			}
			?>
			
			
			
			

 </tbody>
    </table>
	

		
		<?php echo "<a href=\"TaskMaster.php?project_cd=" .$prjcd. "\"> Add Task </a>" ?>	
	
	
	
		
</body>
</html>

