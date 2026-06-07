<?php
session_start();
include "database_connect.php";
require 'Classes/PHPExcel/IOFactory.php';

$previous=$_POST['previous'];
$pname=$_POST['pname'];
$release=$_POST['release'];
$lot=$_POST['lot'];
$powner=$_POST['powner'];
$previewer=$_POST['previewer'];
$osupp=$_POST['osupp'];
$pstdt=$_POST['pstdt'];
$penddt=$_POST['penddt'];
$inibudget=$_POST['inibudget'];
$budgetpreinind=$_POST['budgetpreinind'];
$budgetpreinfr=$_POST['budgetpreinfr'];
$budgetaddqual=$_POST['budgetaddqual'];
$budgetadduat=$_POST['budgetadduat'];

$len=count($pname);

$activities= array(
array("ACT001","ACT002","ACT003","ACT004"),
array("ACT005","ACT006","ACT007","ACT008"),
array("ACT010","ACT011","ACT012","ACT013"),
array("ACT014","ACT015","ACT016","ACT017"),
array("ACT018","ACT019","ACT020"),
array("ACT021","ACT022"),
);

for($i=0;$i<$len;$i++)
{
	if($previous[$i]=="0")
	{
		
$sql=  "INSERT INTO cpms_project(project_cd , project_release_cd , project_delivery_lot , project_owner , project_reviewer ,
        project_onshore_supp , project_start_dt , project_end_dt , project_budget_abacus , project_pre_int_in , project_pre_int_fr ,
		project_addnl_qual , project_addnl_uat) values('$pname[$i]','$release[$i]','$lot[$i]','$powner[$i]','$previewer[$i]','$osupp[$i]','$pstdt[$i]','$penddt[$i]',
		'$inibudget[$i]','$budgetpreinind[$i]','$budgetpreinfr[$i]','$budgetaddqual[$i]','$budgetadduat[$i]')";

		
	$inputfilename = 'InternalBudget.xlsx';
	$exceldata = array();

try
{
    $inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
    $objReader = PHPExcel_IOFactory::createReader($inputfiletype);
    $objPHPExcel = $objReader->load($inputfilename);
	}
catch(Exception $e)
{
   die('Error loading file "'.pathinfo($inputfilename,PATHINFO_BASENAME).'": '.$e->getMessage());
}


 //Change the file
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('R6', $inibudget[$i])
			->setCellValue('R12', $budgetpreinfr[$i])
			->setCellValue('R13', $budgetpreinind[$i])
			->setCellValue('R16', $budgetaddqual[$i])
            ->setCellValue('R18', $budgetadduat[$i]);    
	


 //Write the file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $inputfiletype);
$objWriter->save($inputfilename);
		
	if(mysqli_query($con,$sql))
	{
		$activity_location = 'In';
		$sql_activity  = "SELECT activity_cd,activity_name,activity_main_cd from cpms_activity where activity_loc = '$activity_location' order by activity_cd";
		$result_activities = mysqli_query($con,$sql_activity);
		while($row=mysqli_fetch_array($result_activities))
		{
			if($row['activity_main_cd'] ==null)
			{
				$mainactivity = $row['activity_cd'];
			}
			else if($row['activity_main_cd'] = $mainactivity)
			{
				
				$subactivity = $row['activity_cd'];
				$Sql_create_activity = "INSERT INTO cpms_task(task_project_id, task_iteration, task_activity_cd,task_name,task_owner) values ('$pname[$i]','C1','$mainactivity','$subactivity','$powner[$i]')";
				mysqli_query($con,$Sql_create_activity);
				
			}			
     }
      try
      {
		$inputfilename = 'InternalBudget.xlsx';
		$inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
		$objReader = PHPExcel_IOFactory::createReader($inputfiletype);
		$objPHPExcel = $objReader->load($inputfilename);
		$sheet = $objPHPExcel->getSheet(1); 
		$multifactor80 = 0.8;
		$multifactor10 = 0.1;
		$multifactor48 = 0.48;
		$multifactor32 = 0.32;
		$multifactor06 = 0.06;
		$multifactor04 = 0.04;
		$multifactor90 = 0.9;
		$rowData = $sheet->rangeToArray('K4:M26', NULL, TRUE, FALSE);
		echo"<script> alert('".$rowData[0][0]."');</script>";
		//$insert_budget = "INSERT INTO cpms_budget (budget_project_cd, budget_activity_cd,budget_type,budget_budget)
		//	VALUES ('$pname[$i]', 'I1011', 'Sold','".$rowData[0][0]."'),('$pname[$i]', 'I1011', 'Indicative','".$rowData[0][1]."'),('$pname[$i]', 'I1011', //'Real','".$rowData[0][0]."')";
		$insert_budget = "INSERT INTO cpms_budget (budget_project_cd, budget_activity_cd,budget_type,budget_budget)
			VALUES ('$pname[$i]', 'I1011', 'Sold','".$rowData[0][0]."'),
			       ('$pname[$i]', 'I1011', 'Indicative','".$rowData[0][1]."'),
			       ('$pname[$i]', 'I1011', 'Real','".$rowData[0][0]."'),
				   
				   ('$pname[$i]', 'I1021', 'Sold','".$rowData[1][0]."'),
			       ('$pname[$i]', 'I1021', 'Indicative','".$rowData[1][1]."'),
			       ('$pname[$i]', 'I1021', 'Real','".$rowData[1][0]."'),
				   
				   ('$pname[$i]', 'I1051', 'Sold','".$rowData[2][0]*$multifactor80."'),
			       ('$pname[$i]', 'I1051', 'Indicative','".$rowData[2][1]*$multifactor80."'),
			       ('$pname[$i]', 'I1051', 'Real','".$rowData[2][0]*$multifactor80."'),
				   
				   ('$pname[$i]', 'I1052', 'Sold','".$rowData[2][0]*$multifactor10."'),
			       ('$pname[$i]', 'I1052', 'Indicative','".$rowData[2][1]*$multifactor10."'),
			       ('$pname[$i]', 'I1052', 'Real','".$rowData[2][0]*$multifactor10."'),
				    
				   ('$pname[$i]', 'I1053', 'Sold','".$rowData[2][0]*$multifactor10."'),
			       ('$pname[$i]', 'I1053', 'Indicative','".$rowData[2][1]*$multifactor10."'),
			       ('$pname[$i]', 'I1053', 'Real','".$rowData[2][0]*$multifactor10."'),
				   
				   ('$pname[$i]', 'I1061', 'Sold','".$rowData[3][0]*$multifactor80."'),
			       ('$pname[$i]', 'I1061', 'Indicative','".$rowData[3][1]*$multifactor80."'),
			       ('$pname[$i]', 'I1061', 'Real','".$rowData[3][0]*$multifactor80."'),
				   
				   ('$pname[$i]', 'I1062', 'Sold','".$rowData[3][0]*$multifactor10."'),
			       ('$pname[$i]', 'I1062', 'Indicative','".$rowData[3][1]*$multifactor10."'),
			       ('$pname[$i]', 'I1062', 'Real','".$rowData[3][0]*$multifactor10."'),
				    
				   ('$pname[$i]', 'I1063', 'Sold','".$rowData[3][0]*$multifactor10."'),
			       ('$pname[$i]', 'I1063', 'Indicative','".$rowData[3][1]*$multifactor10."'),
			       ('$pname[$i]', 'I1063', 'Real','".$rowData[3][0]*$multifactor10."'),
				   
				   ('$pname[$i]', 'I1081', 'Sold','".$rowData[4][0]*$multifactor80."'),
			       ('$pname[$i]', 'I1081', 'Indicative','".$rowData[4][1]*$multifactor80."'),
			       ('$pname[$i]', 'I1081', 'Real','".$rowData[4][0]*$multifactor80."'),
				   
				   ('$pname[$i]', 'I1082', 'Sold','".$rowData[4][0]*$multifactor10."'),
			       ('$pname[$i]', 'I1082', 'Indicative','".$rowData[4][1]*$multifactor10."'),
			       ('$pname[$i]', 'I1082', 'Real','".$rowData[4][0]*$multifactor10."'),
				    
				   ('$pname[$i]', 'I1083', 'Sold','".$rowData[4][0]*$multifactor10."'),
			       ('$pname[$i]', 'I1083', 'Indicative','".$rowData[4][1]*$multifactor10."'),
			       ('$pname[$i]', 'I1083', 'Real','".$rowData[4][0]*$multifactor10."'),
				   
				   ('$pname[$i]', 'I1401', 'Sold','".$rowData[5][0]."'),
			       ('$pname[$i]', 'I1401', 'Indicative','".$rowData[5][1]."'),
			       ('$pname[$i]', 'I1401', 'Real','".$rowData[5][0]."'),
				   
				   ('$pname[$i]', 'I3001', 'Sold','".$rowData[6][0]*$multifactor48."'),
			       ('$pname[$i]', 'I3001', 'Indicative','".$rowData[6][1]*$multifactor48."'),
			       ('$pname[$i]', 'I3001', 'Real','".$rowData[6][0]*$multifactor48."'),
				   
				   ('$pname[$i]', 'I3002', 'Sold','".$rowData[6][0]*$multifactor06."'),
			       ('$pname[$i]', 'I3002', 'Indicative','".$rowData[6][1]*$multifactor06."'),
			       ('$pname[$i]', 'I3002', 'Real','".$rowData[6][0]*$multifactor06."'),
				    
				   ('$pname[$i]', 'I3003', 'Sold','".$rowData[6][0]*$multifactor06."'),
			       ('$pname[$i]', 'I3003', 'Indicative','".$rowData[6][1]*$multifactor06."'),
			       ('$pname[$i]', 'I3003', 'Real','".$rowData[6][0]*$multifactor06."'),
				   
				   ('$pname[$i]', 'I3004', 'Sold','".$rowData[6][0]*$multifactor32."'),
			       ('$pname[$i]', 'I3004', 'Indicative','".$rowData[6][1]*$multifactor32."'),
			       ('$pname[$i]', 'I3004', 'Real','".$rowData[6][0]*$multifactor32."'),
				   
				   ('$pname[$i]', 'I3005', 'Sold','".$rowData[6][0]*$multifactor04."'),
			       ('$pname[$i]', 'I3005', 'Indicative','".$rowData[6][1]*$multifactor04."'),
			       ('$pname[$i]', 'I3005', 'Real','".$rowData[6][0]*$multifactor04."'),
				    
				   ('$pname[$i]', 'I3006', 'Sold','".$rowData[6][0]*$multifactor04."'),
			       ('$pname[$i]', 'I3006', 'Indicative','".$rowData[6][1]*$multifactor04."'),
			       ('$pname[$i]', 'I3006', 'Real','".$rowData[6][0]*$multifactor04."'),
				   
				   ('$pname[$i]', 'I5001', 'Sold','".$rowData[9][0]."'),
			       ('$pname[$i]', 'I5001', 'Indicative','".$rowData[9][1]."'),
			       ('$pname[$i]', 'I5001', 'Real','".$rowData[9][0]."'),
				   
				   ('$pname[$i]', 'I5011', 'Sold','".$rowData[10][0]."'),
			       ('$pname[$i]', 'I5011', 'Indicative','".$rowData[10][1]."'),
			       ('$pname[$i]', 'I5011', 'Real','".$rowData[10][0]."'),
				   
				   ('$pname[$i]', 'I6001', 'Sold','".$rowData[12][0]."'),
			       ('$pname[$i]', 'I6001', 'Indicative','".$rowData[12][1]."'),
			       ('$pname[$i]', 'I6001', 'Real','".$rowData[12][0]."'),
				   
				   ('$pname[$i]', 'I7001', 'Sold','".$rowData[13][0]."'),
			       ('$pname[$i]', 'I7001', 'Indicative','".$rowData[13][1]."'),
			       ('$pname[$i]', 'I7001', 'Real','".$rowData[13][0]."'),
				   
				   ('$pname[$i]', 'I7011', 'Sold','".$rowData[14][0]."'),
			       ('$pname[$i]', 'I7011', 'Indicative','".$rowData[14][1]."'),
			       ('$pname[$i]', 'I7011', 'Real','".$rowData[14][0]."'),
				   
				   ('$pname[$i]', 'I7021', 'Sold','".$rowData[15][0]."'),
			       ('$pname[$i]', 'I7021', 'Indicative','".$rowData[15][1]."'),
			       ('$pname[$i]', 'I7021', 'Real','".$rowData[15][0]."'),
				   
				   ('$pname[$i]', 'I7101', 'Sold','".$rowData[16][0]."'),
			       ('$pname[$i]', 'I7101', 'Indicative','".$rowData[16][1]."'),
			       ('$pname[$i]', 'I7101', 'Real','".$rowData[16][0]."'),
				   
				   ('$pname[$i]', 'I1301', 'Sold','".$rowData[17][0]."'),
			       ('$pname[$i]', 'I1301', 'Indicative','".$rowData[17][1]."'),
			       ('$pname[$i]', 'I1301', 'Real','".$rowData[17][0]."')";
				   
		$result_insert =	mysqli_query($con, $insert_budget);

	 
	}
	catch(Exception $e)
	{
    
	}	
	}
	}
	
	
	else if($previous[$i]<>"0")
	{	
		
		$sql="UPDATE  cpms_project SET project_cd='$pname[$i]' , project_release_cd='$release[$i]' , project_delivery_lot='$lot[$i]' , project_owner='$powner[$i]' 
		, project_reviewer='$previewer[$i]', project_onshore_supp='$osupp[$i]',project_start_dt='$pstdt[$i]',project_end_dt='$penddt[$i]',
		project_budget_abacus='$inibudget[$i]',project_pre_int_in='$budgetpreinind[$i]',project_pre_int_fr='$budgetpreinfr[$i]',project_addnl_qual='$budgetaddqual[$i]',
		project_addnl_uat='$budgetadduat[$i]' where project_cd='$previous[$i]'";
		mysqli_query($con,$sql);
		
	}
	
}	



?>
<script>
alert("UPDATED AND INSERTED");
window.open('ProjectMaster.php','_self');
</script>
<?php 
mysqli_close($con);
?>