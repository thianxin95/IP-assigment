<?php
include ('Object/CustomerOb.php');

session_start();

$user = new Customer("", "", "", "", "", "", "", "", "","");
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
?>


<!DOCTYPE html>
<html lang="en">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <?php include('PageTitle.php') ?>
        <!-- plugins:css -->
        <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
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
                                    <h4 class="card-title">Full Product Catalog</h4>
                                    <table class="table table-bordered">
                                        
                                        <thead>
                                            <tr>
                                                <th>Product Code</th>
                                                <th>Product Type</th>
                                                <th>Product Description</th>
                                                <th>Stock Availability</th>
                                                <th>Product Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php 
                                            include ('databaseconn.php');
                                            $conn = Database::getInstance();
                                            $query = "SELECT * FROM product";
                                            $product_result = $conn->query($query);
                                            if(!$product_result){
                                                trigger_error('Invalid query: ' . $conn->error);
                                                
                                            }
                                            
                                            $conn->close();
                                            
                                            if($product_result){
                                                while($row = $product_result->fetch(PDO::FETCH_ASSOC)){
                                                    $productCode = $row["productCode"];
                                                    $productType = $row["producttype"];
                                                    $productDescrip = $row["productdes"];
                                                    $productAvail = $row["Availability"];
                                                    $productPrice = $row["price"];
                                                    
                                                    echo("<tr>");
                                                    echo("<td>$productCode</td>");
                                                    echo("<td>$productType</td>");
                                                    echo("<td>$productDescrip</td>");
                                                    echo("<td>$productAvail</td>");
                                                    echo("<td>$productPrice</td>");
                                                    echo("</tr>");
                                                    
                                                }
                                                
                                                }
                                                ?>
                                    </table>
                                </div>
                            </div>    
                        </div>
                        
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form action="CatalogView.php" method="POST">
                                        <div class="form-group">
                                            <label>Which product would like to update : </label><br>
                                            <input type="text" name="productupdate"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Change Availability to : </label><br>
                                            <input type="text" name="textchange"/>
                                        </div>
                                        <input type="submit" value="Submit" name="Submit"/>
                                    </form>
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
            
            <?php 
            if(isset($_POST["Submit"])){
                $productCode = $_POST['productupdate'];
                $textChange = $_POST['textchange'];
                
                $updatequery = "UPDATE product SET Availability = '$textChange' WHERE productCode = '$productCode'";
                $stmt = $conn->query($updatequery);
                $stmt->execute();
                
            }
            ?>
        
        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
    </body>
</html>