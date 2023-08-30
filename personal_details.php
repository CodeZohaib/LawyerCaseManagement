<?php
include "include/function.php";

if (!isset($_SESSION['loginUser']) and empty($_SESSION['loginUser'][0]) and empty($_SESSION['loginUser'][1])) 
{
    header('location:login.php');
}

$userData = getUser($_SESSION['loginUser'][0]);

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

  <?php include "include/cssLinks.php"; ?>
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
    
    <?php include "include/header.php"; ?>



    <?php include "include/sidebar.php" ?>

      <!-- ============================================================== -->
      <!-- Preloader - style you can find in spinners.css -->
      <!-- ============================================================== -->

      <!-- ============================================================== -->
      <!-- Main wrapper - style you can find in pages.scss -->
      <!-- ============================================================== -->

      <div class="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <!-- Column -->
            <div class="col-12">
              <div class="card">
                <div class="card-body text-center">
                  <h3 class="mb-5 mt-4">Client Details</h3>



                  <form action="include/request.php" method="post"  class="text-start form">
                    <div class="row mb-3">
                      <input type="text" name="c_name" required class="form-control" placeholder="NAME">
                    </div>

                    <div class="row mb-3">
                      <input type="text" name="c_father" required class="form-control" placeholder="Father Name">
                    </div>
                    <div class="row mb-3">
                      <input type="text" name="c_cnic" required class="form-control" placeholder="CNIC">
                    </div>
                    <div class="row mb-3">
                      <input type="text" name="c_number" required class="form-control" placeholder="Mobile no ">
                    </div>
                    <div class="row mb-3">
                      <input type="text" name="c_address" required class="form-control" placeholder="Address">
                    </div>

                     <div class="msgShow"></div>

                    <div class="row align-self-center text-center m-t-5">
                      <input name="submit" class="btn btn-success" type="submit" value="Save">

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div> <!-- End Table with stripped rows -->
        </div>
      </div>
  </div>


  <?php include 'include/jsLinks.php'; ?>

  <script>
    $('#jumpToBottomButton').click(function() {
      // Scroll to the bottom of the page
      $('html, body').animate({
        scrollTop: $(document).height()
      }, 'slow');
    });
  </script>
</body>

</html>