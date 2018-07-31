<?php 
include ('Object/CustomerOb.php');
session_start();

$user = new Customer("","","","","","","");
$user = $_SESSION["user"];
if($_SESSION["user"] == null){
    echo "<script> location.href='login.php'; </script>";
}
//Check user if it was employee, if not, for logout and back to login.php
if($user->getUserType() != "Customer"){
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
                        include ('databaseconn.php');
                        //$conn = new mysqli($servername, $db_user, $db_password, $db_table);
                        $conn = Database::getInstance();
                        $query = "SELECT * FROM orders WHERE userID = '$Username'";
                        $orderlist_result = $conn->query($query);
                        if(!$orderlist_result){
                            trigger_error('Invalid query: ' . $conn->error);
                        }
                        $conn->close();
                        if($orderlist_result){
                            while($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)){
                               $orderID = $row["orderID"];
                               $orderDate = $row["orderDate"];
                               $Pickup = $row["Pickup"];
                               $DelvieryAddress = $row["DeliveryAddress"];
                               $RequiredDate = $row["RequiredDate"];
                               $TotalAmount = $row["TotalAmount"];
                               $Status = $row["Status"];
                               echo("<tr>");
                                    echo("<td>$orderID</td>");
                                    echo("<td>$orderDate</td>");
                                    echo("<td>$Pickup</td>");
                                    echo("<td>$DelvieryAddress</td>");
                                    echo("<td>$RequiredDate</td>");
                                    echo("<td>$TotalAmount</td>");
                                    echo("<td>$Status</td>");
                                    echo("<td><button type=\"button\" class=\"btn btn-gradient-primary btn-fw\" data-toggle=\"modal\" data-target=\"#$orderID\">Order Details</button></td>");
                               echo("</tr>");
                                }
                        }
                               ?> 
                            </tbody>
                        </table>
                        <?php 
                        //$conn4 = new mysqli($servername, $db_user, $db_password, $db_table);
                        $conn4 = $conn = Database::getInstance();
                        $query4 = "SELECT * FROM orders WHERE userID = '$Username'";
                        $orderlist_result_modal = $conn4->query($query);
                        if(!$orderlist_result_modal){
                            trigger_error('Invalid query: ' . $conn->error);
                        }
                        $conn4->close();
                        if($orderlist_result_modal){
                            while($row = $orderlist_result_modal->fetch(PDO::FETCH_ASSOC)){
                                $orderID = $row["orderID"];
                        ?>
                         <div class="modal fade" id="<?php echo($orderID); ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo($orderID);  ?>" aria-hidden="true">
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
                                                        $conn2 = $conn = Database::getInstance();
                                                        $query2 = "SELECT * FROM orderdetails WHERE orderId = '$orderID'";
                                                        $orderdetails_result = $conn2->query($query2);
                                                        if(!$orderdetails_result){
                                                            trigger_error('Invalid query: ' . $conn->error);
                                                        }
                                                        $conn2->close();
                                                        if($orderdetails_result){
                                                            while($row2 = $orderdetails_result->fetch(PDO::FETCH_ASSOC)){
                                                                $productcode = $row2["productCode"];
                                                                $Quantity = $row2["Quantity"];
                                                                $UnitPrice = $row2["UnitPrice"];
                                                                $productdes = "";
                                                                // $conn3 = new mysqli($servername, $db_user, $db_password, $db_table);
                                                                $conn3 = $conn = Database::getInstance();
                                                                $query3 = "SELECT * FROM product WHERE productcode = '$productcode'";
                                                                $product_result = $conn3->query($query3);
                                                                if(!$product_result){
                                                                    trigger_error('Invalid query: ' . $conn->error);
                                                                }
                                                                $conn3->close();
                                                                $product_list = $product_result->fetch(PDO::FETCH_ASSOC);
                                                                $productdes = $product_list["productdes"];
                                                                // we got all what we needed
                                                                echo("<tr>");
                                                                    echo("<td>$productdes</td>");
                                                                    echo("<td>$Quantity</td>");
                                                                    echo("<td>$UnitPrice</td>");
                                                                echo("</tr>");
                                                            }
                                                        }
                                                    
                                                    ?>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">OK</button>
                                        </div>
                                      </div>
                                    </div>
                         </div>
                        <?php } 
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
