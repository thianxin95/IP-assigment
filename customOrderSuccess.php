<?php
    ini_set('display_errors', 1);
    include_once './Object/BouquetItem.php';
    include_once './Object/CustomOrder.php';    
    include_once './Object/CustomerOb.php';
    include_once './Controller/ProductController.php';
    session_start();
    
    
    $user = new Customer("", "", "", "", "", "", "", "", "","");
        if ($_SESSION["user"] == null) {
            echo "<script> location.href='login.php'; </script>";
        }
        $user = $_SESSION["user"];
        $Username = $user->getUserID();
        $realName=$user->getName();

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
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
        <title></title>
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
                        <div class=" col-md-9 col-lg-9 "> 
        
        <?php
            $customOrder = $_SESSION["CusOrder"] ;
            $bouquet =$_SESSION["COrderItems"];
           // $cOrder = new CustomOrder("","","","","","","");
            $flowers = new BouquetItem("","","","");
            //$cOrder = $customOrder;
            if($customOrder->getPickup() == "Yes"){
                $method = "Pickup";
            }else if($customOrder->getPickup() == "No"){
                $method = "Delivery";
            }
            echo "<h4>Order placed successfully</h4>";
            echo "<table class='table'>";
            echo "<tr>";
            echo "<td>Order ID :</td>";
            echo "<td>".$customOrder->getCustOrderID()."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Customer Name :</td>";
            echo "<td>$realName</td>";
            echo "</tr>";
            echo "<td>Receive Method :</td>";
            echo "<td>$method</td>";
            echo "</tr>";
            echo "<td>Delivery Address :</td>";
            echo "<td>".$customOrder->getDeliveryAdd()."</td>";
            echo "</tr>";
            echo "<td>Delivery or pickup date and time :</td>";
            echo "<td>".$customOrder->getRequireDate()."</td>";
            echo "</tr>";
            echo "<td>Total Amount :</td>";
            echo "<td>RM ".sprintf("%.2f",$customOrder->getTotalAmt())."</td>";
            echo "</tr>";
            echo "</table>";
        ?>
        <h4>Bouquet Items</h4>
        <table class="table">
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price (RM)</th>
                <th>Total Price (RM)</th>
            </tr>
            <?php
                foreach($bouquet as $item){
                    $flowers = $item;
                    $getProd = new ProductController();
                    $prod = $getProd->getProduct($flowers->getProductCode());
                    echo "<tr>";
                    echo "<td>".$prod->getProductDes()."</td>";
                    echo "<td>".$flowers->getQuantity()."</td>";
                    echo "<td>".$flowers->getUnitPrice()."</td>";
                    echo "<td>".$flowers->getUnitPrice()* $flowers->getQuantity()."</td>"; 
                    echo "</tr>";
                }
            ?>
        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('Footer.php') ?>
                    </div>
                </div>
     
           </div>
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
