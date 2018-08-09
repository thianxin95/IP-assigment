<?php
include ('../Object/EmployeeOB.php');
include ('../Object/ProductOB.php');
include ('../Function/CatalogValidation.php');

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
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

author : Chen Chun Hang

-->
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include('../PageTitle.php')  ?>
        <!-- plugins:css -->
        <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
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
                                    <form action="AddNewItem.php" method="POST">
                                    <div class="form-group">
                                        <label>Product Code : </label><br>
                                        <input type="text" name="productcode"/>
                                    </div>
                                    <div class="form-group">
                                       <label>Product Type : </label><br>
                                       <input type="text" name="producttype"/>
                                    </div>
                                    <div class="form-group">
                                       <label>Product Description : </label><br>
                                       <input type="text" name="productdes"/>
                                    </div>
                                    <div class="form-group">
                                       <label>Product Price : </label><br>
                                       <input type="text" name="productprice"/>
                                    </div>
                                    <input type="submit" value="Submit" name="Submit"/>
                                </form>
                                </div>
                                    <?php
                                    if(isset($_POST["Submit"])){
                                        
                                        $productCode;
                                        $productType;
                                        $productDes;
                                        $productAvailable = "Available";
                                        $productPrice;
                                        $error;
                                        
                                        if(empty($_POST['productcode'])){
                                            $error .= "Product Code cannot be empty </br>";  
                                        }else{
                                            $productCode = $_POST['productcode'];
                                            $validation = new CatalogValidation();
                                            $result = $validation->checkProductCode($productCode);
                                            if(!empty($result)){
                                                $error.= "This Product Code has been used <br>";
                                            }   
                                        }
                                        
                                        if(empty($_POST['producttype'])){
                                            $error .= "Product Type cannot be empty </br>";  
                                        }else{
                                            $productType = $_POST['producttype'];
                                        }
                                        
                                        if(empty($_POST['productdes'])){
                                            $error .= "Product Description cannot be empty </br>";  
                                        }else{
                                            $productDes = $_POST['productdes'];
                                        }
 
                                        if(empty($_POST['productprice'])){
                                            $error .= "Product Description cannot be empty </br>";  
                                        }else{
                                            $productPrice = $_POST['productprice'];
                                            
                                            if(!ctype_digit($productPrice)){
                                                $error .= "Please enter digit At Price </br>";
                                            
                                            }
                                        }
                                        
                                        if(empty($error)){
                                            $checkCode = new ProductOB($productCode, $productType, $productDes, $productAvailable, $productPrice);
                                            
                                            $code = $checkCode->getProductCode();
                                            $type = $checkCode->getProductType();
                                            $description = $checkCode->getProductDes();
                                            $availability = $checkCode->getAvailability();
                                            $price = $checkCode->getPrice();
                                            
                                            include ('../databaseconn.php');
                                            $conn = Database::getInstance();
                                            $query = "INSERT INTO product (`productCode`, `producttype`, `productdes`, `Availability`, `price`) VALUES ('$code','$type','$description','$availability','$price')";
                                            $product_result = $conn->query($query);
                                            
                                            if(!$product_result){
                                                trigger_error('Invalid query: ' . $conn->error);
                                                
                                            }else{
                                                echo "The Item has been recorded <br>";
                                                echo "Item Code : $code <br>";
                                                echo "Item Type : $type <br>";
                                                echo "Item Description : $description <br>";
                                                echo "Item Availability : $availability <br>";
                                                echo "Item Price : $price <br>";
                                                
                                            }
                                            
                                            $conn->close();
                                            
                                            }else{
                                                echo "$error";  
                                            }
                                            
                                            }
                                            ?>
                            </div>
                        </div>
                        <!-- content-wrapper ends -->
                        <!-- partial:partials/_footer.html -->
                        <!-- partial -->
                    </div>
                    <!-- main-panel ends -->
                        <?php include('../Footer.php') ?>
                </div>
                <!-- page-body-wrapper ends -->
            </div>
        </div>
            
            
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

    </body>
</html>