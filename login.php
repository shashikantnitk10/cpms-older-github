<?php

	function sign_in($name,$pwd)
	{
	include "database_connect.php";
		
		if(!empty($name)){
			
	$query = mysqli_query($con,"select user_trgm,user_name,user_password,user_access_typ from cpms_user where user_trgm='$name' and user_password='$pwd'") or die(mysqli_error());
	
	$res=mysqli_fetch_assoc($query);
	
	
   if(!empty($res['user_trgm']) AND !empty($res['user_password']))
   {
	  
     include('next.php');
	
   }
   else
   {
	   echo"<script>alert('Username and/ or password incorrect');</script>";
	     include('home.php');
   }
 }
	}
if(isset($_POST['submit']))
{
    //session_start();
	$name=$_POST['uname'];
	$pwd=$_POST['psw'];
	sign_in($name,$pwd);
    $_SESSION['username']=$name;
	
}

?>
 
	
	
