
<?php 
include "include/function.php";
if (!isset($_SESSION['loginUser']) and empty($_SESSION['loginUser'][0]) and empty($_SESSION['loginUser'][1])) 
{
    header('location:login.php');
}
else if(!isset($_GET['cid']) OR empty($_GET['cid'])  OR !is_numeric($_GET['cid']))
{
  header('location:case.php');
}
else
{
  $case_id=$_GET['cid'];
  $caseData=getCaseByID($case_id);
  $userData = getUser($_SESSION['loginUser'][0]);

  if(!is_array($caseData))
  {
    header('location:case.php');
  }
  else
  {
    if($caseData['case_status']=='clientInactive')
    {
      header('location:case.php');
    }


    if($caseData['case_status']=='open')
    {
      $status='
          <option value="">Select Case Status</option>
          <option value="open" selected>Open</option>
          <option value="close">Close</option>
      ';
    }
    else
    {
      $status='
          <option value="">Select Case Status</option>
          <option value="open">Open</option>
          <option value="close" selected>Close</option>
      ';
    }


    if($caseData['behalf']=='petetionar')
    {
      $behalf=' <option>On the behalf of </option>
                <option value="petetionar" selected>Petetionar</option>
                <option value="respondent">Respondent</option>';
    }
    else
    {
      $behalf=' <option>On the behalf of </option>
                <option value="petetionar">Petetionar</option>
                <option value="respondent" selected>Respondent</option>';
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Register
  </title>


<!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="files/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="files/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="files/assets/css/material-kit.css?v=3.0.4" rel="stylesheet" />

</head>

<body class="sign-in-basic">
  <!-- Navbar Transparent -->

  <!-- End Navbar -->
  <div class="page-header align-items-start min-vh-100" style="background-image: url('files/pexels-ekaterina-bolovtsova-6077326.jpg');" loading="lazy">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
      <div class="row">
        <div class="col-lg-7 col-md-8 col-12 mx-auto"><br><br>
          <div class="card z-index-0 fadeIn3 fadeInBottom">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Case Edit</h4>
                <div class="row mt-3">
                  <div class="col-2 text-center ms-auto">

                  </div>
                  <div class="col-2 text-center px-1">

                  </div>
                  <div class="col-2 text-center me-auto">

                  </div>
                </div>
              </div>
            </div>

            

              <div class="card-body mt-4">
              <form action="include/request.php" method="post"  class="text-start form">

                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Case No</label>
                  <input type="text" name="update_case_no" value="<?php echo $caseData['case_no']; ?>" class="form-control" style="margin-top:30px; margin-left:10px">
                  <input type="number" name="update_case_id" value="<?php echo $case_id; ?>" hidden>
                </div>


                <div class="input-group input-group-outline my-3">
                  <label class="form-label">On the behalf of</label>
                  <select class="browser-default custom-select form-control" required name="update_behalf" style="margin-top:30px; margin-left:11px">

                    <?php echo $behalf; ?>
                   
                  </select>
                </div>

                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Case Type</label>
                  <select class="browser-default custom-select form-control" required name="update_case_type" style="margin-top:30px; margin-left:11px">
                    <option>Select Case Name</option>
                     <?php 
                       $caseAllType=getCaseType();
                       if(is_array($caseAllType))
                       {
                         foreach ($caseAllType as $key => $value) 
                         {
                           if($value['case_type']==$caseData['case_type_name'])
                           {
                            echo "<option value='".strtolower($value['case_type'])."' selected>".htmlspecialchars(ucwords($value['case_type']))."</option>";
                           }
                           else
                           {
                            echo "<option value='".strtolower($value['case_type'])."'>".htmlspecialchars(ucwords($value['case_type']))."</option>";
                           }
                         }
                       }
                       else
                       {
                         echo "<option>Case Type is Empty. Please Add first</option>";
                       }
                     ?>
                  </select>
                </div>


                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Court Name</label>
                  <select class="browser-default custom-select form-control" required name="update_court_name" style="margin-top:30px; margin-left:11px">
                    <option required>Select Court Name </option>
                     <?php 
                         $courtAllType=getCourtType();
                         if(is_array($caseAllType))
                         {
                           foreach ($courtAllType as $key => $value) 
                           {
                            if($value['court_type']==$caseData['court_type_name'])
                            {
                             echo "<option value='".strtolower($value['court_type'])."' selected>".htmlspecialchars(ucwords($value['court_type']))."</option>";
                            }
                            else
                            {
                              echo "<option value='".strtolower($value['court_type'])."'>".htmlspecialchars(ucwords($value['court_type']))."</option>";
                            }
                           }
                         }
                         else
                         {
                           echo "<option>Court Type is Empty. Please Add first</option>";
                         }
                       ?>
                </select>
                </div>
                
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Pet/Def Name</label>
                  <input type="text" name="update_pet_name" value="<?php echo $caseData['pet_name']; ?>" class="form-control" style="margin-top:30px; margin-left:10px">
                </div>
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">U Section</label>
                  <input type="text" name="update_section" value="<?php echo $caseData['section']; ?>" class="form-control" style="margin-top:30px; margin-left:10px">
                </div>
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Judge Name</label>
                  <input type="text" name="update_judge_name" value="<?php echo $caseData['judge_name']; ?>" class="form-control" style="margin-top:30px; margin-left:10px">
                </div>

                <div class="input-group input-group-outline my-3">

                  <label class="form-label">Case status</label>


                  <select class="browser-default custom-select form-control" required name="update_client_status" style="margin-top:30px; margin-left:10px">
                    <?php echo $status; ?>
                  </select>
                </div>


                 <div class="msgShow"></div>

                <div class="text-center">
                  <input type="submit" name="submit" class="btn bg-gradient-success w-100 my-4 mb-2" value="Update">
                </div>
                <div class="text-center">
                  <a href="case.php" class="btn bg-gradient-success w-100 my-4 mb-2" value="Update"> Back</a>
                  </p>
              </form>
            </div>


          </div>
        </div>
      </div>
    </div>

  </div>
  
 <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="assets/js/plugins/parallax.min.js"></script>
  <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
  <script src="assets/js/material-kit.min.js?v=3.0.4" type="text/javascript"></script>

<?php include "include/jsLinks.php"; ?>


</body>

</html>