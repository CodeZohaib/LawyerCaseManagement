<header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="files/images/Case Management System (1).png" style="width: 80px;" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="files/images/Case_Management_System__1_-removebg-preview.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                            <!-- dark Logo text -->

                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="files/usersProfile/<?php echo ucwords($userData['u_profileImage']); ?>" alt="user" style="width:35px; height:35px" />
                                <span class="hidden-md-down"><?php echo ucwords($userData['u_fullName']); ?> &nbsp;</span> </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown"> 
                               <li> <center><a href='logout.php'>
                                    <button type='button' class='btn btn-light mb-0'>logout</button></center>
                                </a>
                            </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>