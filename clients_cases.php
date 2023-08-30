
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
       
    <?php include "include/header.php" ?>

    <?php include "include/sidebar.php" ?>
    <div class="page-wrapper">


    <div class="container-fluid">

        <div class="row">

            <div class="table-responsive" id="result">
                <table class="table table-hover responsive-table">
                    <thead>
                        <tr>
                            <th scope="col"><b>Client Name</b></th>
                            <th scope="col"><b>Behalf of</b></th>
                            <th scope="col"><b>Case no</b></th>
                            <th scope="col"><b>Case type</b></th>
                            <th scope="col"><b>Court name </b></th>
                            <th scope="col"><b>Case date </b></th>
                            <th scope="col"><b>U-section </b></th>
                            <th scope="col"><b>Hearing </b></th>
                            <th scope="col"><b>Previous Hearing</b> </th>
                            <th scope="col"><b>Judge Remarks </b></th>
                            <th scope="col"><b>Next Hearing </b></th>
                            <th scope="col"><b>Add </b></th>
                            <th scope="col"><b>Edit </b></th>
                            <th scope="col"><b>Delete </b></th>
                        </tr>
                    </thead>
                    <tbody>
            

                            <tr>
                                <td>ijaz</td>
                                <td>1</td>
                                <td>2323</td>
                                <td></td>
                                <td>testings</td>
                                <td>2023-05-18</td>
                                <td>fjsfjflksjflksdjf</td>
                                <td>dgdfgdgfdgdfg</td>
                                <td>2023-05-10</td>
                                <td>gdfgdfgdf</td>
                                <td>2023-05-04</td>
                                <td></td>                                    <td>
                                    <a href="p_detail_edit.php?id=6" type="button" class="btn btn btn-outline-light"><img src="images/edit.png" style="width: 40px;" alt=""></a>
                                </td>
                                <td>
                                    <a href="p_detail_delete.php?id=6" type="button" class="btn btn btn-outline-light"><img src="images/trash.png" style="width: 40px;" alt=""></a>
                                </td>
                            </tr>

                 


                            <tr>
                                <th scope="row">Javid</th>
                                <th scope="row"> ali</th>
                                <th scope="row">21708-1121114-7</th>
                                <th scope="row">03055173887</th>
                                <th scope="row">peshawar</th>
                                <td>farhan</td>
                                <td>1</td>
                                <td>2323</td>
                                <td></td>
                                <td>testings</td>
                                <td>2023-05-18</td>
                                <td>fjsfjflksjflksdjf</td>
                                <td>dgdfgdgfdgdfg</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                    <td> <a href="add-detail.php?id=9" class="btn btn-light">
                                        <img src="files/images/add-file.png" style="width: 40px;" id="case">
                                    </a></td>

                                <td>
                                    <a href="p_detail_edit.php?id=9" type="button" class="btn btn btn-outline-light"><img src="files/images/edit.png" style="width: 40px;" alt=""></a>
                                </td>
                                <td>
                                    <a href="p_detail_delete.php?id=9" type="button" class="btn btn btn-outline-light"><img src="files/images/trash.png" style="width: 40px;" alt=""></a>
                                </td>
                            </tr>

                    

                            <tr>
                                <th scope="row">zohaib</th>
                                <th scope="row">d</th>
                                <th scope="row">d</th>
                                <th scope="row">d</th>
                                <th scope="row">d</th>
                                <td>d</td>
                                <td>1</td>
                                <td>d</td>
                                <td></td>
                                <td>testings</td>
                                <td>2023-06-17</td>
                                <td>d</td>
                                <td>d</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                    <td> <a href="add-detail.php?id=11" class="btn btn-light">
                                        <img src="files/images/add-file.png" style="width: 40px;" id="case">
                                    </a></td>

                                <td>
                                    <a href="p_detail_edit.php?id=11" type="button" class="btn btn btn-outline-light"><img src="files/images/edit.png" style="width: 40px;" alt=""></a>
                                </td>
                                <td>
                                    <a href="p_detail_delete.php?id=11" type="button" class="btn btn btn-outline-light"><img src="files/images/trash.png" style="width: 40px;" alt=""></a>
                                </td>
                            </tr>

                        <br />
                            <tr>
                                <th scope="row">zohaib</th>
                                <th scope="row">khan</th>
                                <th scope="row">d</th>
                                <th scope="row">d</th>
                                <th scope="row">d</th>
                                <td>d</td>
                                <td>1</td>
                                <td>d</td>
                                <td></td>
                                <td>testings</td>
                                <td>2023-06-02</td>
                                <td>d</td>
                                <td>d</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                    <td> <a href="add-detail.php?id=12" class="btn btn-light">
                                        <img src="files/images/add-file.png" style="width: 40px;" id="case">
                                    </a></td>

                                <td>
                                    <a href="p_detail_edit.php?id=12" type="button" class="btn btn btn-outline-light"><img src="files/images/edit.png" style="width: 40px;" alt=""></a>
                                </td>
                                <td>
                                    <a href="p_detail_delete.php?id=12" type="button" class="btn btn btn-outline-light"><img src="files/images/trash.png" style="width: 40px;" alt=""></a>
                                </td>
                            </tr>

                        <br />
                            <tr>
                                <th scope="row">zohaib</th>
                                <th scope="row">a</th>
                                <th scope="row">a</th>
                                <th scope="row">a</th>
                                <th scope="row">a</th>
                                <td>a</td>
                                <td>1</td>
                                <td>a</td>
                                <td></td>
                                <td>testings</td>
                                <td>2023-06-02</td>
                                <td>a</td>
                                <td>a</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                                                    <td> <a href="add-detail.php?id=13" class="btn btn-light">
                                        <img src="files/images/add-file.png" style="width: 40px;" id="case">
                                    </a></td>

                                                                        <td>
                                    <a href="p_detail_edit.php?id=13" type="button" class="btn btn btn-outline-light"><img src="files/images/edit.png" style="width: 40px;" alt=""></a>
                                </td>
                                <td>
                                    <a href="p_detail_delete.php?id=13" type="button" class="btn btn btn-outline-light"><img src="files/images/trash.png" style="width: 40px;" alt=""></a>
                                </td>
                            </tr>

                                                    <td> <a href="personal_details.php" class="btn btn-light">
                                <img src="files/images/add-file.png" style="width: 40px;" id="case">
                            </a></td>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    </div>
</div>


 
 <?php include "include/jsLinks.php"; ?>
</body>

</html>
