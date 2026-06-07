<html>

<!-- Link to css file for home.html -->
<link rel="stylesheet" type="text/css" href="home.css">

<head>
<!-- -->
<title>Forgot Password</title>
</head>

<body>

<!-- To display sopra steria logo image -->
<div class="logo">
<img src="sopra-steria.png" alt="logo" >
</div>


<!-- -->
<form >

<!-- grouped username password and login button in container class to position it on the page-->
<div class="container">
<label><b>Username</b></label></br>
<input type="text" placeholder="Enter Username" name="uname" id = "uname" required>
<h3> OR </h3>
<label><b>Email</b></label></br>
<input type="text" placeholder="Enter Email Address" name="email" id = "email" required>
</br>
<button type="button" onclick = "generateOTP()">Generate OTP</button>
</br></br>
<label><b>OTP</b></label></br>
<input type="text" placeholder="Enter OTP" name="textotp" id = "textotp" disabled="true">
</br></br>


<!--- <button type="submit" name="Generate OTP" value="submit">Generate OTP</button> 
</br></br> --->
  

</div>
	 
</form>

<script>
function generateOTP() {
//
<!--- calling cpmsOTP for OTP generation > 
var gotp = "<?php cpmsOTP(); ?>"

var textotp = document.getElementById("textotp");
    textotp.removeAttribute("disabled");
    textotp.setAttribute("editable", true);
	
var uname = document.getElementById("uname");
    uname.setAttribute("disabled", true);
    uname.setAttribute("editable", false);
	
var email = document.getElementById("email");
    email.setAttribute("disabled", true);
    email.setAttribute("editable", false);
	

var x="<?php sendMail($gotp,$email); ?>";
alert(x);
	
}

</script>

<?php
function sendMail($newotp , $emailid) {
	$to = $emailid;
    $subject = "OTP for password reset ";
	$message = "<b>OTP : </b>" $newotp;
	$retval = mail ($to,$subject,$message);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
      
}
	   
 //FUNCTION TO GENERATE ONE-TIME PASSWORD   
  function cpmsOTP($length = 8, $chars = 'abcdefghijklmnopqrstuvwxyz1234567890')  
 {  
         $chars_length = (strlen($chars) - 1);  
         $string = $chars{rand(0, $chars_length)};  
         for ($i = 1; $i < $length; $i = strlen($string))  
         {  
            $r = $chars{rand(0, $chars_length)};  
            if ($r != $string{$i - 1}) $stropt .= $r;  
         }  
         return $strotp;}  
	
 ?>


 

</body>
</html>