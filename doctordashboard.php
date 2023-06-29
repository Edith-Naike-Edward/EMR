<?php
session_start();
include "dbconn.php";
$mypid = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
if($mypid==""){header("Location: dlogout.php");}else{}
echo "$mypid";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COC</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <nav class="navbar">
    <div class="navbar__container">
      <a href="/" id="navbar__logo">COC</a>
      <div class="navbar__toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      <ul class="navbar__menu">
        <li class="navbar__item">
          <a href="index.html" class="navbar__links">
            Home
          </a>
        </li>
        <li class="navbar__item">
          <a href="appttable.php" class="navbar__links">
            Appointment Table
          </a>
        </li>
        <li class="navbar__item">
          <a href="patienttable.html" class="navbar__links">
            Patient Table
          </a>
        </li>
        <li class="navbar__item">
          <a href="doctortable.html" class="navbar__links">
            Doctor Table
          </a>
        </li>
        <li class="navbar__item">
          <a href="requestappttable.html" class="navbar__links">
           Request Appointment Table
          </a>
        </li>
        <li class="navbar__item">
          <a href="diagnosistable.php" class="navbar__links">
            Diagnosis Table
          </a>
        </li>
        <li class="navbar__item">
          <a href="testtable.php" class="navbar__links">
            Test Table
          </a>
        </li>
        <li class="navbar__item">
          <a href="prescriptiontable.php" class="navbar__links">
            Prescription Table
          </a>
        </li>
        <li class="navbar__item">
          <a href="treatmenttable.php" class="navbar__links">
           Treatment Table
          </a>
        </li>
        <li class="navbar__btn">
          <a href="dlogout.php" class="button">
            Logout
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
  <!-- Slide Show -->
<section>
  <img class="mySlides" src="pawel-czerwinski-VkITYPupzSg-unsplash.jpg"
  style="width:100%" style="height:25%">
  <img class="mySlides" src="quincy-follweiler-okfR2olVQys-unsplash.jpg"
  style="width:100%" style="height:25%">
  <img class="mySlides" src="cdc-fiHQ3-D45zo-unsplash.jpg"
  style="width:100%" style="height:25%">
</section>


<script src="app.js"></script>
<script>
function myFunction() {
  var x = document.getElementById("navbar__item");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
<script>
 // Automatic Slideshow - change image every 3 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
  setTimeout(carousel, 3000);
}
</script> 
</body>
</html>
