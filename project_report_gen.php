<html>
<head>
<style>


table, td {
    border: 1px solid black;
}

thead th {
	border: 1px solid white;
}
table{
	border-collapse:collapse;
	text-align:center;
}
th{
	height:50px;
	color:white;
	text-align:center;
	background-color:#005e51;
}
tr:hover 
{
	background-color: #afffea		
}

.addrow{
	width:100px;
	height:30px;
	margin:10px;
	padding:5px;
	color:white;
	
	background: radial-gradient(circle,#4CAF50,#e7fff9,#4CAF50); /* Standard syntax (must be last) */
	font-weight:bold;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	
}
.addrow:hover{
	background: radial-gradient(circle,red,#e7fff9,#4CAF50); /* Standard syntax (must be last) */
	color:black;
	box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

.addrow2{
	width:100px;
	height:30px;
	margin:10px;
	padding:5px;
	color:white;
	
	background: radial-gradient(circle,#4CAF50,#e7fff9,#4CAF50); /* Standard syntax (must be last) */
	font-weight:bold;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
	
}
.addrow2:hover{
	background: radial-gradient(circle,red,#e7fff9,#4CAF50); /* Standard syntax (must be last) */
	color:black;
	box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}


body {font-family: Verdana,sans-serif;background-color:#e7fff9}

select{
	width:200px;
	height:30px;
	margin-top:20px;
	margin-left:450px;
	border: 2px solid black;
	font-weight:bold;
	border-radius:5px;
	background-color:#DCDCDC;
	
}
select option{
	border: 2px solid black;
	font-weight:bold;
	border-radius:5px;
}


#myInput, #myInput1, #myInput2, #myInput3, #myInput4,#myInput5, #myInput6, #myInput7{
	width:145px;
	height:30px;
	padding-left:25px;
	margin-top:20px;
	margin-left:5px;
	border:2px solid black;
	border-radius:4px;
	background-color:#DCDCDC;
	background-image: url('search.png'); 
	background-size:20px 20px;
	
    background-position: 5px 4px; 
    background-repeat: no-repeat; 
}

.home a {
	
	position:absolute;
	top:25px;
	left:10px;
    border-bottom: 1px solid #777777;
    border-left: 1px solid #000000;
    border-right: 1px solid #333333;
    border-top: 1px solid #000000;
    text-align:center;
	font-weight:bold;
	text-decoration:none;
	color:white;
	background-color:#00664b;
    display: block;
    height: 20px;
	width:80px;
    padding: 3px;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);         
}
.home a:hover{
	background-color:red;
	color:white;
	box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
	
}

.logout a {
	
	position:absolute;
	top:25px;
	left:1250px;
    border-bottom: 1px solid #777777;
    border-left: 1px solid #000000;
    border-right: 1px solid #333333;
    border-top: 1px solid #000000;
    text-align:center;
	font-weight:bold;
	text-decoration:none;
	color:white;
	background-color:red;
    display: block;
    height: 20px;
	width:80px;
    padding: 3px;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);         
}
.logout a:hover{
	background-color:#00664b;
	color:white;
	box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
	
}


</style>
</head>
<body>
<div class="home">
    <a href="next.php">HOME</a>
</div>

<div class="logout">
    <a href="home.html">LOGOUT</a>
	<?phpsession_destroy();
	?>
	
</div>

<h1 style="text-align: center;"> PROJECTS SUMMARY </h1>
<br>
<br>
<br>
<br>
<?php

include "database_connect.php";

$sql = "SELECT * FROM cpms_project";
$result = mysqli_query($con, $sql);?>
<table id="report">
<?php
if ($result->num_rows > 0) {
	?>
    <tr><th>Project</th><th>Lot</th><th>Owner</th><th>Reviewer</th><th>SFDI Status</th>
	<th>Estimated Dt for Accpt Report</th><th>Onshore Supp</th><th>CAAS Estimation</th>
	<th>Budget wo PPR</th><th>Onshore Indic. Budget</th><th>Change Request Budget(25%)</th><th>Offhore Indic. Budget</th>
	<th>Change Request Budget(75%)</th><th>Acc/Des/CUT</th><th>QUALIF</th><th>UAT/Doc</th><th>Mgmt Efforts</th>
	<th>Remarks</th><th>Budgeted</th><th>Actual</th><th>Release NIT</th><th>RAE</th><th>Efficiency</th>
	<th>Project NIT - Environment</th><th>Project NIT - Param</th><th>Project NIT - Cross-project impact</th><th>Project Idle</th></tr>
    <?php
	// output data of each row
    while($row = $result->fetch_assoc()) {
		
		
		?>
		
        <tr class="myrow">
			<td><?php echo $row["project_cd"];?></td>
			<td><?php echo $row["project_delivery_lot"];?></td>
			<td><?php echo $row["project_owner"];?></td>
			<td><?php echo $row["project_reviewer"];?></td>
			<td><?php echo "Not Accepted";?></td>
			<td><?php echo "NA";?></td>
			<td><?php echo $row["project_onshore_supp"];?></td>
			<td><?php echo "0.00";?></td>
			<td><?php echo "0.00";?></td>	
			<td><?php echo $row["project_pre_int_in"];?></td>
			<td><?php echo "25%";?></td>
			<td><?php echo $row["project_pre_int_fr"];?></td>
			<td><?php echo "75%";?></td>
			<td><?php echo "0.00";?></td>	
			<td><?php echo "0.00";?></td>	
			<td><?php echo "0.00";?></td>	
			<td><?php echo "0.00";?></td>	
			<td><?php echo "Not started";?></td>	
			<td><?php echo $row["project_budget_abacus"];?></td>
			<td><?php echo "0.00";?></td>	
			<td><?php echo "0.00";?></td>	
			<td><?php echo "0.00";?></td>	
			<td><?php echo "100%";?></td>	
			<td><?php echo "0.00";?></td>	
			<td><?php echo "0.00";?></td>	
			<td><?php echo "0.00";?></td>	
			<td><?php echo "0.00";?></td>	
	
			<td class="addrow"><?php echo "<a href=\"Schedule.php?project_cd=" .$row["project_cd"]. "\"> Schedule </a>" ?></td>
			<td class="addrow2" ><a href="internal.php"> Internal Budget </a></td>
			
			
		</tr>
		<?php 
    }
	?>
   </table>
   <?php
} else {
    echo "0 results";
}
$con->close();
?>

</body>
</html>