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
//$sql="SELECT * from cpms_release";
//echo $sql;
//$query=mysqli_query($con,$sql);

$sql="select user_trgm, user_name,user_access_typ,user_role,user_status from cpms_user";
$userlist=mysqli_query($con,$sql);
?>
<div class="home">
    <a href="next.php">HOME</a>
</div>

<div class="logout">
    <a href="home.PHP">LOGOUT</a>
	<?php session_destroy();
	?>
	
</div>
<h1 style="text-align: center;"> USER DETAILS </h1>
<form action="usr_db.php" method="POST" >

<br>
<br>

<table  id="example" class="display" cellspacing="5" width="100%">
        <thead>
            <tr>
				<th align="left">Trigram</th>
                <th align="left">Name</th>
                <th align="left">Access Type</th>
                <th align="left">Role</th>
				<th align="left">Status</th>
            </tr>
        </thead>
        <tbody> 
		<?php
		if(mysqli_num_rows($userlist))
		{
		while($row=mysqli_fetch_array($userlist))
		{
			?>
            <tr>
                <input type="hidden" id="previous" value=<?php echo $row[0]?>  name="previous[]">
				
				<td><input type="text" id="trgm" name="trgm[]" value=<?php echo $row[0]?> ></td>
				<td><input type="text" id="name" name="name[]" value=<?php echo $row[1]?> ></td>
				<td><input type="text" id="access_type" name="access_type[]" value=<?php echo $row[2]?> ></td>
				<td><input type="text" id="role" name="role[]" value=<?php echo $row[3]?> ></td>
				<td><input type="text" id="status" name="status[]" value=<?php echo $row[4]?> ></td>

            </tr>
		<?php }}
		
			?>


 </tbody>
    </table>
	
	<button class="submit" type="submit" name="submit"  >Submit</button>
	</form>
	
	<button  class="addrow" onclick="myFunction()">Add User</button>
	
	
	
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

	
var list0 = "<input type=\"hidden\" id=\"previous\" value=\"0\" name=\"previous[]\">"
var list1 = "<input type=\"text\" id=\"trgm\" name=\"trgm[]\" placeholder=\"e.g. NBL\">"
var list2 = "<input type=\"text\" id=\"name\" name=\"name[]\" placeholder=\"User Name\" >"
var list3 = "<select id=\"access_type\" name=\"access_type[]\" style=\"width: 76%; text-align: left; height: 22px;padding: 2px 1px;margin: 3px 0;border: 1px solid #ccc;box-sizing: border-box;font-family:\"Verdana\",Arial,Helvetica,sans-serif;\"><option style=\"text-align: left\">Select Access Type </option> <option value=\"A\">A(Admin)</option><option value=\"U\">U(User)</option></select>"
var list4 = "<input type=\"text\" id=\"role\" name=\"role[]\">"
var list5 = "<select id=\"status\" name=\"status[]\" style=\"width: 76%; text-align: left; height: 22px;padding: 2px 1px;margin: 3px 0;border: 1px solid #ccc;box-sizing: border-box;font-family:\"Verdana\",Arial,Helvetica,sans-serif;\"><option style=\"text-align: left\">Select Status </option> <option value=\"A\">A(Active)</option><option value=\"C\">C(Cancel)</option></select>"
var list6 = "<input type=\"button\" id=\"del\" name=\"del\" value=\"&times\" onclick=\" delrow(this)\">"

					
    cell7.innerHTML = list0;					
    cell1.innerHTML = list1;
    cell2.innerHTML = list2; 
	cell3.innerHTML = list3;
    cell4.innerHTML = list4;
	cell5.innerHTML = list5;
	cell6.innerHTML = list6;

	
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
