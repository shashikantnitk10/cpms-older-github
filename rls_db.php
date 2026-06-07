<?php
session_start();
include "database_connect.php";


$code=$_POST['code'];
$previous=$_POST['previous'];
$mgr=$_POST['mgr'];
$strtdt=$_POST['strtdt'];
$enddt=$_POST['enddt'];
$budget=$_POST['budget'];
$status=$_POST['status'];

$len=count($code);

for($i=0;$i<$len;$i++)
{
	
	if($previous[$i]=="0")
	{
$sql=  "INSERT INTO cpms_release(release_cd,release_mgr,release_start_dt,release_end_dt,release_budget_init,release_status) values('$code[$i]','$mgr[$i]','$strtdt[$i]','$enddt[$i]','$budget[$i]','$status[$i]')";

mysqli_query($con,$sql);
	}
	else if($previous[$i]<>"0")
	{
		$sql1="UPDATE cpms_release SET  release_mgr='$mgr[$i]' , release_start_dt='$strtdt[$i]' , release_end_dt='$enddt[$i]' , release_budget_init='$budget[$i]' , release_status='$status[$i]' WHERE release_cd='$previous[$i]'";
		mysqli_query($con,$sql1);
		
	}
/*if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}*/
}
?>
<script>
alert("UPDATED AND INSERTED");
window.open('ReleaseMaster.php','_self');
</script>
<?php 
mysqli_close($con);
?>