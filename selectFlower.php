<?php 
       ini_set('display_errors', 1);
       include_once './databaseconn.php';
       include_once './Object/ProductOB.php';
       include_once './Object/BouquetItem.php';
       include_once './Controller/ProductController.php';
       include_once './Object/CustomerOb.php';
       session_start();
       
       $user = new Customer("", "", "", "", "", "", "", "", "","");
        if ($_SESSION["user"] == null) {
            echo "<script> location.href='login.php'; </script>";
        }
        $user = $_SESSION["user"];
        $Username = $user->getUserID();
        $realName=$user->getName();
        $address =$user->getAddress();
        $phone =$user->getPhone();
        $password =$user->getPassword();
        $email = $user->getEmail();
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
                  
                  
                 
               
                
        
        <h4>Select Flowers</h4>
        
        <form method="post" action="">
            <table class="table">
                <thead>
                <tr>
                    <th>Product Code</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
            <?php
                $prod = array();
                $count = 0;
                $prodControl = new ProductController();
                $prod = $prodControl->getAvailableFlower();
                $product = new ProductOB("","","","","");
                
                foreach ($prod as $flower){
                    
                    $product = $flower;
                    echo "<tr>";
                    echo "<td>".$product->getProductCode()."</td>";
                    echo "<td>".$product->getProductDes()."</td>";
                    echo "<td>".$product->getPrice()."</td>";
                    echo "<td><input type='number' name='qty".$count."' min='0' value='0'/></td>";
                    echo "</tr>";
                    $count++;
                }
                //$query ="SELECT * FROM product  WHERE product.producttype = 'Flower' AND product.Availability = 'Available'";
                //$resultSet = $connection->query($query);
               // if(!resultSet){
               //     trigger_error('Invalid query: ' . $conn->error);
             //   }
                /*if($resultSet){
                    while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                        $prod[] = new Product($row['productCode'], $row['productType'],
                        $row['productdes'], $row['Availability'], $row['price']);
                        echo "<tr>";
                        echo "<td>$row[productCode]</td>";
                        echo "<td>$row[productdes]</td>";
                        echo "<td>$row[price]</td>";
                        echo "<td><input type='number' name='qty".$count."' min='0' value='0'/></td>";
                        echo "</tr>";
                              //  . "</td><td><input type='submit' name='add"
                              //  .$count."'</td></tr>";
                        $count++;

                    }
                } */
            ?>
                </tbody>
            </table>
            <input type="submit" class="btn-gradient-primary" value="Next" />
        </form>
         
        
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //$cusOrder = array(); 
            for($num = 0; $num < count($prod);$num++){
              //  if(isset($_POST['add'.$num])){
                $qty=$_POST['qty'.$num];
                if($qty>0){
                    $productCode = $prod[$num]->getProductCode ();
                    //echo "<p>$productCode"."  and  $qty</p>";
                    $bouquet = new BouquetItem('',$productCode,$qty,$prod[$num]->getPrice());
                    $cusOrder[] = $bouquet;     
                }
            }
            $_SESSION["customOrder"] = $cusOrder;
            echo "<script>location.href = './selectDesign.php'</script>";
            
        }
            
        ?>   
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
