<?php 

/**
 * Description of selectDesign.php
 *
 * @author Chan Jeng Yang
 */
       ini_set('display_errors', 1);
       include_once './databaseconn.php';
       include_once './Object/ProductOB.php';
       include_once './Object/BouquetItem.php';
       include_once './customOrderXmlWriter.php';
       include_once './Object/CustomerOb.php';
       include_once './Controller/FlowerDesignController.php';
       include_once './Controller/ProductController.php';
       session_start();
       
       $user = new Customer("", "", "", "", "", "", "", "", "","");
        if ($_SESSION["user"] == null) {
            echo "<script> location.href='login.php'; </script>";
        }
        $user = $_SESSION["user"];
        $Username = $user->getUserID();
        $realName=$user->getName();
        
        if ($user->getUserType() != "Customer") {
            session_destroy();
            session_unset();
            echo "<script> location.href='login.php'; </script>";
        }
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
                  
        <h4>Select Design</h4>
        <form method="post" action="">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Design name</th>
                    <th>Price (RM)</th>
                </tr>
                </thead>
                <tbody>
            <?php
                $prod = array();
                $count = 0;
                $prodControl = new FlowerDesignController();
                $prod = $prodControl->getAvailableDesign();
                $arrangement = new ProductOB("","","","","");
                foreach($prod as $design){  
                    $arrangement = $design;
                    echo "<tr>";
                    /*if($count == 0){
                        echo "<td><input type='radio' name='design' value='$count' checked='checked'/></td>";

                    }else{*/
                        echo "<td><input type='radio' name='design' value='$count' /></td>";
                 //   }
                    echo "<td>".$arrangement->getProductDes()."</td>";
                    echo "<td>".sprintf("%.2f",$arrangement->getPrice())."</td>";
                    echo "</tr>";
                    $count++;
                }
                
                 
            ?>
                </tbody>
            </table>
            <button type="button" class="btn btn-gradient-primary btn-fw" name="btnBack"><a href="selectFlower.php" style="text-decoration: none;color: white">Back</a></button>
            <input type="submit" class="btn btn-gradient-primary btn-fw" value="Next" />
            
        </form>
        
         <?php
            $added = false;
            $item = new BouquetItem("","","","");
            if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['btnBack'])){
            //$cusOrder = array(); 
           // for($num = 0; $num < count($prod);$num++){
              //  if(isset($_POST['add'.$num])){
                if(isset($_POST['design']) ){
                    
                    foreach($_SESSION["bouquet"] as $item){
                        $getProd = new ProductController();
                        $flower = $getProd->getProduct($item->getProductCode()); 
                        if($flower->getProductType() == "Floral arrangement"){
                            $item->setProductCode($prod[$_POST["design"]]->getProductCode());
                            $item->setUnitPrice($prod[$_POST["design"]]->getPrice());
                            $added = true;
                        }
                    }
                    
                    if($added == false){
                    
                        $productCode = $prod[$_POST['design']]->getProductCode();
                      //  echo "<p>".$productCode."  and  ".$qty."</p>";
                        $qty = 1;
                        $bouquet = new BouquetItem('',$productCode,$qty,$prod[$_POST['design']]->getPrice());
                    //    $cusOrder = $_SESSION[customOrder];
                      //  echo count($cusOrder);
                      //  $cusOrder[] = $bouquet;     
                     //   $_SESSION["customOrder"] = $cusOrder;
                        $_SESSION["bouquet"][] = $bouquet;
                    }
                    $cusOrder = $_SESSION["bouquet"];
                    $record = new customOrderXmlWriter();
                    $record->writeToXML($cusOrder);
                //    echo count($cusOrder);
                    echo "<script>location.href = './customOrder.xml'</script>";
                }
                else {
                    echo "<p>Please select one design.</p>";
                }
                
            //    for($a = 0; $a < count($_SESSION["customOrder"])
            }
      //  }
            
             
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

        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

        
        
    </body>
</html>
