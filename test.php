<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="activity_report.css">
<script>

function getday1(i){
	
	var date=document.getElementById('date'+i).value;
	var date_selected=new Date(date);
	day=date_selected.getDay();
var t="";
	if(day==1)
	{
	t="Monday";
	}
	else if(day==2)
	{
		t="Tuesday";
	}
	else if(day==3)
	{
			t="Wednesday";
	}
	else if(day==4)
	{
			t="Thursday";
	}
	else if(day==5)
	{
			t="Friday";
	}
	else if(day==6)
	{
			t="Saturday";
	}
	else
	{
		t="Sunday";	
	}
	document.getElementById('day'+i).value=t;
}


</script>
</head>
<body >
<div class="home">
    <a href="next.php">HOME</a>
</div>

<div class="logout">
    <a href="home.php">LOGOUT</a>
	<?phpsession_destroy();
	?>
	
</div>

<br>
<br>
<?php 
include "database_connect.php";
$date=Date('y-m-d');
//echo $date;
$sql="Select a.efforts_dt, a.efforts_act_effort as act_effrt, b.task_project_id as tsk_prj_id, 	(select activity_name from cpms_activity where activity_cd = b.task_activity_cd) as activity_name,	(select activity_name from cpms_activity where activity_cd = b.task_name) as task_name,	b.task_detail as task_detail,	c.project_release_cd as rls_cd from cpms_efforts a, cpms_task b, cpms_project c	where 	a.efforts_task_owner = '$_SESSION[username]' and	a.efforts_task_id = b.task_id and	b.task_project_id = c.project_cd";
//echo $sql;
$query=mysqli_query($con,$sql);

?>
<div class="home">
    <a href="next.php">HOME</a>
</div>

<div class="logout">
    <a href="home.html">LOGOUT</a>
	<?phpsession_destroy();
	?>
	
</div>

<br>
<br>
<form action="act_db.php" method="POST" >

<table id="ActRepSummary">
  <tr>
    <th>Total Billed</th>
    <th>Total NIT</th>
  </tr>
  <tr>
    <td>40</td>
    <td>12</td>
  </tr>
 
</table>

<br>
<br>


<table  id="example" class="display" cellspacing="5" width="100%">
        <thead>
            <tr>
				<th align="left">Date</th>
                <th align="left">Day</th>
                <th align="left">Release</th>
                <th align="left">Project</th>
				<th align="left">Task</th>
				<th align="left">TaskType</th>
                <th align="left">Time</th>
				<th align="left">Remarks</th>
            </tr>
        </thead>
        <tbody> 
		<?php
		if(mysqli_num_rows($query))
		{
		while($row=mysqli_fetch_array($query))
		{
			?>
            <tr>
                <input type="hidden" id="previous" value=<?php echo $row[0]?>  name="previous[]">
				<td><input type="date" id="date<?php echo $row[0]?>" value=<?php echo $row[2]?>  name="date[]" ></td>
				<td><select size="1" id="day<?php echo $row[0]?>" name="day[]" >
			
                    <option value="Monday">
                        Monday
                    </option>
                    <option value="Tuesday">
                        Tuesday
                    </option>
                    <option value="Wednesday">
                        Wednesday
                    </option>
                    <option value="Thursday">
                        Thursday
                    </option>
                    <option value="Friday">
                        Friday
                    </option>
					<option value="Saturday">
                        Saturday
                    </option>
					<option value="Sunday">
                        Sunday
                    </option>
                </select></td>
				
				<td><select size="1" id="release" name="release[]">
				<option value=<?php echo $row[4]?>><?php echo $row[4]?></option>
                    <option value="V17.1">
                        V17.1
                    </option>
                    <option value="V17.2">
                        V17.2
                    </option>
                </select></td>
				
                <td><select size="1" id="project" name="project[]" >
				<option value=<?php echo $row[5]?>><?php echo $row[5]?></option>
                    <option value="VH2MODAL">
                        VH2MODAL
                    </option>
                    <option value="VH2FLORI">
                        VH2FLORI
                    </option>
                    <option value="VH2RTTEC">
                        VH2RTTEC
                    </option>
                </select></td>
				
				<td><select size="1" id="task" name="task[]">
				<option value=<?php echo $row[6]?>><?php echo $row[6]?></option>
                    <option value="SFDI Acceptance" >
                        SFDI Acceptance
                    </option>
                    <option value="DevSheet creation">
                        DevSheet creation
                    </option>
                    <option value="CUT">
                        CUT
                    </option>
                    <option value="QUAL">
                        QUAL
                    </option>
                    <option value="UAT">
                        UAT
                    </option>
                </select></td>
				
				<td><select size="1" id="tasktype" name="tasktype[]">
				<option value=<?php echo $row[7]?>><?php echo $row[7]?></option>
				<option value="Budget" >
				BUDGET
				</option>
				<option value="NIT">
				NIT
				</option>
				</select>
				</td>
				

            </tr>
		<?php }}
		
			?>
				
 </tbody>
    </table>
	
	<button class="submit" type="submit" name="submit"  >Submit</button>
	</form>
	
	<button  class="addrow" onclick="myFunction()">Add Row</button>
	
	
	
	<script>
	
	

