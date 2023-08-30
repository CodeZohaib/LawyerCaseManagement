
<?php
include "include/function.php";

if (!isset($_SESSION['loginUser']) and empty($_SESSION['loginUser'][0]) and empty($_SESSION['loginUser'][1])) 
{
    header('location:login.php');
}

$userData = getUser($_SESSION['loginUser'][0]);

$getAllTypeCase=getCaseType();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, AdminWrap lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, AdminWrap lite design, AdminWrap lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="AdminWrap Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Case Management System</title>
    
   <?php include "include/cssLinks.php"; ?>
</head>

<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">
        
        <?php include "include/header.php"; ?>

        <?php include "include/sidebar.php"; ?>
  
   <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Add Case Type</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index2.php">Home</a></li>
                        <li class="breadcrumb-item active">Add Case Type</li>
                    </ol>
                </div>

            </div>


            <div class="row">
                <!-- Column -->
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                            Add New Case
                        </button>

                        <?php
                          if(is_array($getAllTypeCase))
                          {
                        ?>
                        <br><br><input type="text" name="search" class="form-control search" placeholder="Search">
                        <!-- Table with stripped rows -->
                        <table class="table datatable" style="margin-top:20px">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">ID</th>
                                    <th scope="col">Case Type </th>
                                    <th scope="col">Action </th>
                                </tr>
                            </thead>
                            <tbody class="showSearchData">
                                <?php 
                                  $i=1;
                                  foreach ($getAllTypeCase as $key => $value) 
                                  {
                                      echo '<tr class="text-center">
                                            <th scope="row">'.$i.'</th>
                                            <td>'.ucwords($value['case_type']).'</td>
                                            <td>
                                            <a href="case_type_edit.php?cid='.$value['case_type_id'].'" type="button" class="btn btn btn-outline-light"><img src="files/images/edit.png" style="width: 25px;" alt=""></a>

                                            <button type="button" case_type_id='.$value['case_type_id'].' class="btn btn-default caseTypeDelete" data-bs-toggle="modal" data-bs-target="#deleteCase">
                                                    <img src="files/images/trash.png" style="width: 25px;" alt="">
                                                </button>
                                            
                                        </tr>';

                                    $i++;
                                  }
                                ?>
                                
                            </tbody>
                        </table>

                        <?php
                         }
                         else
                         {
                            echo '<div style="margin-top:100px" class="alert alert-danger alert-dismissible fade show d-flex justify-content-center" role="alert">
                             Case Type is empty please add case type......!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                         }
                         ?>
                     

                        <!-- ============================================================== -->
                        <!-- End Bread crumb and right sidebar toggle -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Sales Chart and browser state-->
                        <!-- ============================================================== -->
                        <div class="row mb-2">
                            <div class="col-9"></div>
                            <div class="col-3 mb-2">
                                <!-- Button trigger modal -->
                                
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Add Case type</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-3 form" action="include/request.php" method="post">
                                                    <div class="col-md-12">
                                                        <input type="text" required name="addNewCase" class="form-control" placeholder="Enter Case New Type.....!">
                                                    </div>
                                                    <div class="msgShow"></div>
                                                    <div class="modal-footer">

                                                        <input type="submit" name="submit" value="Save" class="btn btn-info">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                    </div>
                                                </form>



                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--edit modal -->


                                <!-- Modal -->
                                <div class="modal fade" id="deleteCase" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Delete Case Type</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                    <div class="col-md-12">
                                                        Are you sure you want to delete.?
                                                    </div><br>

                                                    <div class="msgShow"></div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-info yesDeleteCase">Yes</button>
                                                        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger">No</button>
                                                    </div>
                                                



                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--delete modal -->



                               
                            </div>
                        </div>
                                                                </div>
                                    </div>
           
             <footer class="footer"> © 2023 Crime Management System <a href="">UbaidUllah Khattak </a> </footer>
            </div>
            


 <?php include 'include/jsLinks.php'; ?>
</body>

</html>
