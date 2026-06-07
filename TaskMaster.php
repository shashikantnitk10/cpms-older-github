<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="activity_report.css">
<?php 
$prjcd=$_GET["project_cd"];

//$project_cd = $_SESSION['project_cd'];
include "database_connect.php";
//echo $date;
$sql0= "select 
		a.task_project_id, 
		a.task_iteration, 
		(select activity_name from cpms_activity where cpms_activity.activity_cd = a.task_activity_cd),
		(select activity_name from cpms_activity where cpms_activity.activity_cd = a.task_name),
		a.task_detail, 
		a.task_owner ,
		a.task_pln_start_dt, 
		a.task_pln_end_dt, 
		a.task_pln_budget,
		a.task_id,
		a.task_activity_cd,
		a.task_name	
		from cpms_task a 
		where a.task_project_id = '$prjcd' " ;
		
$sql1="SELECT activity_cd, activity_name from cpms_activity where activity_main_cd is NULL";
$sql2="SELECT activity_cd, activity_name from cpms_activity where activity_main_cd is not NULL";
$sql3="SELECT user_trgm, user_name from cpms_user";
$sql4="Select project_release_cd from cpms_project where project_cd = '$prjcd' ";
//echo $sql;
$query0=mysqli_query($con,$sql0);
$query1=mysqli_query($con,$sql1);
$query2=mysqli_query($con,$sql2);
$query3=mysqli_query($con,$sql3);


?>

<script>



function delrow(row){

  
  var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('example').deleteRow(i);
  
  /*var table = document.getElementById("example");
    var rowCount = table.rows.length;

    table.deleteRow(rowCount-1);*/
    
     
}

function showtask(activity,id)
{
	//Project dropdown will be kept blank if the release selected is blank.
            if (activity == "") {
                document.getElementById("task").innerHTML = "";
                return;
            }
			var length = id.length;
			var varlength = length-8;
			var idnum = id.substr(8,varlength);
			
			
				
	//xmlhttp object creation
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

	//Error Handling if the rls.php file is not found
            xmlhttp.onreadystatechange = function(){
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById('task'+idnum).innerHTML = xmlhttp.responseText;
                }
				
            }

	//calling rls.php script with the release name as input to it
			xmlhttp.open("GET", "task.php?act=" + activity , true);
            xmlhttp.send();	
}

function myFunction() {
	var table = document.getElementById("example");
	var rowCount = table.rows.length;
    var row   = table.insertRow();
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
	var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
	var cell5 = row.insertCell(4);
	var cell6 = row.insertCell(5);
	var cell7 = row.insertCell(6);
	var cell8 = row.insertCell(7);
	var cell9 = row.insertCell(8);	
	var cell10 = row.insertCell(9);	
	var cell11 = row.insertCell(10);	
	var cell12 = row.insertCell(11);	
	var cell13 = row.insertCell(12);	
	var cell14 = row.insertCell(13);		
		
	var list0 = "<input type=\"hidden\" id=\"previous\" value=\"0\" name=\"previous[]\">"		
	var list1 = "<input type=\"text\" id=\"pname\" name=\"pname[]\" value=\"<?php echo "$prjcd" ?>\">"
	var list2 = "<input type=\"text\" id=\"itr\" name=\"itr[]\" placeholder=\"Enter iteration\">"
	var list3 = "<select id='activity"+rowCount+"' name='activity[]' onchange='showtask(this.value, this.id)' name='activity[]' ><option>Select activity</option><?php $query1=mysqli_query($con,$sql1); while($row = mysqli_fetch_array($query1)){echo "<option value=".$row[0].">" . $row[1] . "</option>";}?> </select>"
	var list4 = "<select id='task"+rowCount+"' name='task[]' ><option>Select task</option></select>"
	var list5 = "<input type=\"text\" id=\"task_detail\" name=\"task_detail[]\" placeholder=\"Enter task detail\">"
	var list6 = "<select name=\"owner[]\"><option>Assigned to</option><?php $query3=mysqli_query($con,$sql3); while($row = mysqli_fetch_array($query3)){echo "<option value=".$row[0].">" . $row[1] . "</option>";}?> </select>"
	var list7 = "<input type=\"date\" id=\"strtdt\" name=\"strtdt[]\" placeholder=\"Planned Start date\">"
	var list8 = "<input type=\"date\" id=\"enddt\" name=\"enddt[]\" placeholder=\"Planned End Date\">"
	var list9 = "<input type=\"text\" id=\"budget\" name=\"budget[]\" placeholder=\"In Person days\">"
	var list10 = "<input type=\"button\" id=\"del\" name=\"del\" value=\"&times\" onclick=\" delrow(this)\">"
	var list11 = "<input type=\"hidden\" id=\"task_id\" value=\" \" name=\"task_id[]\">"		
	var list12 = "<input type=\"hidden\" id=\"activity_cd\" value=\" \" name=\"activity_cd[]\">"		
	var list13 = "<input type=\"hidden\" id=\"sub_activity_cd\" value=\" \" name=\"sub_activity_cd[]\">"		
	
					
    cell11.innerHTML = list0;						
    cell1.innerHTML = list1;
    cell2.innerHTML = list2; 
	cell3.innerHTML = list3;
    cell4.innerHTML = list4;
	cell5.innerHTML = list5;
	cell6.innerHTML = list6;
	cell7.innerHTML = list7;
	cell8.innerHTML = list8;
	cell9.innerHTML = list9;
	cell10.innerHTML = list10;	
	cell12.innerHTML = list11;	
	cell13.innerHTML = list12;	
	cell14.innerHTML = list13;	
}

