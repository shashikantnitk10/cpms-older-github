<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="activity_report.css">
</head>
<body >
<?php 
include "database_connect.php";

//echo $date;
$sql="SELECT * from cpms_release";
//echo $sql;
$query=mysqli_query($con,$sql);

$sql="select user_trgm, user_name from cpms_user where user_status='A'";
$userlist=mysqli_query($con,$sql);
?>
<div class="home">
    <a href="next.php">HOME</a>
</div>

<div class="logout">
    <a href="home.PHP">LOGOUT</a>
	<?phpsession_destroy();
	?>
	
</div>
<h1 style="text-align: center;"> RELEASE SUMMARY </h1>
<form action="rls_db.php" method="POST" >

<br>
<br>

<table  id="example" class="display" cellspacing="5" width="100%">
        <thead>
            <tr>
				<th align="left">Code</th>
                <th align="left">Manager</th>
                <th align="left">Start Date</th>
                <th align="left">End Date</th>
				<th align="left">Budget</th>
				<th align="left">Status</th>
				<th align="left">Projects</th>
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
				
				<td><input type="text" id="code" name="code[]" value=<?php echo $row[0]?> ></td>
				<td><input type="text" id="mgr" name="mgr[]" value=<?php echo $row[1]?> ></td>
				<td><input type="date" id="strtdt" name="strtdt[]" value=<?php echo $row[2]?> ></td>
				<td><input type="date" id="enddt" name="enddt[]" value=<?php echo $row[3]?> ></td>
				<td><input type="text" id="budget" name="budget[]" value=<?php echo $row[4]?> ></td>
				<td><input type="text" id="status" name="status[]" value=<?php echo $row[5]?> ></td>
				<td><?php echo "<a href=\"ProjectMaster.php?rls_cd=" .$row[0]. "\"> Projects </a>" ?></td>

            </tr>
		<?php }}
		
			?>
<!--			
			<tr>
                <input type="hidden" id="previous" value=0 name="previous[]">
				<td><input type="text" id="code" name="code[]" placeholder="e.g. V7.2" ></td>
				<td><input type="text" id="mgr" name="mgr[]" placeholder="Full Name" ></td>
				<td><input type="date" id="strtdt" name="strtdt[]" placeholder="Expected Start date" ></td>
				<td><input type="date" id="enddt" name="enddt[]" placeholder="Expected End Date" ></td>
				<td><input type="text" id="budget" name="budget[]" placeholder="Budget" ></td>
				<td><input type="text" id="status" name="status[]" placeholder="A:ACTIVE, C:CLOSE" ></td>

            </tr>			
-->

 </tbody>
    </table>
	
	<button class="submit" type="submit" name="submit"  >Submit</button>
	</form>
	
	<button  class="addrow" onclick="myFunction()">Add Release</button>
	
	
	
	<script>
	
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
	
var list0 = "<input type=\"hidden\" id=\"previous\" value=\"0\" name=\"previous[]\">"
var list1 = "<input type=\"text\" id=\"code\" name=\"code[]\" placeholder=\"e.g. V172\">"
var list2 = "<select id=\"mgr\" name=\"mgr[]\" style=\"width: 55%; text-align: left; height: 22px;padding: 2px 1px;margin: 3px 0;border: 1px solid #ccc;box-sizing: border-box;font-family:\"Verdana\",Arial,Helvetica,sans-serif;\"> <option style=\"text-align: left\">Select Manager </option> <?php while($row = $userlist->fetch_assoc()) { echo "<option value=".$row["user_trgm"].">".$row["user_name"]."</option>"; }  ?> </select>"
var list3 = "<input type=\"date\" id=\"strtdt\" name=\"strtdt[]\" placeholder=\"start date\">"
var list4 = "<input type=\"date\" id=\"enddt\" name=\"enddt[]\" placeholder=\"end date\">"
var list5 = "<input type=\"text\" id=\"budget\" name=\"budget[]\" placeholder=\"initial budget in PDs\">"
var list6 = "<input type=\"text\" id=\"status\" name=\"status[]\" placeholder=\"A (active) / C (closed)\">"
var list7 = "<input type=\"button\" id=\"del\" name=\"del\" value=\"&times\" onclick=\" delrow(this)\">"
					
    cell8.innerHTML = list0;					
    cell1.innerHTML = list1;
    cell2.innerHTML = list2; 
	cell3.innerHTML = list3;
    cell4.innerHTML = list4;
	cell5.innerHTML = list5;
	cell6.innerHTML = list6;
	cell7.innerHTML = list7;
	
}
function delrow(row){

  
  var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('example').deleteRow(i);
  
  /*var table = document.getElementById("example");
    var rowCount = table.rows.length;

    table.deleteRow(rowCount-1);*/
    
     
}


</script>

</body>
</html>
