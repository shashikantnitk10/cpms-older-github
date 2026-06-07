<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="activity_report.css">

<?php 
include "database_connect.php";
// select release
$sql3 =	"Select distinct a.project_release_cd as rls_cd from cpms_project a, cpms_task b where b.task_owner = '$_SESSION[username]' and a.project_cd = b.task_project_id ";
$query3 = mysqli_query($con,$sql3);
	
?>
<script>


function fetchweekdetails(dateselected)

{
	//var dateselected = document.getElementById('weekselect').value;
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tabledetils").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "Fetchweeklyreport.php?datevalue=" + dateselected, true);
        xmlhttp.send();
}

function showactivitydetails()
{
	var today = new Date();
	d = today.getDate();
	y = today.getFullYear();
    m = today.getMonth() + 1;
    today =  d + "-" + m + "-" + y;
	fetchweekdetails(today);	
}

function getday1(index){
	var date_selected = document.getElementById('date'+index).value;
	var d = new Date(date_selected);
	day=d.getDay();
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
	document.getElementById('day'+index).value=t;
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

var list0 = "<input type=\"hidden\" id=\"previous\" value=\"0\"  name=\"previous[]\">";
var list1 = "<input type=\"date\" id=\"date"+rowCount+"\" onchange=getday1("+rowCount+") name=\"date[]\" value=\"<?php echo date("Y-m-d");?>\">"		   
var list2 = "<input type ='text' id='day"+rowCount+"' name='day[]' readonly>"; 
var list3 = "<select size='1' id='release"+rowCount+"'name='release[]' onchange='showproject(this.value, this.id)'> <option> select release </option> <?php $query3 = mysqli_query($con,$sql3); while($row = $query3->fetch_assoc()) { echo"<option  value =".$row["rls_cd"]."> ".$row["rls_cd"]."</option>";} ?></select>";
var list4 = "<select size=\"1\" id=\"project"+rowCount+"\" name=\"project[]\"onchange=\"showactname(this.value, this.id)\"> <option> select project </option> </select>" ;
var list5 = "<select size=\"1\" id=\"actname"+rowCount+"\" name=\"actname[]\"onchange=\"showactname(projname, this.id, this.value)\"> <option> select activity </option>  </select>" ;
var list6 = "<select size=\"1\" id=\"tskname"+rowCount+"\" name=\"tskname[]\"onchange=\"showtskname(projname, actcd, this.id, this.value)\"> <option> select task </option>  </select>" ;
var list7 = "<select size=\"1\" id=\"taskdetail"+rowCount+"\" name=\"taskdetail[]\"onchange=\"ShowConsumed(projname, actcd, TaskSave, this.id, this.value)\"> <option> select task detail </option>  </select>" ;
var list8 = "<input type=\"text\" id=\"effort"+rowCount+"\" name=\"effort[]\" >";
var list9 = "<input type=\"text\" id=\"RAE\" name=\"RAE[]\" placeholder=\"Remain Act Effort in PD\" value=\"0.00\">";
var list10 = "<input type=\"button\" id=\"del\" name=\"del\" value=\"&times\" onclick=\" delrow(this)\">";
var list11 = "<input type=\"hidden\" id=\"taskid\" value=\"0\"  name=\"taskid[]\">";
					
    cell1.innerHTML = list1;
    cell2.innerHTML = list2; 
	cell3.innerHTML = list3;
    cell4.innerHTML = list4;
	cell5.innerHTML = list5;
	cell6.innerHTML = list6;
    cell7.innerHTML = list7;
	cell8.innerHTML = list8;
	cell9.innerHTML = list9;
	cell10.innerHTML = list0;
	cell11.innerHTML = list10;
	cell12.innerHTML = list11;
	getday1(rowCount);
	
	
}

function delrow(row){

  
  var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('example').deleteRow(i);
  
  /*var table = document.getElementById("example");
    var rowCount = table.rows.length;

    table.deleteRow(rowCount-1);*/
    
     
}

