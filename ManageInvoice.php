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
// Check User if it is Customer, if not force logout and back to Login.php
if ($user->getUserType() != "Customer" & $user->getUserType() != "Corporate") {
    session_destroy();
    session_unset();
    echo "<script> location.href='login.php'; </script>";
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
                    <div class="content-wrapper">
                        <div class="col-13 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Welcome back, <?php echo $user->getName() ?></h3>
                                    <br/><h4>Here are your Invoices</h4>
                                    <?php
                                    include_once 'CustomerSite/InvoiceController.php';
                                    include_once 'Object/InvoiceOB.php';
                                    $invoice_control = new InvoiceController("CustomerSite/Invoice.xml");
                                    $invoices = $invoice_control->getInvoice($Username);
                                    if (!empty($invoices)) {
                                        ?>
                                        <table class="table table-user-information">
                                            <thead>
                                                <tr>
                                                    <th>Invoice No :</th>
                                                    <td><?php echo $invoices->getInvoiceNo() ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Invoice Date :</th>
                                                    <td><?php echo $invoices->getInvoiceDate() ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Invoice Amount :</th>
                                                    <td><?php echo $invoices->getInvoiceAmount() ?></td>
                                                </tr></td>
                                                </tr>
                                            </thead>
                                        </table>
                                        <br/>
                                        <h4>Pay your Invoice With Paypal</h4>
                                        <div id="paypal-button<?php echo $invoices->getInvoiceNo() ?>"></div>
                                        <!-- inject:js -->
                                        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                                        <script>
                                            paypal.Button.render({
                                                env: 'sandbox',
                                                style: {
                                                    size: 'medium',
                                                    color: 'silver',
                                                    shape: 'rect'
                                                },
                                                client: {
                                                    sandbox: 'AQV_fs31tAEGyYOyBHTvFsb-aot_BDJlsnIm71HJ0BBquf2R82_6cdR2PBurew7fraXlUEoNhQaRuAgi'
                                                },
                                                payment: function (data, actions) {
                                                    return actions.payment.create({
                                                        transactions: [{
                                                                amount: {
                                                                    total: '<?php echo $invoices->getInvoiceAmount() ?>',
                                                                    currency: 'USD'
                                                                }
                                                            }]
                                                    });
                                                },
                                                onAuthorize: function (data, actions) {
                                                    return actions.payment.execute()
                                                            .then(function () {
                                                                window.location.replace("ManageInvoice.php?paymentresult=success&InvoiceID=<?php echo $invoices->getInvoiceNo() ?>");
                                                            });
                                                }
                                            }, '#paypal-button<?php echo $invoices->getInvoiceNo() ?>');
                                        </script>
                                        <?php
                                    } else {
                                        echo '<br/><br/><h4>Hooray No Invoices yet!</h4>';
                                    }
                                    ?>   
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="paymentSuccess" tabindex="-1" role="dialog" aria-labelledby="paymentSuccess" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="label_loggedout">Payment Success</h5>
                                        <!--   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                           </button> -->
                                    </div>
                                    <div class="modal-body">
                                        <p>Thank you for your payment your payment is a Success</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="ManageInvoice.php" class="btn btn-success">OK</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('Footer.php') ?>
                </div>
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
    <?php
    ///////////////Handling Payment Success Scenario
    if (!empty($_GET)) {
        if ($_GET['paymentresult'] == "success") {
            $InvoiceNo = $_GET['InvoiceID'];
            $invoice_control->delInvoice($InvoiceNo);
            echo '<!-- inject:js -->';
            echo '<script>$("#paymentSuccess").modal()</script>';
            echo '<!-- endinject -->';
        }
    }
////////////////////////////end payment handling
    ?>
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script>$('#paymentSuccess').on('hidden.bs.modal', function () {location.href = 'ManageInvoices.php';})</script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
</body>

</html>