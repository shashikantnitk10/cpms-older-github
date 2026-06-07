<?php
$con=mysqli_connect("localhost","root","","cpms_old") or die("Failed to connect to mysqli" . mysqli_error());
$db=mysqli_select_db($con,"cpms_old")or die("Failed to connect to mysqli" . mysqli_error("cpms_old"));
	?>