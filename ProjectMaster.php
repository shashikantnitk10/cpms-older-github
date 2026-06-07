<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="activity_report.css">
</head>
<body >
<?php 
$rlscd=$_GET["rls_cd"];

include "database_connect.php";

//echo $date;
if ($rlscd == "")
{
	$sql="SELECT * from cpms_project";
}
else
{
	$sql="SELECT * from cpms_project where project_release_cd = '$rlscd' ";
}
//echo $sql;
$query=mysqli_query($con,$sql);

$sql1 = "SELECT release_cd FROM cpms_release ";
$release = mysqli_query($con, $sql1);

$sql2 = "SELECT user_trgm,user_name FROM cpms_user where user_status='A'";
$powner = mysqli_query($con, $sql2);



?>
<div class="home" >
    <a href="next.php">HOME</a>
</div>

<div class="logout">
    <a href="home.html">LOGOUT</a>
	<?phpsession_destroy();
	?>
	
</div>

<h1 style="text-align: center;"> PROJECTS SUMMARY </h1>


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
    <a style="color: #003829;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='#003829'" href="ReleaseMaster.php">Releases</a>
</div>


<form action="prj_db.php" method="POST" >

<br>
<br>
<br>
<br>

<table  id="example" class="display" cellspacing="5" width="50%">
        <thead>
            <tr>
				<th align="left">Project</th>
				<th align="left">Release</th>
				<th align="left">Lot</th>
                <th align="left">Proj Owner</th>
				<th align="left">Proj Reviewer</th>
				<th align="left">Onshore Support</th>
				<th align="left">Plan Start Date</th>
				<th align="left">Plan End Date</th>
                <th align="left">Init Budget</th>
				<th align="left">Budget Pre-Int-Ind</th>
				<th align="left">Budget Pre-Int-FR</th>
                <th align="left">Budget Addnl QUAL</th>
				<th align="left">Budget Addnl UAT</th> 
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
				<td><input type="text" id="pname" name="pname[]" value=<?php echo $row["project_cd"]?> ></td>
				<td><input type="text" id="release" name="release[]" value=<?php echo $row["project_release_cd"]?> ></td>
				<td><input type="text" id="lot" name="lot[]" value=<?php echo $row["project_delivery_lot"]?> ></td>
				<td><input type="text" id="powner" name="powner[]" value=<?php echo $row["project_owner"]?> ></td>
				<td><input type="text" id="previewer" name="previewer[]" value=<?php echo $row["project_reviewer"]?> ></td>
				<td><input type="text" id="osupp" name="osupp[]" value=<?php echo $row["project_onshore_supp"]?> ></td>
				<td><input type="text" id="pstdt" name="pstdt[]" value=<?php echo $row["project_start_dt"]?> ></td>
				<td><input type="text" id="penddt" name="penddt[]" value=<?php echo $row["project_end_dt"]?> ></td>
				<td><input type="text" id="inibudget" name="inibudget[]" value=<?php echo $row["project_budget_abacus"]?> ></td>
				<td><input type="text" id="budgetpreinind" name="budgetpreinind[]" value=<?php echo $row["project_pre_int_in"]?> ></td>
				<td><input type="text" id="budgetpreinfr" name="budgetpreinfr[]" value=<?php echo $row["project_pre_int_fr"]?> ></td>
				<td><input type="text" id="budgetaddqual" name="budgetaddqual[]" value=<?php echo $row["project_addnl_qual"]?> ></td>
				<td><input type="text" id="budgetadduat" name="budgetadduat[]" value=<?php echo $row["project_addnl_uat"]?> ></td>
				<td><?php echo "<a href=\"TaskMaster.php?project_cd=" .$row["project_cd"]. "\"> Add Task </a>" ?></td>
            </tr>
				
		<?php }}
		
			?>
