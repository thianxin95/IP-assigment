<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 
 *
 * @author Chang kwok Fei
 */
include ('../Object/EmployeeOB.php');
session_start();

$user = new Employee("", "", "", "", "", "", "","","","");
if ($_SESSION["employee"] == null) {
    echo "<script> location.href='../login.php'; </script>";
}
$user = $_SESSION["employee"];
$Username = $user->getUserID();
$Username = $user->getUserID();
$realName=$user->getName();
$address =$user->getAddress();
$phone =$user->getPhone();
$password =$user->getPassword();
$email = $user->getEmail();

//Check user if it was employee, if not, for logout and back to login.php
if ($user->getUserType() != "Employee") {
    session_destroy();
    session_unset();
    echo "<script> location.href='../login.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include('../PageTitle.php') ?>
        <!-- plugins:css -->
        <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="../css/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="images/favicon.png" />
    </head>

    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="index.php">Fiore Flowershop</a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <div class="search-field d-none d-md-block">
                        <form class="d-flex align-items-center h-100" action="#">

                        </form>
                    </div>
                    <?php include('NavBar.php') ?>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
        </div>
        <!-- partial --
        <!-- Side Menu -->
        <?php include('SideMenu.php') ?>
        <!-- Side Menu -->
        <div class="main-panel">
            <div class="content-wrapper">
                <!-- WRITE YOUR CODE HERE! -->
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Welcome to Employee Profile</h4>
                            <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>User ID:</td>
                        <td><?php echo($Username) ?></td>
                      </tr>
                      <tr>
                        <td>Name</td>
                        <td><?php echo($realName) ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?php echo($email) ?></td>
                      </tr>    
                      <tr>
                        <td>Password</td>
                        <td><?php echo($password) ?></td>
                      </tr>
                        <td>Phone Number</td>
                        <td><?php echo($phone) ?>
                        </td>
                         <tr>
                        <td>Home Address:</td>
                        <td><?php echo($address) ?></td>
                      </tr>
                           
                      
                     
                    </tbody>
                  </table>
                  
                            <a href="employeeUpdate.php" class="btn btn-primary" >Edit Profile</a>
               
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php include('../Footer.php') ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->

        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../vendors/js/vendor.bundle.base.js"></script>
        <script src="../vendors/js/vendor.bundle.addons.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="../js/off-canvas.js"></script>
        <script src="../js/misc.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <!-- End custom js for this page-->
    </body>

</html>

