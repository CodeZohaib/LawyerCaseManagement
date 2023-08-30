<?php
include "include/function.php";

if (!isset($_SESSION['loginUser']) and empty($_SESSION['loginUser'][0]) and empty($_SESSION['loginUser'][1])) 
{
    header('location:login.php');
}
else if (!isset($_GET['case_id']) AND !is_numeric($_GET['case_id'])) 
{
    header('location:case.php');
}

$caseID=$_GET['case_id'];
$userData = getUser($_SESSION['loginUser'][0]);
$userID=$_SESSION['loginUser'][1];

 $run=$con->prepare('SELECT `cases`.*,`hearing`.*, `cases`.`id` AS case_id, `client`.* FROM `cases` JOIN `client` ON `cases`.`client_id` = `client`.`id` JOIN `hearing` ON `hearing`.`case_id` = `cases`.`id` WHERE `cases`.`user_id` =? AND `cases`.`id` =? GROUP BY `hearing`.`h_id` ORDER BY `hearing`.`h_id` ASC');

 $run->bindParam(1,$userID,PDO::PARAM_INT);
 $run->bindParam(2,$caseID,PDO::PARAM_INT);

 if($run->execute())
 {
     if($run->rowCount()>0)
     {
       $allCases=$run->fetchAll(PDO::FETCH_ASSOC);
     }
     else
     {
        header('location:case.php');
     }
 }

//check($allCases);
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

                       
                        <input type="text" name="search" class="form-control search" placeholder="Search"><br>
                        <center><button id="print-button" class="btn btn-primary">Print All Data</button></center>
                        <br><br>
                       
                        <div class="row">
                            <div class="col-12 printable-content">
                                <center>
                                    <b>Client Name :- &nbsp;</b><span><?php echo htmlspecialchars(ucwords($allCases[0]['fullname'])); ?></span> &nbsp;&nbsp;&nbsp;
                                    <b>Case No :- &nbsp; </b><span><?php echo $allCases[0]['case_no']; ?></span> &nbsp;&nbsp;&nbsp;
                                    <b>Cnic No :- &nbsp;</b><span><?php echo $allCases[0]['cnic']; ?></span> 
                                </center><br><br>

                                <?php 
                                 foreach ($allCases as $key => $value) 
                                 {
                                    if(empty($value['judge_remarks']))
                                    {
                                        $judge_remarks="Not Attend";
                                    }
                                    else
                                    {
                                        $judge_remarks=$value['judge_remarks'];
                                    }

                                    echo ' <div style="margin: 50px;">
                                                <b>Hearing Date:- &nbsp;</b> '.$value['next_hearing'].'<br>
                                                 <p><b>Judge Remarks:- &nbsp;</b> '.$judge_remarks.'</p><hr>
                                            </div>';
                                 }
                                ?>
                               
                            </div>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>
        </div>


 

 <?php include "include/jsLinks.php"; ?>
</body>

</html>
