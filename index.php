<?php
include ('Object/CustomerOb.php');
include_once('Controller/DashController.php');
session_start();
$user = new Customer("", "", "", "", "", "", "", "", "", "");
if ($_SESSION["user"] == null) {
    echo "<script> location.href='login.php'; </script>";
}
$user = $_SESSION["user"];
$Username = $user->getUserID();
$userInvoice= $user->getUserType();
// Check User if it is Customer, if not force logout and back to Login.php
if ($user->getUserType() != "Customer" & $user->getUserType() != "Corporate") {
    session_destroy();
    session_unset();
    echo "<script> location.href='login.php'; </script>";
}
$today_date =  date('01-m-Y');
$today_date2=date('d-m-Y');
if($today_date==$today_date2 && $userInvoice=="Corporate" )
{
    echo "<script> location.href='getInvoice.php'; </script>";
}

$dashboard = new DashController();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include('PageTitle.php') ?>
        <!-- plugins:css -->
        <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="css/style.css">
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
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- Side Menu -->
                <?php include('SideMenu.php') ?>
                <!-- Side Menu -->
                <div class="main-panel">
                    <!-- WRITE YOUR CODE HERE! -->
                    <div class="col-13 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h3>Welcome back, <?php echo $user->getName() ?></h3>
                                <br/><h4>Here are your account's brief summary</h4>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-4 stretch-card grid-margin">
                                <div class="card bg-gradient-primary card-img-holder text-white">
                                    <div class="card-body">
                                        <h4 class="font-weight-normal mb-3">Total Orders</h4>
                                        <h2 class="mb-5"><?php echo($dashboard->getOrderCount($Username)) ?></h2>
                                        <h6 class="card-text">Subtotal = $<?php echo($dashboard->getOrderSub($Username)) ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 stretch-card grid-margin">
                                <div class="card bg-gradient-danger card-img-holder text-white">
                                    <div class="card-body">               
                                        <h4 class="font-weight-normal mb-3">Unpaid Orders</h4>
                                        <h2 class="mb-5"><?php echo($dashboard->getUnpaidCount($Username)) ?></h2>
                                        <h6 class="card-text">Subtotal = $<?php echo($dashboard->getUnpaidSub($Username)) ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 stretch-card grid-margin">
                                <div class="card bg-gradient-info card-img-holder text-white">
                                    <div class="card-body">               
                                        <h4 class="font-weight-normal mb-3">Paid and Completed Orders</h4>
                                        <h2 class="mb-5"><?php echo($dashboard->getPaidCount($Username)) ?></h2>
                                        <h6 class="card-text">$<?php echo($dashboard->getPaidSub($Username)) ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php include('Footer.php') ?>
                </div>
            </div>

        </div>


        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <!-- partial -->

        <!-- main-panel ends -->

        <!-- page-body-wrapper ends -->

        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <!-- End custom js for this page-->
    </body>

</html>
