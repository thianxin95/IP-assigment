<?php
include ('Object/CustomerOb.php');
include_once 'Controller/OrderListController.php';
include_once 'Object/OrderDetailsOB.php';
session_start();

$user = new Customer("", "", "", "", "", "", "", "", "", "");
$user = $_SESSION["user"];
if ($_SESSION["user"] == null) {
    echo "<script> location.href='login.php'; </script>";
}
//Check user if it was employee, if not, for logout and back to login.php
if ($user->getUserType() != "Customer" & $user->getUserType() != "Corporate") {
    session_destroy();
    session_unset();
    echo "<script> location.href='login.php'; </script>";
}

$Username = $user->getUserID();
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
                    <div class="content-wrapper">
                        <!-- WRITE YOUR CODE HERE! -->
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Order List</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Order Date</th>
                                                <th>Pickup?</th>
                                                <th>Delivery Address</th>
                                                <th>Required Date</th>
                                                <th>Order Amount</th>
                                                <th>Payment Status </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ordCon = new OrderListController();
                                            $ordlist = $ordCon->getOrderUserID($Username);
                                            if (!empty($ordlist)) {
                                                for ($i = 0; $i < count($ordlist); $i++) {
                                                    echo("<tr>");
                                                    echo("<td>" . $ordlist[$i]->getOrderID() . "</td>");
                                                    echo("<td>" . $ordlist[$i]->getOrderDate() . "</td>");
                                                    echo("<td>" . $ordlist[$i]->getPickup() . "</td>");
                                                    echo("<td>" . $ordlist[$i]->getDeliveryAddress() . "</td>");
                                                    echo("<td>" . $ordlist[$i]->getRequiredDate() . "</td>");
                                                    echo("<td>" . $ordlist[$i]->getTotalAmount() . "</td>");
                                                    echo("<td>" . $ordlist[$i]->getStatus() . "</td>");
                                                    echo("<td><button type=\"button\" class=\"btn btn-gradient-primary btn-fw\" data-toggle=\"modal\" data-target=\"#" . $ordlist[$i]->getOrderID() . "\">Order Details</button></td>");
                                                    echo("</tr>");
                                                }
                                            }
                                            ?> 
                                        </tbody>
                                    </table>
                                    <?php
                                    if (!empty($ordlist)) {
                                        echo("Total orders = " . count($ordlist));

                                        for ($i = 0; $i < count($ordlist); $i++) {
                                            $orderID = $ordlist[$i]->getOrderID();
                                            ?>
                                            <div class="modal fade" id="<?php echo($orderID); ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo($orderID); ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="label_loggedout">Order Details</h5>
                                                            <!--   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                 <span aria-hidden="true">&times;</span>
                                                               </button> -->
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-dark">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product Name</th>
                                                                        <th>Quantity</th>
                                                                        <th>Unit Price</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <?php
                                                                        //$conn2 = new mysqli($servername, $db_user, $db_password, $db_table);
                                                                        $product_count = 0;
                                                                        $detaillist = $ordCon->getDetailsOrderID($orderID);
                                                                        for ($m = 0; $m < count($detaillist); $m++) {
                                                                            $productcode = $detaillist[$m]->getProductCode();
                                                                            $Quantity = $detaillist[$m]->getQuantity();
                                                                            $UnitPrice = $detaillist[$m]->getUnitPrice();
                                                                            $productdes = $ordCon->getProductDes($productcode);

                                                                            // we got all what we needed
                                                                            echo("<tr>");
                                                                            echo("<td>$productdes</td>");
                                                                            echo("<td>$Quantity</td>");
                                                                            echo("<td>$UnitPrice</td>");
                                                                            echo("</tr>");
                                                                            $product_count++;
                                                                        }
                                                                        ?>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <?php echo("Product Count = " . $product_count); ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">OK</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- content-wrapper ends -->
                        <!-- partial:partials/_footer.html -->
                        <!-- partial -->
                    </div>
                    <!-- main-panel ends -->
                    <?php include('Footer.php') ?>
                </div>
                <!-- page-body-wrapper ends -->
            </div>
        </div>
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