function myFunction() {
	alert ('pnl');
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

var list0 = "<input type=\"hidden\" id=\"previous\" value=\"0\"  name=\"previous[]\">";
var list1 = "<input type=\"date\" id=\"date\" name=\"date[]\" placeholder=\"dd-mm-yyyy\">"		   
var list2 = "<select size=\"1\" id=\"day\" name=\"day[]\">" +
                    "<option value=\"Monday\" selected=\"selected\">Monday <\/option>" +
                    "<option value=\"Tuesday\">Tuesday<\/option>"		+
					"<option value=\"Wednesday\">Wednesday<\/option>"	+	
					"<option value=\"Thursday\">Thursday<\/option>"		+
					"<option value=\"Friday\">Friday<\/option>"		+
					"<option value=\"Saturday\">Saturday<\/option>"	+	
					"<option value=\"Sunday\">Sunday<\/option>"				   
var list3 = "<select size=\"1\" id=\"release\" name=\"release[]\"> <option> select release </option> <?php $query1 = mysqli_query($con, $sql); while($row = $query1->fetch_assoc()) { echo"<option  value =".$row[6]."> ".$row[6]."</option>";} ?> </select>" ;
var list4 = "<select size=\"1\" id=\"project\" name=\"project[]\"> <option> select project </option> <?php $query1 = mysqli_query($con, $sql); while($row = $query1->fetch_assoc()) { echo"<option  value =".$row[2]."> ".$row[2]."</option>";} ?> </select>" ;
var list5 = "<select size=\"1\" id=\"actname\" name=\"actname[]\"> <option> select activity </option> <?php $query1 = mysqli_query($con, $sql); while($row = $query1->fetch_assoc()) { echo"<option  value =".$row[3]."> ".$row[3]."</option>";} ?> </select>" ;
var list6 = "<select size=\"1\" id=\"taskname\" name=\"taskname[]\"> <option> select task </option> <?php $query1 = mysqli_query($con, $sql); while($row = $query1->fetch_assoc()) { echo"<option  value =".$row[4]."> ".$row[4]."</option>";} ?> </select>" ;
var list7 = "<input type=\"text\" id=\"effort\" name=\"effort[]\" placeholder=\"Actual Effort in PD\">"
var list8 = "<input type=\"text\" id=\"taskdetail\" name=\"taskdetail[]\" placeholder=\"e.g. Dev sheet name\">"
var list9 = "<input type=\"button\" id=\"del\" name=\"del\" value=\"&times\" onclick=\" delrow(this)\">"
					

    cell1.innerHTML = list1;
    cell2.innerHTML = list2; 
	cell3.innerHTML = list3;
    cell4.innerHTML = list4;
	cell5.innerHTML = list5;
	cell6.innerHTML= list6;
    cell7.innerHTML = list7;
	cell8.innerHTML = list8;
	cell9.innerHTML = list9;
	cell10.innerHTML = list0;
}
function delrow(row){

  
  var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('example').deleteRow(i);
  
  /*var table = document.getElementById("example");
    var rowCount = table.rows.length;

    table.deleteRow(rowCount-1);*/
    
     
}
function getdate(){
var month=document.getElementById("month").value;
var year=document.getElementById("year").value;

}

n =  new Date();
y = n.getFullYear();
m = n.getMonth() + 1;
d = n.getDate();
document.getElementById("date").value =  d + "/" + m + "/" + y;
</script>

</body>
</html>
	