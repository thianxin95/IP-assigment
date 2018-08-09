<?php
include ('../Object/EmployeeOB.php');
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
<html lang="en">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

author : Chen Chun Hang
-->
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <?php include('../PageTitle.php') ?>
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
                                    <h4 class="card-title">Create Monthly Catalog</h4>
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
                                            include ('../databaseconn.php');
                                            $conn = Database::getInstance();
                                            $query = "SELECT * FROM product WHERE Availability = 'Available'";
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>    
                        </div>
                        
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form action="CreateMonthlyCatalog.php" method="POST">
                                        <label>Enter product to be shown in 
                                            <select name="monthdroplist">
                                                <option>January</option>
                                                <option>February</option>
                                                <option>March</option>
                                                <option>April</option>
                                                <option>May</option>
                                                <option>June</option>
                                                <option>July</option>
                                                <option>August</option>
                                                <option>September</option>
                                                <option>October</option>
                                                <option>November</option>
                                                <option>December</option>
                                            </select> Catalog </label><br>
                                            
                                            <label>Enter the product to be showed : </label><br>
                                            <div class="form-group">
                                               <label>Product 1 : </label><br><input type="text" name="product1"/> 
                                            </div>
                                            <div class="form-group">
                                                <label>Product 2 : </label><br><input type="text" name="product2"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Product 3 : </label><br><input type="text" name="product3"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Product 4 : </label><br><input type="text" name="product4"/>
                                            </div>
                                            <div class="form-group">
                                               <label>Product 5 : </label><br><input type="text" name="product5"/> 
                                            </div>
                                            
                                            <input type="submit" name="Submit" value="Submit" />
                                    </form>
                                </div>
                                    <?php
                                    if(isset($_POST["Submit"])){
                                        $product1 = $_POST['product1'];
                                        $product2 = $_POST['product2'];
                                        $product3 = $_POST['product3'];
                                        $product4 = $_POST['product4'];
                                        $product5 = $_POST['product5'];
                                        
                                        $error;
                                        
                                        $validation = new CatalogValidation();
                                        
                                        if(!empty($product1)){
                                            $result = $validation->checkProductAvailable($product1);
                                            if(empty($result)){
                                                $error .= "(Product 1)Please Select Item that is Listed <br>";
                                            }
                                        }
                                        
                                        if(!empty($product2)){
                                            $result = $validation->checkProductAvailable($product2);
                                            if(empty($result)){
                                                $error .= "(Product 2)Please Select Item that is Listed <br>";
                                            }
                                        }
                                        
                                        if(!empty($product3)){
                                            $result = $validation->checkProductAvailable($product3);
                                            if(empty($result)){
                                                $error .= "(Product 3)Please Select Item that is Listed <br>";
                                            }
                                        }
                                        
                                        if(!empty($product4)){
                                            $result = $validation->checkProductAvailable($product4);
                                            if(empty($result)){
                                                $error .= "(Product 4)Please Select Item that is Listed <br>";
                                            }
                                        }
                                        
                                        if(!empty($product5)){
                                            $result = $validation->checkProductAvailable($product5);
                                            if(empty($result)){
                                                $error .= "(Product 5)Please Select Item that is Listed <br>";
                                            }
                                        }
                                        
                                        if(!empty($error)){
                                            echo "$error";
                                        }else{
                                           $selectquery = "SELECT * FROM product WHERE productCode = '$product1' OR productCode = '$product2' "
                                                . "OR productCode = '$product3'  OR productCode = '$product4'  OR productCode = '$product5' ";
                                        
                                        $productArray = array();
                                        
                                        $result = $conn->query($selectquery);
                                        
                                        if(!$result){
                                            trigger_error('Invalid query: ' . $conn->error);
                                            
                                        }
                                        
                                        if($result){
                                            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                                array_push($productArray, $row);
                                                
                                            }
                                            
                                            }
                                            
                                        if(count($productArray)){
                                            createXMLfile($productArray);
                                            
                                        } 
                                        }

                                        $conn->close();
                                        
                                        }
                                        
                                        function createXMLfile($productArray){
                                            $month = $_POST['monthdroplist'];
                                            $catalogCode = "1001";
                                            
                                            $filePath = "../Catalog/xsl/flowercatalog.xml";
                                            
                                            $dom = new DOMDocument("1.0","utf-8");
                                            $xslt = $dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="flower.xsl"');
                                            $dom->appendChild($xslt);
                                            
                                            $root = $dom->createElement("catalogs");
                                            $root->setAttribute("catalogID", $catalogCode);
                                            $root->setAttribute("month", $month);
                                            
                                            for($i = 0; $i<count($productArray); $i++){
                                                $catalogid = $productArray[$i]["productCode"];
                                                $catalogtype = $productArray[$i]["producttype"];
                                                $catalogdes = $productArray[$i]["productdes"];
                                                $catalogavail = $productArray[$i]["Availability"];
                                                $catalogprice = $productArray[$i]["price"];
                                                $catalog = $dom->createElement("catalog");
                                                $id = $dom->createElement("code", $catalogid);
                                                $catalog->appendChild($id);
                                                $type = $dom->createElement("type", $catalogtype);
                                                $catalog->appendChild($type);
                                                $des = $dom->createElement("description", $catalogdes);
                                                $catalog->appendChild($des);
                                                $stock = $dom->createElement("stock", $catalogavail);
                                                $catalog->appendChild($stock);
                                                $price = $dom->createElement("price", $catalogprice);
                                                $catalog->appendChild($price);
                                                
                                                $root->appendChild($catalog);
                                                
                                            }
                                            
                                            $dom->appendChild($root);
                                            $dom->save($filePath);
                                            
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
        <!-- endinject -->
        <!-- Custom js for this page-->
        <!-- End custom js for this page-->    
    </body>
</html>