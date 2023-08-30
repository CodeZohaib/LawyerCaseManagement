<?php
include "include/function.php";

if (!isset($_SESSION['loginUser']) and empty($_SESSION['loginUser'][0]) and empty($_SESSION['loginUser'][1])) 
{
    header('location:login.php');
}

$userData = getUser($_SESSION['loginUser'][0]);

$userID=$_SESSION['loginUser'][1];

 $run=$con->prepare('SELECT * FROM `client` WHERE user_id=?');
 $run->bindParam(1,$userID,PDO::PARAM_INT);

 if($run->execute())
 {
     if($run->rowCount()>0)
     {
       $allClient=$run->fetchAll(PDO::FETCH_ASSOC);
     }
     else
     {
        $allClient='';
     }
 }
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
    
     <?php include "include/cssLinks.php" ?>
</head>
<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">
        
        <?php include "include/header.php"; ?>

        <?php include "include/sidebar.php"; ?>


    <div class="page-wrapper">
        <div class="container-fluid">
          
            <div class="row">
                <!-- Column -->
                <div class="card">
                    <div class="card-body">
                        <a href="personal_details.php" class="btn btn-primary">Add Client</a>
                         <?php
                          if(is_array($allClient))
                          {


                        ?>
                        <br><br><input type="text" name="search" class="form-control search" placeholder="Search">
                        <!-- Table with hoverable rows -->

                       
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center" style="font-size:15px">
                                    <th scope="col"><b>#</b></th>
                                    <th scope="col"><b> Name </b></th>
                                    <th scope="col"><b> Father Name </b></th>
                                    <th scope="col"><b> CNIC </b></th>
                                    <th scope="col"><b> Mobile No </b></th>
                                    <th scope="col"><b> Address </b></th>
                                    <th scope="col"><b> Status</b></th>
                                    <th scope="col"><b> Action </b></th>
                                </tr>
                            </thead>
                            <tbody class="showSearchData" style="font-size:15px">

                                <?php
                                 $i=1;
                                 foreach ($allClient as $key => $value) 
                                 {
                                    if($value['client_status']=='active')
                                    {
                                        $editBtn='<a href="addClientCase.php?client_id='.$value['id'].'"  class="btn btn btn-outline-light">
                                                        <img src="files/images/add-friend.png" style="width: 20px;" alt="">
                                                    </a> ';
                                        $badge='<span class="badge bg-primary">Active</span>';
                                    }
                                    else
                                    {
                                        $editBtn='<button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#clientInactive">
                                               <img src="files/images/add-friend.png" style="width: 20px;" alt="">
                                            </button>';

                                        $badge='<span class="badge bg-danger">InActive</span>';
                                    }

                                    echo '<tr class="text-center">
                                        <th scope="row">'.$i.'</th>
                                        <th scope="row">'.htmlspecialchars(ucwords($value['fullname'])).'</th>
                                        <th scope="row">'.htmlspecialchars(ucwords($value['father'])).'</th>
                                        <th scope="row">'.htmlspecialchars(ucwords($value['cnic'])).'</th>
                                        <th scope="row">'.htmlspecialchars(ucwords($value['number'])).'</th>
                                        <th scope="row">'.htmlspecialchars(ucwords($value['address'])).'</th>
                                        <th scope="row">'.$badge.'</th>
                                        
                                        <th>
                                            '.$editBtn.'

                                            <a href="client_edit.php?cid='.$value['id'].'"  class="btn btn btn-outline-light">
                                                <img src="files/images/edit.png" style="width: 20px;" alt="">
                                            </a>

                                           <button type="button" class="btn btn-outline-light deleteClient" client_id="'.$value['id'].'" data-bs-toggle="modal" data-bs-target="#clientDelete">
                                               <img src="files/images/trash.png" style="width: 20px;" alt="">
                                            </button>
                                       </th>
                                   </tr>';

                                   $i++;
                                 }
                                ?> 
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        <?php 
                         }
                         else
                         {
                            echo '<div style="margin-top:100px" class="alert alert-danger alert-dismissible fade show d-flex justify-content-center" role="alert">
                             Zero Client. Please Add Client......!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                         }
                        ?>

                    </div>
                    <div class="row mb-2">
                        <div class="col-9"></div>
                        <div class="col-3 mb-2">
                            <!-- Button trigger modal -->
                            
                             <!-- Modal -->
                                <div class="modal fade" id="clientInactive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="clientInactive" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Client InActive</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                 <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-center" role="alert">
                                                   The client status is inactive. You should not add a new client case without first changing the client status to active....!</div>
                                               
                                            </div>


                                        </div>
                                    </div>
                                </div>


                                 <!-- Modal -->
                                <div class="modal fade" id="clientDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="clientDelete" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Client Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                    <div class="col-md-12">
                                                        Are you sure you want to delete client and cases.?
                                                    </div><br>

                                                    <div class="msgShow"></div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-info yesDeleteClient">Yes</button>
                                                        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger">No</button>
                                                    </div>
                                                



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            
                            
                         </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Sales Chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Projects of the Month -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->

                </div>
                <!-- ============================================================== -->
                <!-- End Projects of the Month -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Notification And Feeds -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Start Notification -->

                    <!-- End Feeds -->
                </div>
                <!-- ============================================================== -->
                <!-- End Notification And Feeds -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © 2023 Crime Management System <a href="">UbaidUllah Khattak </a> </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>


 <?php include "include/jsLinks.php" ?>
</body>

</html>
