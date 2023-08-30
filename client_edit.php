
<?php 
include "include/function.php";
if (!isset($_SESSION['loginUser']) and empty($_SESSION['loginUser'][0]) and empty($_SESSION['loginUser'][1])) 
{
    header('location:login.php');
}
else if(!isset($_GET['cid']) OR empty($_GET['cid'])  OR !is_numeric($_GET['cid']))
{
  header('location:clients.php');
}
else
{
  $client_id=$_GET['cid'];
  $clientData=getClientByID($client_id);
  $userData = getUser($_SESSION['loginUser'][0]);

  if(!is_array($clientData))
  {
    header('location:clients.php');
  }
  else
  {
    if($clientData['client_status']=='active')
    {
      $status='
          <option value="">Select Client Status</option>
          <option value="active" selected>Active</option>
          <option value="inactive">Inactive</option>
      ';
    }
    else
    {
      $status='
          <option value="">Select Client Status</option>
          <option value="active">Active</option>
          <option value="inactive" selected>Inactive</option>
      ';
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
  <link rel="icon" type="files/image/png" href="files/assets/img/favicon.png">
  <title>
    Client Edit
  </title>

   <link href="files/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="files/assets/css/nucleo-svg.css" rel="stylesheet" />

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
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Client Edite</h4>
                
              </div>
            </div>

            

            <div class="card-body mt-4">
              <form action="include/request.php" method="post"  class="text-start form">
                <div class="input-group input-group-outline my-3">
                  <input type="text" name="update_fullname" value="<?php echo $clientData['fullname']; ?>" class="form-control" placeholder="Full Name" required>
                  <input type="hidden" name="client_id" value="<?php echo $client_id; ?>" class="form-control" required>
                </div>
                
                <div class="input-group input-group-outline my-3">
                  <input type="text" name="update_father" value="<?php echo $clientData['father']; ?>" class="form-control" placeholder="Father Name" required>
                </div>
                <div class="input-group input-group-outline my-3">
                  <input type="text"  name="update_cnic" value="<?php echo $clientData['cnic']; ?>" class="form-control" placeholder="CNIC No" required>
                </div>
                <div class="input-group input-group-outline my-3">
                  <input type="text"  name="update_number" value="<?php echo $clientData['number']; ?>" class="form-control" placeholder="Mobile No" required>
                </div>
                <div class="input-group input-group-outline my-3">
                  <input type="text"  name="update_address" value="<?php echo $clientData['address']; ?>" class="form-control" placeholder="Address" required>
                </div>

                <div class="input-group input-group-outline my-3">
                  <select class="browser-default custom-select form-control" required name="update_client_status">
                    <?php echo $status; ?>
                  </select>
                </div>
                
                <div class="msgShow"></div>
                
                <div class="text-center">
                  <input type="submit" name="submit" class="btn bg-gradient-success w-100 my-4 mb-2" value="Update">
                </div>
                <div class="text-center">
                  <a href="clients.php"  class="btn bg-gradient-success w-100 my-4 mb-2" value="Update"> Back</a>
                </p>
              </form>
            </div>

           
          </div>
        </div>
      </div>
    </div>
    
  </div>

   <?php include "include/jsLinks.php" ?>
</body>

</html>