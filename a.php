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

for($i=0;$i<$len;$i++)
{
	if($previous[$i]=="0")
	{
		echo "<script> alert('$pname[$i]' + '$release[$i]' + '$lot[$i]' +'$powner[$i]')</script>";
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


	// Change the file
	$objPHPExcel->setActiveSheetIndex(1)
				->setCellValue('R6', $inibudget[$i])
				->setCellValue('R12', $budgetpreinfr[$i])
				->setCellValue('R13', $budgetpreinind[$i])
				->setCellValue('R16', $budgetaddqual[$i])
				->setCellValue('R18', $budgetadduat[$i]);    
		


	// Write the file
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $inputfiletype);
	$objWriter->save($inputfilename);
		
	mysqli_query($con,$sql);
	}
	else if($previous[$i]<>"0")
	{
		echo "<script> alert('in udpate')</script>";
		$sql="UPDATE  cpms_project SET project_cd='$pname[$i]' , project_release_cd='$release[$i]' , project_delivery_lot='$lot[$i]' , project_owner='$powner[$i]' 
		, project_reviewer='$previewer[$i]', project_onshore_supp='$osupp[$i]',project_start_dt='$pstdt[$i]',project_end_dt='$penddt[$i]',
		project_budget_abacus='$inibudget[$i]',project_pre_int_in='$budgetpreinind[$i]',project_pre_int_fr='$budgetpreinfr[$i]',project_addnl_qual='$budgetaddqual[$i]',
		project_addnl_uat='$budgetadduat[$i]' where project_cd='$previous[$i]'";
		mysqli_query($con,$sql);
		
	}
/*if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}*/

//write on internal budget excel sheet

}



?>
<script>
alert("UPDATED AND INSERTED");
window.open('ProjectMaster.php','_self');
</script>
<?php 
mysqli_close($con);
?>