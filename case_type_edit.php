<?php 
include "include/function.php";
if (!isset($_SESSION['loginUser']) and empty($_SESSION['loginUser'][0]) and empty($_SESSION['loginUser'][1])) 
{
    header('location:login.php');
}
else if(!isset($_GET['cid']) OR empty($_GET['cid'])  OR !is_numeric($_GET['cid']))
{
 header('location:case_type.php');
}
else
{
  $case_type_id=$_GET['cid'];
  $userData = getUser($_SESSION['loginUser'][0]);

  $run=$con->prepare("SELECT * FROM `cases_type` WHERE case_type_userId=? AND case_type_id=?");
  $run->bindParam(1,$userData['u_id'],PDO::PARAM_INT);
  $run->bindParam(2,$case_type_id,PDO::PARAM_STR);

   if($run->execute())
   {
     if($run->rowCount()>0)
     {
       $caseTypeData=$run->fetch(PDO::FETCH_ASSOC);
     }
     else
     {
      header('location:case_type.php');
     }
   }
   else
   {
    header('location:case_type.php');
   }
}

?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="files/assets/img/apple-icon.png">
  <link rel="icon" type="files/image/png" href="files/assets/img/favicon.png">
  <title>
    Case Type Edit
  </title>
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
        <div class="col-lg-6 col-md-8 col-12 mx-auto">
          <div class="card z-index-0 fadeIn3 fadeInBottom">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Case Type Edit</h4>
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
                  <label class="form-label"> <b>Case Type</b></label>
                  <input type="text" name="type" value="<?php echo $caseTypeData['case_type']; ?>" class="form-control" style="margin-top:30px; margin-left: 10px;">
                  <input type="hidden" name="caseTypeUpdateID" value="<?php echo $caseTypeData['case_type_id']; ?>" class="form-control">
                </div>
                
                
                
                <div class="msgShow"></div>
                <div class="text-center">
                  <input type="submit" name="submit" class="btn bg-gradient-success w-100 my-4 mb-2" value="Update">
                </div>
                <div class="text-center">
                  <a href="case_type.php"  class="btn bg-gradient-success w-100 my-4 mb-2" > Back</a>
                </p>
              </form>
            </div>

           
          </div>
        </div>
      </div>
    </div>
    
  </div>
  

  <?php include "include/jsLinks.php"; ?>
</body>

</html>