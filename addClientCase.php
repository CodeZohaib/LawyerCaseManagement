<?php
include "include/function.php";

if (!isset($_SESSION['loginUser']) and empty($_SESSION['loginUser'][0]) and empty($_SESSION['loginUser'][1])) 
{
    header('location:login.php');
}
else if(!isset($_GET['client_id']) AND empty($_GET['client_id']))
{
  header('location:personal_details.php');
}

$clientData=getClientByID($_GET['client_id']);


if($clientData['client_status']=='inactive')
{
  header('location:clients.php');
}

if($clientData==false)
{
   header('location:personal_details.php');
}
else
{
  if($clientData['client_status']=='close')
  {
   
  }
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

   
    <?php include "include/sidebar.php"; ?>

      <!-- ============================================================== -->
      <!-- Preloader - style you can find in spinners.css -->
      <!-- ============================================================== -->

      <!-- ============================================================== -->
      <!-- Main wrapper - style you can find in pages.scss -->
      <!-- ============================================================== -->
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

          <form action="include/request.php" method="post"  class="text-start form" enctype="multipart/form-data">
          <div class="row g-3">
            <!-- Column -->

            <input type="number" hidden required name="client_id" value="<?php echo $_GET['client_id'] ?>">
            
            <div class="col-md-3">
              <select class="browser-default custom-select" required name="behalf">
                <option selected>On the behalf of </option>
                <option value="petetionar">Petetionar</option>
                <option value="respondent">Respondent</option>

              </select>
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" required placeholder="Case no" name="case_no">
            </div>
            <div class="col-md-3">

              <select class="browser-default custom-select" required name="case_type">
                <option selected>Select Case Name</option>
                 <?php 
                   $caseAllType=getCaseType();
                   if(is_array($caseAllType))
                   {
                     foreach ($caseAllType as $key => $value) 
                     {
                       echo "<option value='".strtolower($value['case_type'])."'>".htmlspecialchars(ucwords($value['case_type']))."</option>";
                     }
                   }
                   else
                   {
                     echo "<option>Case Type is Empty. Please Add first</option>";
                   }
                 ?>
                
              </select>
            </div>
            <div class="col-md-3">
              <select class="browser-default custom-select" required name="court_name">
                <option selected required>Select Court Name </option>
               <?php 
                   $courtAllType=getCourtType();
                   if(is_array($caseAllType))
                   {
                     foreach ($courtAllType as $key => $value) 
                     {
                       echo "<option value='".strtolower($value['court_type'])."'>".htmlspecialchars(ucwords($value['court_type']))."</option>";
                     }
                   }
                   else
                   {
                     echo "<option>Court Type is Empty. Please Add first</option>";
                   }
                 ?>
              </select>
            </div>
            <div class="col-6">
              <input type="text" class="form-control" required placeholder="Pet/def Name" name="pet_name">
            </div>
            <div class="col-md-6">
              <input type="text" required class="form-control" placeholder="U-Section" name="section">
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control" required placeholder="Judge-Name" name="judge_name">
            </div>

             <div class="col-md-6" style="display: flex; align-items: center;">
              <label for="hearing-input" style="margin-right: 10px;"><b>Hearing:</b></label>
              <input type="date" class="form-control" required name="hearing" id="hearing-input">
            </div>

            <div class="msgShow"></div>

            <div class="row align-self-center text-center m-t-5">
              <input name="submit" class="btn btn-success" type="submit" value="Save">
              <span>

              </span>
            </div>
            <div class="row align-self-center text-center m-t-5">
              <a href="clients_cases.php" name="submit" class="btn btn-primary" type="submit" value="">Clients And Cases</a>

            </div>
          </div>
          </form>



          <div class="row">
          </div>
        </div>
      </div>


  </div>


  <?php include 'include/jsLinks.php'; ?>

</body>

</html>