<?php //session_start()?>
<html>
<link rel="stylesheet" type="text/css" href="next.css">
<head>
<title>main page</title>
</head>
<body>
 <?php
 session_start();
$user= $_SESSION['username'];
echo "<p style='text-align:center;
				font-size:20px;color:white;
				font-family:Verdana,Arial,Helvetica,sans-serif;
				background: linear-gradient(to top, #005e51 50%, #afffea 100%);
				margin: auto;
				width:20%;box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
				'>"."Welcome " . $user."</p>";?>

<div class="logout">
    <a href="home.php">LOGOUT</a>
	<?phpsession_destroy();
	?>
	
</div>

<br>
<br>

<ul>
  <li><a href="activity_report.php">Activity Report</a></li>
  <li class="dropdown">
    <a href="#" class="dropbtn">Release</a>
    <div class="dropdown-content">
      <a href="project_report_gen.html">17.1</a>
      <a href="project_report_gen.php">17.2</a>
      <a href="project_report_gen.html">TFA</a>
      <a href="project_report_gen.html">TMA</a>
    </div>
  </li>
  <li><a href="billing.html">Report Generation</a></li>
  <li><a href="billing.html">Billing</a></li>
  <li class="dropdown">
    <a href="#" class="dropbtn">Admin</a>
    <div class="dropdown-content">
      <a href="ReleaseMaster.php">RELEASE</a>
      <a href="ProjectMaster.php?rls_cd=">PROJECT</a>
      <a href="User.php">USER</a>
      <a href="billing.html">MISC</a>
    </div>
  </li>
  
</ul>

<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">News: 1 / 3</div>
  <img src="img_nature_wide.jpg" style="width:100%">
  <div class="text">CAAS project shifting to site 1 for now</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">News: 2 / 3</div>
  <img src="img_fjords_wide.jpg" style="width:100%">
  <div class="text">CAAS premier league starting today</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">News: 3 / 3</div>
  <img src="img_mountains_wide.jpg" style="width:100%">
  <div class="text">Maintenance offshore started from April 2017</div>
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex> slides.length) {slideIndex = 1}
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 3000); // Change image every 2 seconds
}
</script>

</body>
</html>