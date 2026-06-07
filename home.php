<html>

<!-- Link to css file for home.html -->
<link rel="stylesheet" type="text/css" href="home.css">

<head>
<!-- -->
<title>Homepage</title>
</head>

<body>

<!-- To display ERGO logo image -->
<div class="logo">
<img src="ergo-logo.png" alt="logo" >
</div>

<!-- -->
<form method="POST" action="login.php">

<!-- grouped username password and login button in container class to position it on the page-->
<div class="container">
<label><b>Username</b></label></br>
<select id="uname" name="uname" style="width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
font-family:"Verdana",Arial,Helvetica,sans-serif;"> <option>Select User </option>

<?php
include "database_connect.php";
$sql = "SELECT user_trgm,user_name FROM cpms_user where user_status = 'A' ";
$result = mysqli_query($con, $sql);

while($row = $result->fetch_assoc()) {
   echo"<option  value =".$row["user_trgm"]."> ".$row["user_name"]."</option>";
  }
$con->close();
?>
</select> 

<!-- <input type="text" placeholder="Enter Username" name="uname" required> -->
</br>
</br>

<label><b>Password</b></label></br>
<input type="password" placeholder="Enter Password" name="psw" required>

</br></br>

<button type="submit" name="submit" value="submit"  >Login</button>
</br></br>
      <input type="checkbox" checked="checked"> Remember me
</br>
<span class="psw">Forgot <a href="Forgetpass.php">password?</a></span>

</div>
	 
</form>
</body>
</html>