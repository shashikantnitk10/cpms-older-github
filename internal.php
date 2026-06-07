<!DOCTYPE html>
<?php session_start()?>
<html>
<head>
<style>

body 
{ 
	overflow: auto;
    white-space: nowrap;
	margin:0; 
	padding:0; 
	font:13px "Lucida Grande", "Lucida Sans Unicode", Helvetica, Arial, sans-serif;
	background-color: white;
}

input[type=text] 
{
	background: transparent url('bg.jpg') no-repeat;
	color : #747862;
	border:0;
	padding:4px 4px;
}

#OnshoreBudget
{	
	font-family:"Lucida Sans Unicode", "Lucida Grande", Sans-Serif;font-size:13px;text-align:left;border-collapse:collapse;margin:10px;
}
#OnshoreBudget th
{
	font-weight:normal;font-size:14px;color:#039;background:#b9c9fe;padding:8px;
}
#OnshoreBudget td
{
	background:#e8edff;border-top:1px solid #fff;color:#669;
}

#OffshoreBudget
{	
	font-family:"Lucida Sans Unicode", "Lucida Grande", Sans-Serif;font-size:13px;text-align:left;border-collapse:collapse;margin:10px;
}
#OffshoreBudget th
{
	font-weight:normal;font-size:14px;color:#039;background:#b9c9fe;padding:8px;
}
#OffshoreBudget td
{
	background:#e8edff;border-top:1px solid #fff;color:#669;padding:3.76px;
}

#Parameters
{	
	font-family:"Lucida Sans Unicode", "Lucida Grande", Sans-Serif;font-size:13px;text-align:left;border-collapse:collapse;margin:10px;
}
#Parameters th
{
	font-weight:normal;font-size:14px;color:#039;background:#b9c9fe;padding:8px;
}
#Parameters td
{
	background:#e8edff;border-top:1px solid #fff;color:#669;padding:8px;
}

#TOTALOnshoreOffshore
{	
	font-family:"Lucida Sans Unicode", "Lucida Grande", Sans-Serif;font-size:13px;text-align:left;border-collapse:collapse;margin:10px;
}
#TOTALOnshoreOffshore th
{
	font-weight:normal;font-size:14px;color:#039;background:#b9c9fe;padding:8px;
}
#TOTALOnshoreOffshore td
{
	background:#e8edff;border-top:1px solid #fff;color:#669;padding:8px;
}

#ProjDelvNumber
{	
	font-family:"Lucida Sans Unicode", "Lucida Grande", Sans-Serif;font-size:13px;text-align:left;border-collapse:collapse;margin:10px;
}
#ProjDelvNumber th
{
	font-weight:normal;font-size:14px;color:#039;background:#b9c9fe;padding:8px;
}
#ProjDelvNumber td
{
	background:#e8edff;border-top:1px solid #fff;color:#669;padding:8px;
}



</style>
</head>
<body >
<?php 

include "database_connect.php";


	$sql="SELECT budget_project_cd, budget_activity_cd,budget_type,budget_budget from cpms_budget where budget_project_cd = 'VH1COUCO' and budget_activity_cd LIKE 'I%' order by budget_activity_cd,budget_type" ;

	
	$sql2="SELECT project_budget_abacus, project_pre_int_in, project_pre_int_fr, project_addnl_qual, project_addnl_uat
			from cpms_project where project_cd = 'VH1COUCO'"; 




//echo $sql;
$query=mysqli_query($con,$sql);
$completedata = array();
while($row=mysqli_fetch_array($query))
		{
			array_push($completedata,$row);
		}
echo "<script> alert('".$completedata[0][3]."');</script>";

$query2=mysqli_query($con,$sql2);
$completedata2 = array();
while($row=mysqli_fetch_array($query2))
		{
			array_push($completedata2,$row);
		}
echo "<script> alert('".$completedata2[0][0]."');</script>";

?>

