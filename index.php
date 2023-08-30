<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="apple-touch-icon" sizes="76x76" href="./files/assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="./files/assets/img/favicon.png">

<title> Case Management System</title>



<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

<!-- Nucleo Icons -->
<link href="./files/assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="./files/assets/css/nucleo-svg.css" rel="stylesheet" />

<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

<!-- CSS Files -->



<link id="pagestyle" href="./files/assets/css/material-kit.css?v=3.0.4" rel="stylesheet" />



</head>

<body class="index-page bg-gray-200">
  
  
  <!-- Navbar -->
<div class="container position-sticky z-index-sticky top-0"><div class="row"><div class="col-12">
<nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
  <div class="container-fluid px-0">
    <a class="navbar-brand font-weight-bolder ms-sm-3" href="" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
      Case Management System
    </a>
    
  </div>
  <a class="navbar-brand font-weight-bolder ms-sm-3" href="index.php" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" >
    Home
  </a>
 
  <?php 

    if (!isset($_SESSION['loginUser']) and empty($_SESSION['loginUser'][0]) and empty($_SESSION['loginUser'][1])) 
    {
        ?>
           <a class="navbar-brand font-weight-bolder ms-sm-3" href="index2.php" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" >
            Login
          </a>

          <a class="navbar-brand font-weight-bolder ms-sm-3" href="register.php">
            Sign Up
          </a>
        <?php
    }
    else
    {
       ?>
           <a class="navbar-brand font-weight-bolder ms-sm-3" href="index2.php" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" >
            Dashboard
          </a>

          <a href='logout.php'><button type='button' class='btn btn-light mb-0'>logout</button></a>
        <?php
    }
  ?>
  
  </nav>
<!-- End Navbar -->
</div></div></div>

<header class="header-2">
  <div class="page-header min-vh-75 relative" style="background-image: url('./files/aditya-joshi-FOhw4A1CR1Q-unsplash.jpg')">
    
    <div class="container">
      <div class="row">
        <div class="col-lg-7 text-center mx-auto">
          <h1 class="text-white pt-3 mt-n5">Without Justice </h1>
          <p class="lead text-white mt-3">We cannot have Peace in this world </p>
        </div>
      </div>
    </div>
  </div>
</header>

<!--   Core JS Files   -->
<script src="./files/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./files/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="./files/assets/js/plugins/perfect-scrollbar.min.js"></script>

<!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
<script src="./files/assets/js/plugins/countup.min.js"></script>

<script src="./files/assets/js/plugins/choices.min.js"></script>

<script src="./files/assets/js/plugins/prism.min.js"></script>
<script src="./files/assets/js/plugins/highlight.min.js"></script>

<!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
<script src="./files/assets/js/plugins/rellax.min.js"></script>
<!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
<script src="./files/assets/js/plugins/tilt.min.js"></script>
<!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
<script src="./files/assets/js/plugins/choices.min.js"></script>
<!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
<script src="./files/assets/js/plugins/parallax.min.js"></script>

<!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
<script src="./assets/js/material-kit.min.js?v=3.0.4" type="text/javascript"></script>
<script type="text/javascript">

  if (document.getElementById('state1')) {
    const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
    if (!countUp.error) {
      countUp.start();
    } else {
      console.error(countUp.error);
    }
  }
  if (document.getElementById('state2')) {
    const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
    if (!countUp1.error) {
      countUp1.start();
    } else {
      console.error(countUp1.error);
    }
  }
  if (document.getElementById('state3')) {
    const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
    if (!countUp2.error) {
      countUp2.start();
    } else {
      console.error(countUp2.error);
    };
  }
</script>

</body>

</html>
