<?php
include "include/function.php";

if (!isset($_SESSION['loginUser']) and empty($_SESSION['loginUser'][0]) and empty($_SESSION['loginUser'][1])) 
{
    header('location:login.php');
}
$userID=$_SESSION['loginUser'][1];
$userData = getUser($_SESSION['loginUser'][0]);


$run=$con->prepare("SELECT * FROM `cases` WHERE user_id=? AND case_status=?");
$run->bindParam(1,$userID,PDO::PARAM_INT);
$run->bindValue(2,'open',PDO::PARAM_STR);
if($run->execute())
{
    $totalCases=$run->rowCount();
}

$run=$con->prepare("SELECT * FROM `client` WHERE user_id=? AND client_status=?");
$run->bindParam(1,$userID,PDO::PARAM_INT);
$run->bindValue(2,'active',PDO::PARAM_STR);
if($run->execute())
{
    $totalClient=$run->rowCount();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, AdminWrap lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, AdminWrap lite design, AdminWrap lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="AdminWrap Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Case Management System</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="files/images/Case Management System.png">
    <!-- Bootstrap Core CSS -->
    <link href="files/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="files/node_modules/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="files/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--c3 CSS -->
    <link href="files/node_modules/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="files/css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="files/css/pages/dashboard1.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="files/css/colors/default.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="files/bootstrap-5.3.0-alpha3/bootstrap-5.3.0-alpha3/scss/bootstrap.scss">
    <link rel="stylesheet" href="files/bootstrap-5.3.0-alpha3-dist/bootstrap-5.3.0-alpha3-dist/css/bootstrap.css">





</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include "include/header.php" ?>

        <?php include "include/sidebar.php" ?>

        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <!-- Column -->
                    <div class="row">
                        <div class="col-6 grid-margin">
                            <div class="card bg-gradient-danger card-img-holder text-white">
                                <div class="card-body">
                                    <a href="case.php"><img src="files/images/beatriz-perez-moya-XN4T2PVUUgk-unsplash.jpg" style="width: 100%;" alt="circle-image" />
                                        <h4 class="font-weight-normal mb-1 mt-2 text-decoration-none" style="text-decoration: none; list-style:none;">Total Cases:-  <span style="list-style:none; text-decoration:none;"><?php echo $totalCases; ?></span>
                                        </h4>
                                       
                                    </a>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-6 grid-margin">
                            <div class="card bg-gradient-info card-img-holder text-white">
                                <div class="card-body">
                                    <a href="clients.php"><img src="files/images/sebastian-herrmann-NbtIDoFKGO8-unsplash.jpg" style="width: 100%; height: 260px;" alt="circle-image" />
                                        <h4 class="font-weight-normal mb-1 mt-2">Total Clients:- <span><?php echo $totalClient; ?></span>
                                        </h4>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                  <footer class="footer"> © 2023 Crime Management System <a href="">UbaidUllah Khattak </a> </footer>
                </div>
            </div>
        </div>

        <script src="files/node_modules/jquery/jquery.min.js"></script>
        <!-- Bootstrap popper Core JavaScript -->
        <script src="files/node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="files/js/perfect-scrollbar.jquery.min.js"></script>
        <!--Wave Effects -->
        <script src="files/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="files/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="files/js/custom.min.js"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->
        <!--morris JavaScript -->
        <script src="files/node_modules/raphael/raphael-min.js"></script>
        <script src="files/node_modules/morrisjs/morris.min.js"></script>
        <!--c3 JavaScript -->
        <script src="files/node_modules/d3/d3.min.js"></script>
        <script src="files/node_modules/c3-master/c3.min.js"></script>
        <!-- Chart JS -->
        <script src="files/js/dashboard1.js"></script>

        <script src="files/js/mycustom.js"></script>
</body>

</html>