function showproject(rls, id)
{
	
	//Project dropdown will be kept blank if the release selected is blank.
            if (rls == "") {
                document.getElementById("project").innerHTML = "";
                return;
            }
			var idnum = id.substr(7, 1);
			
			
				
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
                    document.getElementById("project"+idnum).innerHTML = xmlhttp.responseText;
                }
            }

	//calling rls.php script with the release name as input to it
			xmlhttp.open("GET", "rls.php?rel=" + rls + "&userName=" + <?php echo "'$_SESSION[username]'" ?>, true);
            xmlhttp.send();		
			

}

function showactname(actn, id, act)
{
	
	
	//activity  dropdown will be kept blank if the project selected is blank.

			
			var idnum = id.substr(7, 1);
			var idname = id.substr(0, 7);
			projname = actn;
			actcd = act;
						
					
			
			if (idname == 'project') 
			{		
			
			    if (actn == "")
				{
                document.getElementById("actname").innerHTML = "";
                return;
				}
			
				
	//xmlhttp object creation
            if (window.XMLHttpRequest) 
			{
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

	//Error Handling if the act.php file is not found
            xmlhttp.onreadystatechange = function(){
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("actname"+idnum).innerHTML = xmlhttp.responseText;
                }
            }
						
	//calling act.php script with the project name as input to it
            xmlhttp.open("GET", "act.php?proj=" + actn + "&userName=" + <?php echo "'$_SESSION[username]'" ?>, true);
            xmlhttp.send();	
			
			}
			
			if (idname == 'actname') 
			{
			
			//task  dropdown will be kept blank if the activity selected is blank.
				if (actn == "")
				{
                document.getElementById("tskname").innerHTML = "";
                return;
				}
			
										
	//xmlhttp object creation
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

	//Error Handling if the act.php file is not found
            xmlhttp.onreadystatechange = function(){
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("tskname"+idnum).innerHTML = xmlhttp.responseText;
                }
            }
			
	//calling act.php script with the project name as input to it
            xmlhttp.open("GET", "tsk.php?proj=" + actn + "&actcd=" + act + "&userName=" + <?php echo "'$_SESSION[username]'" ?>, true);
            xmlhttp.send();	
			}
	
		
}

function showtskname(prj, act, id, task)
{
	
	//Project dropdown will be kept blank if the release selected is blank.
            if (task == "") {
                document.getElementById("taskdetail").innerHTML = "";
                return;
            }
			var idnum = id.substr(7, 1);
			TaskSave = task;
			
			
				
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
                    document.getElementById("taskdetail"+idnum).innerHTML = xmlhttp.responseText;
                }
            }
			

	//calling rls.php script with the release name as input to it
			xmlhttp.open("GET", "tdl.php?proj=" + prj + "&acty=" + act + "&tskcd=" + task + "&userName=" + <?php echo "'$_SESSION[username]'" ?>, true);
            xmlhttp.send();		
		
}


function ShowConsumed(prj, act, task, id, taskdtl)
{
	//alert('in consumed function');

	//Project dropdown will be kept blank if the release selected is blank.
            if (taskdtl == "") {
                document.getElementById("effort"+idnum).innerHTML = "";
                return;
            }
			var idnum = id.substr(10, 1);
			
							
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
                    document.getElementById("effort"+idnum).placeholder = xmlhttp.responseText;
                }
            }
			

	//calling rls.php script with the release name as input to it
			xmlhttp.open("GET", "consumed.php?proj=" + prj + "&acty=" + act + "&tskcd=" + task+ "&tskdtll=" + taskdtl + "&userName=" + <?php echo "'$_SESSION[username]'" ?>, true);
            xmlhttp.send();		
		
}


</script>
</head>
<body onload= showactivitydetails()>

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

<form name = 'activityForm' action="act_db.php" method="POST" >

<br>
<br>

<p> Select date to fetch week activity details </p>
<input type="date" id="weekselect" name="weekselect" align = "center" value ="<?php echo date("Y-m-d");?>" onchange = fetchweekdetails(this.value)> 
<br>
<br>

<div id="tabledetils">
</div>
<button class="submit" type="submit" name="submit"  >Submit</button>
</form>
<button  class="addrow" onclick="myFunction()">Add Row</button>

</body>
</html>

