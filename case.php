<?php
include "include/function.php";

if (!isset($_SESSION['loginUser']) and empty($_SESSION['loginUser'][0]) and empty($_SESSION['loginUser'][1])) 
{
    header('location:login.php');
}

$userData = getUser($_SESSION['loginUser'][0]);

$userID=$_SESSION['loginUser'][1];

 $run=$con->prepare('SELECT `cases`.*, `cases`.`id` AS case_id, `client`.* FROM `cases` JOIN `client` ON `cases`.`client_id` = `client`.`id`  WHERE `cases`.`user_id` = ?  GROUP BY `cases`.`id` ORDER BY `cases`.`id` DESC');
 $run->bindParam(1,$userID,PDO::PARAM_INT);

 if($run->execute())
 {
     if($run->rowCount()>0)
     {
       $allCases=$run->fetchAll(PDO::FETCH_ASSOC);
     }
     else
     {
        $allCases='';
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

    <?php include "include/header.php" ?>
     <?php include "include/sidebar.php" ?>
   
 <div class="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <!-- Column -->
                <div class="card">
                    <div class="card-body"><br>

                        <?php 
                          if(is_array($allCases))
                          {
                        ?>
                        <input type="text" name="search" class="form-control search" placeholder="Search">
                        <!-- Table with stripped rows -->
                        <table class="table datatable" style="font-size:12px">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">ID</th>
                                    <th scope="col">Client name </th>
                                    <th scope="col">Behalf of</th>
                                    <th scope="col">Case No </th>
                                    <th scope="col">Case Type </th>
                                    <th scope="col">Court name </th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Case Date</th>
                                    <th scope="col">Case Status</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Hearing</th>
                                    <th scope="col">Action </th>

                                </tr>
                            </thead>
                            <tbody class="showSearchData">

                                <?php
                                 $i=1;  
                                 foreach ($allCases as $key => $value) 
                                 {
                                    if($value['case_status']=='open')
                                    {
                                        $editBtn='<a href="case_edit.php?cid='.$value['case_id'].'" type="button" class="btn btn btn-outline-light"><img src="files/images/edit.png" style="width: 20px;" alt=""></a>';

                                        $badge='<span class="badge bg-primary">Open</span>';
                                    }
                                    else if($value['case_status']=='close')
                                    {
                                        $editBtn='<a href="case_edit.php?cid='.$value['case_id'].'" type="button" class="btn btn btn-outline-light"><img src="files/images/edit.png" style="width: 20px;" alt=""></a>';

                                        $badge='<span class="badge bg-danger">Close</span>';
                                    }
                                    else if($value['case_status']=='clientInactive')
                                    {
                                        $editBtn='<button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#clientInactive">
                                               <img src="files/images/edit.png" style="width: 20px;" alt="">
                                            </button>';

                                        $badge='<span class="badge bg-danger">Close</span>';
                                    }


                                     echo ' <tr class="text-center">
                                            <th scope="row">'.$i.'</th>
                                            <td>'.htmlspecialchars(ucwords($value['fullname'])).'</td>
                                            <td>'.htmlspecialchars(ucwords($value['behalf'])).'</td>
                                            <td>'.$value['case_no'].'</td>
                                            <td>'.htmlspecialchars(ucwords($value['case_type_name'])).'</td>
                                            <td>'.htmlspecialchars(ucwords($value['court_type_name'])).'</td>
                                            <td>'.htmlspecialchars(ucwords($value['section'])).'</td>
                                             <td>'.formatDate($value['case_date']).'</td>
                                            
                                             <td>'.$badge.'</td>

                                             <td><a href="hearingDetails.php?case_id='.$value['case_id'].'" type="button" style="font-size:12px" class="btn btn-primary btn-sm fullDataHearing" >Details</a></td>


                                              <td><button type="button" style="font-size:12px" class="btn btn-primary btn-sm addNewHearing" case_id="'.$value['case_id'].'" data-bs-toggle="modal" data-bs-target="#addNewHearing">Add</button></td>

                                            <td>
                                                '.$editBtn.'

                                                <button type="button" class="btn btn-outline-light deleteClientCase" data-bs-toggle="modal" data-bs-target="#caseDelete" case_id="'.$value['case_id'].'">
                                                <img src="files/images/trash.png" style="width: 20px;" alt=""></button>
                                            </td>
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
                             Zero Case. Please Add Case Details in client seaction......!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                         }  
                        ?>
                        <div class="row">
                            <div class="col-9"></div>
                            <div class="col-3">


                                 <!-- Modal -->
                                <div class="modal fade" id="addNewHearing" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addNewHearing" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add New Hearing</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="include/request.php" method="POST"  class="text-start form">
                                                    <div class="newHearingInput">
                                                        
                                                    </div>

                                                   <br> <div class="msgShow"></div><br>
                                                    <div class="modal-footer">
                                                        <input type="submit" class="btn btn-primary newHearingBtn" name="submit" value="Add Hearing">
                                                    </div>
                                                  </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                 <!-- Modal -->



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
                                                   The client status is inactive. You should not edit the client case without first changing the client status to active....!</div>
                                               
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                 <!-- Modal -->
                                <div class="modal fade" id="caseDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="caseDelete" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="caseDelete">Client Case Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                    <div class="col-md-12">
                                                        Are you sure you want to delete client case.?
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


                                <!--delete modal -->




                            </div>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

                <footer class="footer"> © 2023 Crime Management System <a href="">UbaidUllah Khattak </a> </footer>
            </div>
        </div> 

 <?php include "include/jsLinks.php"; ?>
</body>

</html>