<!--			<tr>
                <input type="hidden" id="previous" value="0"  name="previous[]">
				<td><input type="text" id="pname" name="pname[]" placeholder="e.g. VH2FLORI"></td><td><input type="text" id="pname" name="pname[]" placeholder="e.g. VH2FLORI"></td>
				<td><input type="text" id="stloff" name="stloff[]" placeholder="Full Name" ></td>
				<td><input type="text" id="budget" name="budget[]" placeholder="In Person days"></td>
				<td><input type="text" id="stlon" name="stlon[]" placeholder="Full Name"></td>
				<td><input type="button" id="del" name="del" value="&times" onclick="delrow(this)" ></td>
            </tr>

-->

<!-- drop down data -->

 </tbody>
    </table>
	
	<button class="submit" type="submit" name="submit" >Submit</button>
	</form>
	
	<button  class="addrow" onclick="myFunction()">Add Project</button>
		
	
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
	var cell9 = row.insertCell(8);
	var cell10 = row.insertCell(9);
	var cell11 = row.insertCell(10);
	var cell12 = row.insertCell(11);
	var cell13 = row.insertCell(12);
	var cell14 = row.insertCell(13);
	var cell15 = row.insertCell(14);
	
	
var list0 = "<input type=\"hidden\" id=\"previous\" value=\"0\"  name=\"previous[]\">";
var list1 = "<input type=\"text\" id=\"pname\" name=\"pname[]\" placeholder=\"e.g. VH2FLORI\">"
var list2 = "<select id=\"release\" name=\"release[]\" style=\"width: 100%\"> <option> select release </option> <?php $release = mysqli_query($con, $sql1); while($row = $release->fetch_assoc()) { echo"<option  value =".$row["release_cd"]."> ".$row["release_cd"]."</option>";} ?> </select>" ;
var list3 = "<select id=\"lot\" name=\"lot[]\" style=\"width: 100%\"> <option> Select Lot </option> <option> 1 </option> <option> 2 </option> <option> 3 </option> </select>" ;
var list4 = "<select id=\"powner\" name=\"powner[]\" style=\"width: 100%\"> <option> Select Proj owner </option> <?php $powner = mysqli_query($con, $sql2); while($row = $powner->fetch_assoc()) { echo"<option  value =".$row["user_trgm"]."> ".$row["user_name"]."</option>";} ?> </select>" ;
var list5 = "<select id=\"previewer\" name=\"previewer[]\" style=\"width: 100%\"> <option> Select Proj reviewer </option> <?php $powner = mysqli_query($con, $sql2); while($row = $powner->fetch_assoc()) { echo"<option  value =".$row["user_trgm"]."> ".$row["user_name"]."</option>";} ?> </select>" ;
var list6 = "<input type=\"text\" id=\"osupp\" name=\"osupp[]\" placeholder=\"Onshore Support Name\">"
var list7 = "<input type=\"date\" id=\"pstdt\" name=\"pstdt[]\" placeholder=\"dd-mm-yyyy\">"
var list8 = "<input type=\"date\" id=\"penddt\" name=\"penddt[]\" placeholder=\"dd-mm-yyyy\">"
var list9 = "<input type=\"text\" id=\"inibudget\" name=\"inibudget[]\" placeholder=\"Initial Budget in PD\">"
var list10 = "<input type=\"text\" id=\"budgetpreinind\" name=\"budgetpreinind[]\" placeholder=\"Pre-Int-Ind Budget\"value='0.00'>"
var list11 = "<input type=\"text\" id=\"budgetpreinfr\" name=\"budgetpreinfr[]\" placeholder=\"Pre-Int-Fr Budget\" value='0.00'>"
var list12 = "<input type=\"text\" id=\"budgetaddqual\" name=\"budgetaddqual[]\" placeholder=\"Addnl Qual Budget\" value='0.00'>"
var list13 = "<input type=\"text\" id=\"budgetadduat\" name=\"budgetadduat[]\" placeholder=\"Addnl UAT Budget\" value='0.00'>"
var list14 = "<input type=\"button\" id=\"del\" name=\"del\" value=\"&times\" onclick=\" delrow(this)\">"


					
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
	cell11.innerHTML = list11;
	cell12.innerHTML = list12;
	cell13.innerHTML = list13;
	cell14.innerHTML = list14;
	cell15.innerHTML = list0;
	
	
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
