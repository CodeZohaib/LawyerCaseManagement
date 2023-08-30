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

   
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li> <a class="waves-effect waves-dark" href="index2.php" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a>
            </li>
            <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Home </span></a>
            </li>
            <li> <a class="waves-effect waves-dark" href="personal_details.php" aria-expanded="false"><i class="fa fa-user-circle-o"></i><span class="hide-menu">Clients and cases</span></a>
            </li>
            <li> <a class="waves-effect waves-dark" href="case_type.php" aria-expanded="false"><i class="fa  fa-institution"></i><span class="hide-menu">Add Case</span></a>
            </li>
            <li> <a class="waves-effect waves-dark" href="Court_type.php" aria-expanded="false"><i class="fa  fa-institution"></i><span class="hide-menu">Add Court</span></a>
            </li>
          </ul>


        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>

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
                  <h3 class="mb-5 mt-4">Personal Details</h3>



                  <form class="row g-3" action="" method="post">
                    <div class="row mb-3">
                      <input type="text" name="name" required class="form-control" placeholder="NAME">
                    </div>

                    <div class="row mb-3">
                      <input type="text" name="father" required class="form-control" placeholder="Father Name">
                    </div>
                    <div class="row mb-3">
                      <input type="text" name="cnic" required class="form-control" placeholder="CNIC">
                    </div>
                    <div class="row mb-3">
                      <input type="text" name="number" required class="form-control" placeholder="Mobile no ">
                    </div>
                    <div class="row mb-3">
                      <input type="text" name="address" required class="form-control" placeholder="Address">
                    </div>

                    <input name="submit" class="btn btn-success" type="submit" value="Save">
                </div>
              </div>
            </div>
          </div> <!-- End Table with stripped rows -->
        </div>
      </div>

      <div class="page-wrapper">

        <div class="container-fluid">

          <div class="row page-titles">
            <div class="col-md-5 align-self-center">
              <ol class="breadcrumb">
                <h2>
                  <li class="breadcrumb-item active">Case-details</li>
                </h2>
              </ol>
            </div>

          </div>



          <div class="row g-3">
            <!-- Column -->

            <div class="col-md-12">
              <input type="text" class="form-control" required name="c_name" placeholder="Client Name">
            </div>
            <div class="col-md-2">
              <select class="browser-default custom-select" required name="behalf">
                <option selected>On the behalf of </option>
                <option value="1">Petetionar</option>
                <option value="2">Respondent</option>

              </select>
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control" required placeholder="Case no" name="case_no">
            </div>
            <div class="col-md-2">

              <select class="browser-default custom-select" required name="case_type">
                <option selected>Case type </option>
                <option value='1'>testing</option>
              </select>
            </div>
            <div class="col-md-2">
              <select class="browser-default custom-select" required name="court_name">
                <option selected required>Court Name </option>
                <option value='1'>testings</option>
                <option value='3'>jgfjhgfhgfh</option>
              </select>
            </div>
            <div class="col-6">
              <input type="text" class="form-control" required placeholder="Pet/def Name" name="pet_name">
            </div>
            <div class="col-md-6">
              <input type="text" required class="form-control" placeholder="U-Section" name="section">
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control" required placeholder="Hearing" name="hearing">
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control" required placeholder="Judge-Name" name="judge_name">
            </div>
            <div class="col-md-6">
              <label for="inputDate">Case date</label>

              <input type="date" class="form-control" required name="case_date">

            </div>
            <div class="row align-self-center text-center m-t-5">
               <div class="msgShow"></div>
              <input name="submit" class="btn btn-success" type="submit" value="Save">

            </div>
            <div class="row align-self-center text-center m-t-5">
              <a href="clients_and_cases.php" name="submit" class="btn btn-primary" type="submit" value="">Clients And Cases</a>

            </div>
          </div>
          </form>



          <div class="row">
          </div>
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