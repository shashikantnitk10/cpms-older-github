<?php
session_start();
include "database_connect.php";


$trgm=$_POST['trgm'];
$previous=$_POST['previous'];
$name=$_POST['name'];
$access_type=$_POST['access_type'];
$role=$_POST['role'];
$status=$_POST['status'];

$len=count($trgm);

for($i=0;$i<$len;$i++)
{
	$trgm[$i]=strtoupper($trgm[$i]);
	if($previous[$i]=="0")
	{
$sql=  "INSERT INTO cpms_user(user_trgm, user_name, user_password, user_access_typ,user_role,user_status) values ('$trgm[$i]','$name[$i]','$trgm[$i]','$access_type[$i]','$role[$i]','$status[$i]')";

mysqli_query($con,$sql);
	}
	else if($previous[$i]<>"0")
	{
		$sql1="UPDATE cpms_user SET  user_trgm='$trgm[$i]' , user_name='$name[$i]' , user_access_typ='$access_type[$i]' , user_role='$role[$i]' , user_status='$status[$i]' WHERE user_trgm='$previous[$i]'";
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
window.open('User.php','_self');
</script>
<?php 
mysqli_close($con);
?>