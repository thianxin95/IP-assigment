<?php
include_once ('../Object/EmployeeOB.php');
include_once ('../databaseconn.php');
include_once ('../Object/CustomOrder.php');
include_once ('../Controller/ManageCOrderControl.php');
include_once ('ReportXML/ReportController.php');
include_once('../Object/DailyRecordOB.php');
include_once('../Object/BouquetItem.php');
$xmlPath = "ReportXML/Daily_OrderProcessed.xml";
session_start();

$user = new Employee("", "", "", "", "", "", "", "", "", "");
if ($_SESSION["employee"] == null) {
    echo "<script> location.href='../login.php'; </script>";
}
$user = $_SESSION["employee"];
$Username = $user->getUserID();
//Check user if it was employee, if not, for logout and back to login.php
if ($user->getUserType() != "Employee") {
    session_destroy();
    session_unset();
    echo "<script> location.href='../login.php'; </script>";
}
$ordercont = new ManageCOrderControl();
if (isset($_POST['paid_fullfiled'])) {
    $order_update = $_POST['order_update'];
    // Update Daily Report Generate XML HERE!!!
    //Testing XML and WORKING!!!!
    $order = new CustomOrder("", "", "", "", "", "", "");
    $order = $ordercont->getCustomOrder($order_update);
    $AmountPaid = 0;
    $Delivery = 0;
    $Pickup = 0;
    $OrderPaid = 1; 
    if ($order[0]->getPaymentStatus() == "Cash Paid") {
        $AmountPaid = 0;
        $OrderPaid = 0;
    }
    if ($order[0]->getPickup() == "Yes" | $order[0]->getPickup() == "yes") {
        $Pickup = 1;
    } else {
        $Delivery = 1;
    }



    $report_controller = new ReportController($xmlPath);
    $report_controller->updateDaily($AmountPaid, $Delivery, $Pickup, 0, $OrderPaid);
    $Status = "Completed";
    $ordercont->updateStatus($order_update, $Status);
}
if (isset($_POST['CashPaid'])) {
    $order_update = $_POST['order_update'];
    $order = new CustomOrder("", "", "", "", "", "", "");
    $order = $ordercont->getCustomOrder($order_update);
    $AmountPaid = $order[0]->getTotalAmt();

    // Update Daily Report Generate XML HERE!!!

    $report_controller = new ReportController($xmlPath);
    $report_controller->updateDaily($AmountPaid, 0, 0, 0, 1);



    $Status = "Cash Paid";
    $ordercont->updateStatus($order_update, $Status);
}

if (isset($_POST['Order_Canceled'])) {
    $order_update = $_POST['order_update'];


    // Update Daily Report Generate XML HERE!!!
    $report_controller = new ReportController($xmlPath);
    $report_controller->updateDaily(0, 0, 0, 1, 0);



    $Status = "Canceled";
    $ordercont->updateStatus($order_update, $Status);
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
        <!-- partial -->
        <!-- Side Menu -->
        <?php include('SideMenu.php') ?>
        <!-- Side Menu -->
        <div class="main-panel">
            <div class="content-wrapper">
                <!-- WRITE YOUR CODE HERE! -->
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Manage Custom Orders</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Custom order ID</th>
                                        <th>Pickup?</th>
                                        <th>Delivery Address</th>
                                        <th>Required Date</th>
                                        <th>Order Amount</th>
                                        <th>Order Status </th>
                                        <th>Order By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $orderlist = $ordercont->getAllCustomOrders();
                                    for ($x = 0; $x < count($orderlist); $x++) {

                                        $orderID = $orderlist[$x]->getCustOrderID();
                                        $Pickup = $orderlist[$x]->getPickup();
                                        $DelvieryAddress = $orderlist[$x]->getDeliveryAdd();
                                        $RequiredDate = $orderlist[$x]->getRequireDate();
                                        $TotalAmount = $orderlist[$x]->getTotalAmt();

                                        $Status = $orderlist[$x]->getPaymentStatus();
                                        $Name = $ordercont->getOrderBy($orderlist[$x]->getCustOrderID());
                                        echo("<tr>");
                                        echo("<td>$orderID</td>");
                                        echo("<td>$Pickup</td>");
                                        echo("<td>$DelvieryAddress</td>");
                                        echo("<td>$RequiredDate</td>");
                                        echo("<td>$TotalAmount</td>");

                                        echo("<td>$Status</td>");
                                        echo("<td>$Name</td>");
                                        if ($Status != "Completed" & $Status != "Canceled") {
                                            echo("<td><button type=\"button\" class=\"btn btn-gradient-primary btn-fw\" data-toggle=\"modal\" data-target=\"#$orderID\">Manage Order</button></td>");
                                        } else {
                                            echo("<td>No Action Required</td>");
                                        }
                                        echo("</tr>");
                                    }
                                    ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                for ($x = 0; $x < count($orderlist); $x++) {
                    $orderID = $orderlist[$x]->getCustOrderID();
                    ?>
                    <div class="modal fade" id="<?php echo($orderID); ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo($orderID); ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
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
                                                $orderdes = $ordercont->getBouquetItem($orderID);
                                                for ($y = 0; $y < count($orderdes); $y++) {
                                                    $productcode = $orderdes[$y]->getProductCode();
                                                    $Quantity = $orderdes[$y]->getQuantity();
                                                    $UnitPrice = $orderdes[$y]->getUnitPrice();
                                                    $productdes = $ordercont->getProductDes($productcode);

                                                    // we got all what we needed
                                                    echo("<tr>");
                                                    echo("<td>$productdes</td>");
                                                    echo("<td>$Quantity</td>");
                                                    echo("<td>$UnitPrice</td>");
                                                    echo("</tr>");
                                                }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>
                                    <h6 class="modal-title" id="label_loggedout">Warning! Irreversible Action</h6>
                                    <form action="ManageCustomorder.php" method="post">
                                        <input type="hidden" id="order_update" name="order_update" value="<?php echo($orderID) ?>"  />
                                        <?php if ($orderlist[$x]->getPaymentStatus() == "Paid" | $orderlist[$x]->getPaymentStatus() == "Cash Paid") { ?>
                                            <button type="submit" class="btn btn-gradient-primary" name="paid_fullfiled" id="paid_fullfiled">Completed</button>
                                        <?php } if ($orderlist[$x]->getPaymentStatus() == "Unpaid") { ?>
                                            <button type="submit" class="btn btn-gradient-primary" name="CashPaid" id="CashPaid">Paid By Cash</button>
                                        <?php } ?>  
                                        <button type="submit" class="btn btn-gradient-danger" name="Order_Canceled" id="Order_Canceled">Canceled</button>
                                    </form>
                                </div>                           
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">CLOSE</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                <?php } ?>
                <!-- content-wrapper ends -->
            </div>

            <!-- partial:partials/_footer.html -->
            <?php include('../Footer.php') ?>
            <!-- partial -->

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