<table id="Planning" align="center">
	<tr>
		<td rowspan="2">
			<table id="OnshoreBudget"> 
			  <thead>
			  	  <tr>
					<th colspan="8">Onshore Budget</th>
				  </tr>
			  </thead>
			  <tr>
				<th>Phase</th>
				<th>Level</th>
				<th>Task Code</th>
				<th>Description</th>
				<th>Sold budget</th>
				<th>Indicative budget</th>
				<th>Consumed</th>
				<th>Real budget</th>
			  </tr>
			  <!-- Data for upstream -->
			  <tr>
				<th rowspan="3">Upstream</th>
				<td>Project</td>
				<td>xF10A</td>
				<td>FR- Upstream Assistance</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
				</tr>
				
			  <tr>
				<td>Project</td>
				<td>xF10T</td>
				<td>Fr - Upstream Other Tasks + Transl.</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			  
			  <tr>
				<td>Project</td>
				<td>XF10R</td>
				<td>Fr - Upstream Review</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			  <!-- Data for development -->
			  <tr>
				<th rowspan="4">Development</th>
				<td>Project</td>
				<td>xF14A</td>
				<td>Fr - Param Acceptance Assistance</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
				
			  <tr>
				<td>Project</td>
				<td>xF30A</td>
				<td>Fr - CUT Assistance</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			  
			  <tr>
				<td>Project</td>
				<td>xF30T</td>
				<td>Fr - CUT Other Tasks + Transl.</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			  
			  <tr>
				<td>Project</td>
				<td>xF30R</td>
				<td>Fr - CUT review</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>

			  <!-- Data for qualification -->
			  <tr>
				<th rowspan="3">Qualification</th>
				<td>Project</td>
				<td>xF50A</td>
				<td>Fr - Qualification Assistance</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
				
			  <tr>
				<td>Project</td>
				<td>xF50T</td>
				<td>Fr - Qualification Other Tasks + Transl.</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			  
			  <tr>
				<td>Project</td>
				<td>xF50R</td>
				<td>Fr - Qualification Review</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>

			  <!-- Data for Pre-integration -->
			  <tr>
				<th>Pre-integration</th>
				<td>Project</td>
				<td>xF600</td>
				<td>Fr - Pre-intergration (xnet)</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>

			  <!-- Data for Acceptance testing -->
			  <tr>
				<th rowspan="4">Acceptance testing</th>
				<td>Project</td>
				<td>xF70A</td>
				<td>Fr - Acceptance testing Assistance</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
				
			  <tr>
				<td>Project</td>
				<td>xF70R</td>
				<td>Fr - Acceptance testing Review</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			  
			  <tr>
				<td>Project</td>
				<td>xF70T</td>
				<td>Fr - Acceptance testing Other Tasks + Transl.</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			  
			  <tr>
				<td>Project</td>
				<td>xF71R</td>
				<td>Fr - Documentation Review</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			  
			  <!-- Data for Management -->
			  <tr>
				<th>Management</th>
				<td>Project</td>
				<td>xF130</td>
				<td>Fr - Project Leader</td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			 
			  <!-- Data for Transversal -->
			  <tr>
				<th rowspan="5">Transversal</th>
				<td>Version</td>
				<td></td>
				<td>Global Project Manager</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			  </tr>
				
			  <tr>
				<td>Version</td>
				<td></td>
				<td>Project Manager</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			  </tr>
			  
			  <tr>
				<td>Version</td>
				<td></td>
				<td>Test Manager</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			  </tr>
			  
			  <tr>
				<td>Version</td>
				<td></td>
				<td>Deployment</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			  </tr>

			  <tr>
				<td>Version</td>
				<td></td>
				<td>Technical Support</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			  </tr>
			  <tfoot>			  
				  <tr>
					<th></th>
					<th></th>
					<th></th>
					<th>Total</th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				  </tr>
			  </tfoot>				
			</table>
		</td>
		<td rowspan="2">
			<table id="OffshoreBudget">
			  <thead>
				  <tr>
					<th colspan="5">Offshore Budget</th>
				  </tr>
			  </thead>
			  <tr>
				<th>Task Code</th>
				<th>Description</th>
				<th>Sold budget</th>
				<th>Indicative budget</th>
				<th>Real budget</th>
			  </tr>
			  
			  <tr>
				<td>xI101</td>
				<td>In - Project presentation</td>
				<td><?php echo $completedata[1][3]?></td>
				<td><?php echo $completedata[0][3]?></td>
				<td contenteditable='true'><?php echo $completedata[2][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI102</td>
				<td>In - Acceptance preparation</td>
				<td><?php echo $completedata[4][3]?></td>
				<td><?php echo $completedata[3][3]?></td>
				<td contenteditable='true'><?php echo $completedata[5][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI105</td>
				<td>In - SFD Acceptance</td>
				<td><?php echo $completedata[7][3]+ $completedata[10][3]+ $completedata[13][3]?></td>
				<td><?php echo $completedata[6][3]+ $completedata[9][3]+ $completedata[12][3]?></td>
				<td contenteditable='true'><?php echo $completedata[8][3] + $completedata[11][3]+ $completedata[14][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI106</td>
				<td>In - SMT Acceptance</td>
				<td><?php echo $completedata[16][3]+ $completedata[19][3]+ $completedata[22][3]?></td>
				<td><?php echo $completedata[15][3]+ $completedata[18][3]+ $completedata[21][3]?></td>
				<td contenteditable='true'><?php echo $completedata[17][3]+ $completedata[20][3]+ $completedata[23][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI108</td>
				<td>In - Doing development sheet</td>
				<td><?php echo $completedata[25][3]+ $completedata[28][3]+ $completedata[31][3]?></td>
				<td><?php echo $completedata[24][3]+ $completedata[27][3]+ $completedata[30][3]?></td>
				<td contenteditable='true'><?php echo $completedata[26][3]+ $completedata[29][3]+ $completedata[32][3]?></td>
			  </tr>
				
			  <tr>
				<td>xI140</td>
				<td>In - Param Acceptance</td>
				<td><?php echo $completedata[37][3]?></td>
				<td><?php echo $completedata[36][3]?></td>
				<td contenteditable='true'><?php echo $completedata[38][3]?></td>
			  </tr>
			   
			  <tr>
				<td>xI3**</td>
				<td>In - CUT</td>
				<td><?php echo $completedata[40][3]+ $completedata[43][3]+ $completedata[46][3]+$completedata[49][3]+ $completedata[52][3]+ $completedata[55][3]?></td>
				<td><?php echo $completedata[39][3]+ $completedata[42][3]+ $completedata[45][3]+$completedata[48][3]+ $completedata[51][3]+ $completedata[54][3]?></td>
				<td contenteditable='true'><?php echo $completedata[41][3]+ $completedata[44][3]+ $completedata[47][3]+$completedata[50][3]+ $completedata[53][3]+ $completedata[56][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI500</td>
				<td>In - Qualification</td>
				<td><?php echo $completedata[58][3]?></td>
				<td><?php echo $completedata[57][3]?></td>
				<td contenteditable='true'><?php echo $completedata[59][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI501</td>
				<td>In - Qualification defect fixing</td>
				<td><?php echo $completedata[61][3]?></td>
				<td><?php echo $completedata[60][3]?></td>
				<td contenteditable='true'><?php echo $completedata[62][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI600</td>
				<td>In - Pre-intergration (xnet)</td>
				<td><?php echo $completedata[64][3]?></td>
				<td><?php echo $completedata[63][3]?></td>
				<td contenteditable='true'><?php echo $completedata[65][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI700</td>
				<td>In - Acceptance testing (Analyse)</td>
				<td><?php echo $completedata[67][3]?></td>
				<td><?php echo $completedata[66][3]?></td>
				<td contenteditable='true'><?php echo $completedata[68][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI701</td>
				<td>In - Acceptance testing (Bug)</td>
				<td><?php echo $completedata[70][3]?></td>
				<td><?php echo $completedata[69][3]?></td>
				<td contenteditable='true'><?php echo $completedata[71][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI702</td>
				<td>In - Acceptance testing (Changes)</td>
				<td><?php echo $completedata[73][3]?></td>
				<td><?php echo $completedata[72][3]?></td>
				<td contenteditable='true'><?php echo $completedata[74][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI710</td>
				<td>In - Documentation</td>
				<td><?php echo $completedata[76][3]?></td>
				<td><?php echo $completedata[74][3]?></td>
				<td contenteditable='true'><?php echo $completedata[77][3]?></td>
			  </tr>
			  
			  <tr>
				<td>xI130</td>
				<td>In - Project Leader</td>
				<td><?php echo $completedata[34][3]?></td>
				<td><?php echo $completedata[33][3]?></td>
				<td contenteditable='true'><?php echo $completedata[35][3]?></td>
			  </tr>
			  
			  <tr>
				<td>0I002</td>
				<td>Project Manager Off Team</td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			  
			  <tr>
				<td>0I003</td>
				<td>Project Management Effort Off Team</td>
				<td></td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			  
			  <tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			  </tr>
			  
			  <tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			  </tr>
			  
			  <tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			  </tr>
			  <tfoot>
				  <tr>
					<th></th>
					<th>Total</th>
					<td></td>
					<td></td>
					<td></td>

				  </tr>
			  </tfoot>			  
			</table>
		</td>
		<td>
			<table id="Parameters">
			  <thead>
				  <tr>
					<th colspan="3">Parameters</th>
				  </tr>
			  </thead>
			  <tr>
				<td>Project Type
					1 : Offshore involves from SFDI Acceptance
					2 : Offshore involves from Dev Sheet creation
					3 : Offshore involves from CUT
				</td>
				<td></td>
				<td><input type="text"></td>
			  </tr>
			  
			  <tr>
				<th>Global Budget with PPR</th>
				<td></td>
				<td><?php echo $completedata2[0][0]+$completedata2[0][3]+$completedata2[0][4] ?></td>
			  </tr>
			  
			  <tr>
				<th>Global Budget without PPR</th>
				<td></td>
				<td><?php echo ($completedata2[0][0]+$completedata2[0][3]+$completedata2[0][4])*0.9 ?></td>
			  </tr>
			  
			  <tr>
				<td>Global Budget with PPR (Abacus ; sold to CAAGIS)</td>
				<td></td>
				<td><?php echo $completedata2[0][0] ?></td>
			  </tr>
			  
			  <tr>
				<td>Global Budget without PPR</td>
				<td></td>
				<td><?php echo $completedata2[0][0]*0.9 ?></td>
			  </tr>
			  
			  <tr>
				<td>Pre-integration budget to extract (negative)</td>
				<td></td>
				<td><?php echo ($completedata2[0][1]+$completedata2[0][2])* (-1*0.9) ?></td>
			  </tr>
			  
			  <tr>
				<td>Global budget after Pre-integration budget</td>
				<td></td>
				<td><?php echo (($completedata2[0][1]+$completedata2[0][2])* (-1*0.9)) + ($completedata2[0][0]*0.9) ?></td>
			  </tr>
			  
			  <tr>
				<td>Fr - Pre-intergration (xnet) - PPR include</td>
				<td></td>
				<td><?php echo $completedata2[0][1] ?></td>
			  </tr>
			  
			  <tr>
				<td>In - Pre-intergration (xnet) - PPR include</td>
				<td></td>
				<td><?php echo $completedata2[0][2] ?></td>
			  </tr>
			  
			  <tr>
				<td>Budget for Additional qualification test plan with PPR</td>
				<td></td>
				<td><?php echo $completedata2[0][3] ?></td>
			  </tr>
			  
			  <tr>
				<td>Budget for acceptance testing changes with PPR</td>
				<td></td>
				<td><?php echo $completedata2[0][4] ?></td>
			  </tr>
			  
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table id="ProjDelvNumber">

			  <tr>
				<th>Project/Delivery/QA Number</th>
				<th>Lot</th>
				<th>Budget Sold</th>
				<th>Qual Test Budget</th>
				<th>Xnet Pre</th>
			  </tr>
			  
			  <tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			  </tr>

			</table>
		</td>
	</tr>
	<tr>
		<td colspan = "2">
			<table id="TOTALOnshoreOffshore">
			  <tr>
				<th>TOTAL Onshore + Offshore</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			  </tr>
			</table>
		</td>
		<td></td>
	</tr>
</table>



  


<!-- Value distribution as per global budget sold to CAAS-->

<script>

var x = 0
var u = 0
var zs = 0
var zi = 0
var zr = 0
var zr2 = 0
var zr3 = 0
var zr4 = 0
var zr5 = 0
var zr6 = 0
var zr7 = 0
var zr8 = 0
var zr9 = 0
var zr10 = 0
var zr11 = 0
var zr12 = 0
var zr13 = 0
var zr14 = 0
var zr15 = 0
var zr16 = 0
var zr17 = 0
var zr18 = 0
var zr19 = 0
var zr20 = 0
var zr21 = 0
var zr22 = 0
</script>

<script>
var x = document.getElementById("Parameters").rows[4].cells[2].innerHTML;
var x = x-0;
</script>

<script>
var u = document.getElementById("Parameters").rows[8].cells[2].innerHTML;
</script>

<!-- Fr - Upstream Assistance -->

<script>
var y = 0.0126;
var zs2 = x * y;
document.getElementById("OnshoreBudget").rows[2].cells[4].innerHTML = zs2;
</script>

<script>
var y = 0.0277;
var zi2 = x * y;
document.getElementById("OnshoreBudget").rows[2].cells[5].innerHTML = zi2;
</script>

<!--Fr - Upstream Other Tasks + Transl. -->

<script>
var y = 0.0025;
var zs3 = x * y;
document.getElementById("OnshoreBudget").rows[3].cells[3].innerHTML = zs3;
</script>

<script>
var y = 0.0057;
var zi3 = x * y;
document.getElementById("OnshoreBudget").rows[3].cells[4].innerHTML = zi3;
</script>

<!--Fr - Upstream Review -->

<script>
var y = 0.0059;
var zs4 = x * y;
document.getElementById("OnshoreBudget").rows[4].cells[3].innerHTML = zs4;
</script>

<script>
var y = 0.0128;
var zi4 = x * y;
document.getElementById("OnshoreBudget").rows[4].cells[4].innerHTML = zi4;
</script>

<!--Fr - Param Acceptance Assistance -->

<script>
var y = 0.0;
var zs5 = x * y;
document.getElementById("OnshoreBudget").rows[5].cells[4].innerHTML = zs5;
</script>

<script>
var y = 0.001;
var zi5 = x * y;
document.getElementById("OnshoreBudget").rows[5].cells[5].innerHTML = zi5;
</script>

<!--Fr - CUT Assistance -->

<script>
var y = 0.0144;
var zs6 = x * y;
document.getElementById("OnshoreBudget").rows[6].cells[3].innerHTML = zs6;
</script>

<script>
var y = 0.0168;
var zi6 = x * y;
document.getElementById("OnshoreBudget").rows[6].cells[4].innerHTML = zi6;
</script>

<!--Fr - CUT Other Tasks + Transl. -->

<script>
var y = 0.0055;
var zs7 = x * y;
document.getElementById("OnshoreBudget").rows[7].cells[3].innerHTML = zs7;
</script>

<script>
var y = 0.0075;
var zi7 = x * y;
document.getElementById("OnshoreBudget").rows[7].cells[4].innerHTML = zi7;
</script>

<!--Fr - CUT review -->

<script>
var y = 0.0336;
var zs8 = x * y;
document.getElementById("OnshoreBudget").rows[8].cells[3].innerHTML = zs8;
</script>

<script>
var y = 0.0392;
var zi8 = x * y;
document.getElementById("OnshoreBudget").rows[8].cells[4].innerHTML = zi8;
</script>

<!-- Fr - Qualification Assistance -->

<script>
var y = 0.0054;
var zs9 = x * y;
document.getElementById("OnshoreBudget").rows[9].cells[4].innerHTML = zs9;
</script>

<script>
var y = 0.0113;
var zi9 = x * y;
document.getElementById("OnshoreBudget").rows[9].cells[5].innerHTML = zi9;
</script>

<!-- Fr - Qualification Other Tasks + Transl.-->

<script>
var y = 0.0043;
var zs10 = x * y;
document.getElementById("OnshoreBudget").rows[10].cells[3].innerHTML = zs10;
</script>

<script>
var y = 0.0090;
var zi10 = x * y;
document.getElementById("OnshoreBudget").rows[10].cells[4].innerHTML = zi10;
</script>

<!--Fr - Qualification Review -->

<script>
var y = 0.0119;
var zs11 = x * y;
document.getElementById("OnshoreBudget").rows[11].cells[3].innerHTML = zs11;
</script>

<script>
var y = 0.0248;
var zi11 = x * y;
document.getElementById("OnshoreBudget").rows[11].cells[4].innerHTML = zi11;
</script>

<!-- Fr - Pre-intergration (xnet) -->

<script>
var y = 0.9;
var zs12 = u * y;
document.getElementById("OnshoreBudget").rows[12].cells[4].innerHTML = zs12;
</script>

<script>
var y = 0.9;
var zi12 = u * y;
document.getElementById("OnshoreBudget").rows[12].cells[5].innerHTML = zi12;
</script>

<!-- Fr - Acceptance testing Assistance -->

<script>
var y = 0.0086;
var zs13 = x * y;
document.getElementById("OnshoreBudget").rows[13].cells[4].innerHTML = zs13;
</script>

<script>
var y = 0.0203;
var zi13 = x * y;
document.getElementById("OnshoreBudget").rows[13].cells[5].innerHTML = zi13;
</script>

<!-- Fr - Acceptance testing Review -->

<script>
var y = 0.0173;
var zs14 = x * y;
document.getElementById("OnshoreBudget").rows[14].cells[3].innerHTML = zs14;
</script>

<script>
var y = 0.0405;
var zi14 = x * y;
document.getElementById("OnshoreBudget").rows[14].cells[4].innerHTML = zi14;
</script>

<!-- Fr - Acceptance testing Other Tasks + Transl. -->

<script>
var y = 0.0029;
var zs15 = x * y;
document.getElementById("OnshoreBudget").rows[15].cells[3].innerHTML = zs15;
</script>

<script>
var y = 0.0068;
var zi15 = x * y;
document.getElementById("OnshoreBudget").rows[15].cells[4].innerHTML = zi15;
</script>

<!-- Fr - Documentation Review -->

<script>
var y = 0.0054;
var zs16 = x * y;
document.getElementById("OnshoreBudget").rows[16].cells[3].innerHTML = zs16;
</script>

<script>
var y = 0.0064;
var zi16 = x * y;
document.getElementById("OnshoreBudget").rows[16].cells[4].innerHTML = zi16;
</script>

<!-- Fr - Project Leader -->

<script>
var y = 0.0;
var zs17 = x * y;
document.getElementById("OnshoreBudget").rows[17].cells[4].innerHTML = zs17;
</script>

<script>
var y = 0.0;
var zi17 = x * y;
document.getElementById("OnshoreBudget").rows[17].cells[5].innerHTML = zi17;
</script>

<!-- Global Project Manager -->

<script>
var y = 0.0216;
var zs18 = x * y;
document.getElementById("OnshoreBudget").rows[18].cells[4].innerHTML = zs18;
</script>

<script>
var y = 0.0285;
var zi18 = x * y;
document.getElementById("OnshoreBudget").rows[18].cells[5].innerHTML = zi18;
</script>

<script>
var y = 0.0285;
var zr18 = x * y;
document.getElementById("OnshoreBudget").rows[18].cells[7].innerHTML = zr18;
</script>

<!-- Project Manager -->

<script>
var y = 0.0584;
var zs19 = x * y;
document.getElementById("OnshoreBudget").rows[19].cells[3].innerHTML = zs19;
</script>

<script>
var y = 0.0665;
var zi19 = x * y;
document.getElementById("OnshoreBudget").rows[19].cells[4].innerHTML = zi19;
</script>

<script>
var y = 0.0665;
var zr19 = x * y;
document.getElementById("OnshoreBudget").rows[19].cells[6].innerHTML = zr19;
</script>

<!-- Test Manager -->

<script>
var y = 0.0132;
var zs20 = x * y;
document.getElementById("OnshoreBudget").rows[20].cells[3].innerHTML = zs20;
</script>

<script>
var y = 0.0182;
var zi20 = x * y;
document.getElementById("OnshoreBudget").rows[20].cells[4].innerHTML = zi20;
</script>

<script>
var y = 0.0182;
var zr20 = x * y;
document.getElementById("OnshoreBudget").rows[20].cells[6].innerHTML = zr20;
</script>

<!-- Deployment -->

<script>
var y = 0.0090;
var zs21 = x * y;
document.getElementById("OnshoreBudget").rows[21].cells[3].innerHTML = zs21;
</script>

<script>
var y = 0.0090;
var zi21 = x * y;
document.getElementById("OnshoreBudget").rows[21].cells[4].innerHTML = zi21;
</script>

<script>
var y = 0.0090;
var zr21 = x * y;
document.getElementById("OnshoreBudget").rows[21].cells[6].innerHTML = zr21;
</script>



<!-- Technical Support -->

<script>
var y = 0.0250;
var zs22 = x * y;
document.getElementById("OnshoreBudget").rows[22].cells[3].innerHTML = zs22;
</script>

<script>
var y = 0.0260;
var zi22 = x * y;
document.getElementById("OnshoreBudget").rows[22].cells[4].innerHTML = zi22;
</script>

<script>
var y = 0.0260;
var zr22 = x * y;
document.getElementById("OnshoreBudget").rows[22].cells[6].innerHTML = zr22;
</script>

<!-- Total Sold budget-->

<script>
var zs = zs2+zs3+zs4+zs5+zs6+zs7+zs8+zs9+zs10+zs11+zs12+zs13+zs14+zs15+zs16+zs17+zs18+zs19+zs20+zs21+zs22;
document.getElementById("OnshoreBudget").rows[23].cells[4].innerHTML = zs;
</script>

<!-- Total Indicative budget-->

<script>
var zi= zi2+zi3+zi4+zi5+zi6+zi7+zi8+zi9+zi10+zi11+zi12+zi13+zi14+zi15+zi16+zi17+zi18+zi19+zi20+zi21+zi22;
document.getElementById("OnshoreBudget").rows[23].cells[5].innerHTML = zi;
</script>

<!-- Total Real budget-->

<script>
var zr= zr2+zr3+zr4+zr5+zr6+zr7+zr8+zr9+zr10+zr11+zr12+zr13+zr14+zr15+zr16+zr17+zr18+zr19+zr20+zr21+zr22;
document.getElementById("OnshoreBudget").rows[23].cells[7].innerHTML = zr;
</script>

<!-- offshore budget -->

</body>
</html>
