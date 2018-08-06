<?php
    ini_set('display_errors', 1);
    include_once './Function/ValidateInput.php';
    include_once './Object/CustomerOb.php';
    include_once './Controller/customOrderControl.php';
    include_once './Object/BouquetItem.php';
    include_once './Object/CustomOrder.php';
    include_once './Controller/bouquetItemControl.php';
    include_once './Object/CustomOrderBuilder.php';
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
                                <h4>Schedule Delivery</h4>
                                <section style="float: left">
                                    <form action="" method="post">
                                         
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" id="delivery" name="method" value="delivery" checked="checked"  onclick="document.getElementById('address').disabled =false;"/>
                                            Set up a Delivery
                                            </label>
                                        </div>
                                        
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" id="pickup" class="form-check-input" name="method" value="pickup" onclick="document.getElementById('address').disabled = true;document.getElementById('address').value = ''"/>
                                            In-Store Pickup
                                            </label>
                                        </div>
                                       
                                        <table>
                                            <tr>
                                            
                                                <td>Delivery address : </td>
                                                <td><textarea name="address" id="address" class="form-control" rows="4"></textarea></td>                                               
                                            </tr>
                                            
                                            <tr>
                                                <td>Date and Time :</td>
                                                <td><input class="form-control" type='datetime-local' name='getDate' /></td>

                                            </tr>
                                            <tr>
                                                <td><button class="btn btn-gradient-primary btn-fw" style="margin: 20px" ><a href="customOrder.xml" style="color: white;text-decoration:none;">Back</a></button></td>
                                                <td><button type="submit" name="btnSub" id="btnSub" class="btn btn-gradient-primary btn-fw">Place Order</button>
                                            </tr>
                                        </table>

                                    </form>
                                </section>
                                
                                <?php
                                    
                                    $checkError = false;
                                    $orderBouquet = new BouquetItem("","","","");
                                    $totalAmt=0.0;
                                    if(isset($_POST["btnSub"])){ 
                                        $errorMsg = "Error. <br/>";
                                        $deliverMethod = $_POST["method"];
                                        if(empty($_POST["address"])&& $deliverMethod == "delivery"){
                                            $errorMsg.= "Address cannot be empty<br/>";
                                        }

                                        if(empty($_POST["getDate"])){
                                            $errorMsg .= "Date and time are required.<br/>";
                                            $checkError = true;
                                        }elseif (strtotime ($_POST["getDate"]) <= strtotime('tomorrow')) {
                                            $errorMsg.= "Date must be later than today.<br/>";
                                            $checkError = true;
                                        }        
                                        if($checkError == true){
                                            echo $errorMsg;
                                        }
                                       
                                        if($checkError == false){
                                            $validate = new ValidateInput();
                                            if($_POST["method"] == "delivery"){
                                                $address =  $validate->getValidatedInput($_POST["address"]);
                                            }
                                            $date = Date('d-m-Y H:i:s', strtotime( $_POST["getDate"]));
                                            $date = $validate->getValidatedInput($date);
                                            //store to database
                                            $order = new customOrderControl();
                                            $lastID = $order->getLastInsertedID();
                                           // echo ++$lastID;
                                            $orderID = ++$lastID;
                                            
                                            $bouquet = $_SESSION["bouquet"];
                                            $bouquetDA = new bouquetItemControl();
                                            foreach($bouquet as $bouquetItem ){
                                                $orderBouquet = $bouquetItem;
                                                $orderBouquet->setCustOrderID($orderID);
                                                $totalAmt += $orderBouquet->getQuantity() * $orderBouquet->getUnitPrice();
                                                $bouquetDA->insertRecord($orderBouquet);
                                            }    
                                            if($deliverMethod == "delivery"){
                                                $customOrder = CustomOrder::createBuilder($orderID, $Username, $date, $totalAmt)->pickup("No")->deliveryAdd($address)->build();
                                                
                                            }else if($deliverMethod == "pickup"){
                                                 $customOrder = CustomOrder::createBuilder($orderID, $Username, $date, $totalAmt)->pickup("Yes")->build();
                                            }
                                           
                                           // $customOrder = new CustomOrder($orderID,$Username,$pickup,$address,$date,$totalAmt,"Unpaid");
                                            $order->insertRecord($customOrder);
                                            $_SESSION["CusOrder"] = $customOrder;
                                            $_SESSION["COrderItems"] = $bouquet;
                                            echo "<script>location.href='customOrderSuccess.php';</script>";
                                        
                                            
                                        }

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

        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    </body>
</html>