</script>
</head>
<body >





<div class="home" >
    <a href="next.php">HOME</a>
</div>

<div class="logout">
    <a href="home.php">LOGOUT</a>
	<?phpsession_destroy();
	?>
	
</div>

<h1 style="text-align: center;"> TASK SUMMARY </h1>


<div style="margin-left:600px; border-bottom: 1px solid #777777;
    border-left: 1px solid #000000;
    border-right: 1px solid #333333;
    border-top: 1px solid #000000;
    text-align:center;
	font-weight:bold;
	text-decoration:none;
	background-color:white;
	display: block; height: 25px;
	width:80px;
    padding: 3px;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);         ">
	<?php
	$query4=mysqli_query($con,$sql4);
	$row=mysqli_fetch_array($query4);
	
    echo "<a style=\"color: #003829;\" onMouseOver=\"this.style.color='red'\" onMouseOut=\"this.style.color='#003829'\" href=\"ProjectMaster.php?rls_cd=" .$row[0]. "\">Projects</a> ";
	
	?>
   
</div>


<form action="tsk_db.php" method="POST" >

<br>
<br>
<br>
<br>

<table  id="example" class="display" cellspacing="5" width="100%">
        <thead>
            <tr>
				<th align="left">Project</th>
                <th align="left">Iteration</th>
                <th align="left">Activity</th>
                <th align="left">Task</th>
				<th align="left">Task detail</th>
				<th align="left">Assigned to</th>
				<th align="left">Plan start dt</th>
				<th align="left">Plan end dt</th>
				<th align="left">Planned budget</th>
            </tr>
        </thead>
        <tbody> 
		<?php
		if(mysqli_num_rows($query0))
		{
		while($row=mysqli_fetch_array($query0))
		{
			
			?>
            <tr>
                <input type="hidden" id="previous" value=<?php echo $row[0]?>  name="previous[]">
				
				<td><input type="text" id="pname" name="pname[]" value="<?php echo $row[0]?>" ></td>
				<td><input type="text" id="itr" name="itr[]" value="<?php echo $row[1]?>" ></td>
				<td><input type="text" id="activity" name="activity[]" value="<?php echo $row[2]?>" ></td>
				<td><input type="text" id="task" name="task[]" value="<?php echo $row[3]?>" ></td>
				<td><input type="text" id="task_detail" name="task_detail[]" value="<?php echo $row[4]?>" ></td>
				<td><input type="text" id="owner" name="owner[]" value="<?php echo $row[5]?>" ></td>
				<td><input type="text" id="strtdt" name="strtdt[]" value="<?php echo $row[6]?>" ></td>
				<td><input type="text" id="enddt" name="enddt[]" value="<?php echo $row[7]?>" ></td>
				<td><input type="text" id="budget" name="budget[]" value="<?php echo $row[8]?>" ></td>
				<input type="hidden" id="task_id" name="task_id[]" value="<?php echo $row[9]?>" >
				<input type="hidden" id="activity_cd" name="activity_cd[]" value="<?php echo $row[10]?>" >
				<input type="hidden" id="sub_activity_cd" name="sub_activity_cd[]" value="<?php echo $row[11]?>" >
				
            </tr>
		<?php }}
		
			?>

<!--	<tr>
			<td><input type="text" id="project" name="project[]"></td>
			<td><input type="text" id="iteration" name="iteration[]" placeholder="Enter iteration"></td>
			<td></td>
			<td><input type="text" id="activity" name="activity[]" placeholder="Enter activity"></td>
			<td><input type="text" id="task" name="task[]" placeholder="Enter task"></td>
			<td><input type="text" id="taskdetail" name="taskdetail[]" placeholder="Enter task detail"></td>
			<td><input type="text" id="assigndto" name="assigndto[]" placeholder="Full Name"></td>
			<td><input type="date" id="strtdt" name="strtdt[]" placeholder="Expected Start date" ></td>
			<td><input type="date" id="enddt" name="enddt[]" placeholder="Expected End Date" ></td>
			<td><input type="text" id="budget" name="budget[]" placeholder="In Person days"></td>
		</tr>

-->

		</tbody>
 </table>
	
	<button class="submit" type="submit" name="submit"  >Submit</button>
</form>
	
	<button  class="addrow" onclick="myFunction()">Add Task</button>
	


</body>
</html>
