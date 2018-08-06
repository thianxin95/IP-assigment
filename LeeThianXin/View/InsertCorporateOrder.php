<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
  <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
                <!-- plugins:css -->
        <link rel="stylesheet" href="../../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- inject:css -->
        <link rel="stylesheet" href="../../css/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="../../images/favicon.png" />
        <title>Corporate order page</title>
    </head>

    <body>
        <?php
        include_once '../../Object/CustomerOb.php';
        include_once '../../Object/Session_itemSelected.php';
        include_once '../../Controller/OrderController.php';
        include_once '../../Object/OrderOB.php';
        include_once '../../Controller/OrderDetailsController.php';
        include_once '../../Object/OrderDetailsOB.php';
        include_once '../../Object/InvoiceOB.php';
        include_once '../../Controller/InvoiceController.php';
        include_once '../../Object/User.php';
        include_once '../../Controller/CustomerController.php';
        session_start();
        $day = date("d-m-Y");
        echo $day . "<br>";

           if(isset($_SESSION["Selected_itemArray"])){
              echo "Your session is here. </br> ";
          }          
       
        if ($_SESSION["Selected_itemArray"] == null) {
            echo "Nothing";
            echo"empty";
        }
        
                if(isset($_SESSION["user"])){
              echo "Your user session is here. </br> ";
          }          
        $user = new Customer("", "", "", "", "", "", "", "", "", "");
        if ($_SESSION["user"] == null) {
            echo "<script> location.href='../../login.php'; </script>";
            echo"empty";
        }
        $user = $_SESSION["user"];
        $UserID = $user->getUserID();
        $Username = $user->getName();
        $Usertype = $user->getUserType();
        echo 'Welcome ' .$Username ;
        
          $totalprice = 0;;
         for($a=0;$a< count($_SESSION["Selected_itemArray"]); $a++){ 
                 $orderDetail = new Session_itemSelected("", "", "", "", "");
                 $orderDetail = $_SESSION["Selected_itemArray"][$a];
                 $ID = $orderDetail->getUserID();
                 if($ID == $UserID){
                 $totalprice += $orderDetail->getTotalprice();

         }
                 
             }
             $remainCredit1 = $user->getCreditLimit() - $user->getUsedCredit();
             echo '</br>this is total price: '.$totalprice;
        ?>
        
           <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Please enter order detail</h4>
                                
                                        <form class="forms-sample" action="InsertCorporateOrder.php" method="POST">
                                            <div class="form-group">
                                                <label for="totalAmount">Total Amount</label>
                                                <input type="text" class="form-control" id="totalAmount" value="RM <?php echo $totalprice;?>" name="totalAmount" placeholder="totalAmount" readonly>
                                            </div>
                                             <div class="form-group">
                                                <label for="remainingCredit">Remaining Credit</label>
                                                <input type="text" class="form-control" id="remainingCredit" value="RM <?php echo $remainCredit1;?>" name="remainingCredit" placeholder="totalAmount" readonly>
                                            </div>
                                              <div class="form-group">
                                                <label for="requiredate">Require date: </label>
                                                <?php
                                                        echo '<input type="date" class="form-control" name="requiredate" min= "'. date("Y-m-d").'">';
                                                        ?>
                                            </div>
                                               <div class="form-group">
                                            <label for="PaymentMethod">Choose payment method</label>
                                            <select class="form-control form-control-sm" id="PaymentMethod" name="PaymentMethod">
                                                <option value="0">--Select Product Code--</option>
                                                <option value="1">Use credit</option>
                                                <option value="2">Cash on Delivery</option>
                                               
                                            </select>
                                        </div>
                                            
                                               <div class="form-group">
                                                
                                            Pick up at store 
                                             <input type="radio" name="pickup" value="Yes"> Yes
                                             <input type="radio" name="pickup" value="No"> No<br>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="deliveryAddress">Delivery Address</label>
                                                <input type="text" class="form-control" id="deliveryAddress" name="deliveryAddress" placeholder="Only for cash on delivery">
                                            </div>
                                       
                                            <button type="submit" class="btn btn-gradient-primary mr-2" name="submit" value="proceedOrder">Proceed Order</button>
                                            <button type="submit" class="btn btn-light" name="submit" value="cancel">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
    <?php
    if (isset($_POST['submit'])){
        if($_POST['submit'] == 'cancel'){
               unset($_SESSION["Selected_itemArray"]);
                    
                    echo '<script> alert("ORDER CANCEL");</script>';
                    echo "<script> location.href='../../index.php'; </script>";
        }
        if($_POST['submit'] == 'proceedOrder'){
            $order_ctrl = new OrderController();
            $lastID = $order_ctrl->getOrderID();
            
              $first = substr($lastID, 0, 3);
              $Rest = substr($lastID, 3) + 1;
              $newID = $first.$Rest;
              $orderDate = date("d-m-Y");
            $requireddate = $_POST['requiredate'];
            $pUp = "";
            $paymentMethod = $_POST['PaymentMethod'];
            
            $remainCredit = $user->getCreditLimit() - $user->getUsedCredit();
            if($paymentMethod == 1){
               echo '</br> You choose credit card';
//                $remainCredit = $user->getCreditLimit() - $user->getUsedCredit();
                if($remainCredit < $totalprice){
                    echo"</br>Request not approve, Not sufficient credit available";

                }
            }else if($paymentMethod == 2){
                echo '</br> you choose cash on delivery';
            }
                if ($_POST['pickup'] == "Yes"){
                    $pUp = "Yes";
                } elseif($_POST['pickup'] == "No"){
                    $pUp = "No";
                }
      
            
            $deliveryAddress = $_POST['deliveryAddress'];
            
            if($paymentMethod == 1){
              if($remainCredit < $totalprice){
                  echo '<script> alert("ADD ORDER UNSUCCESSFUL, NOT ENOUGH CREDIT.");</script>';
                    echo"</br>Request not approve, Not sufficient credit available";

                }elseif ($remainCredit > $totalprice) {
                            $newOrder = new OrderOB($newID, $UserID, $orderDate, $pUp, $deliveryAddress, $requireddate, $totalprice, "Unpaid");
                            $order_ctrl->addOrder($newOrder);

                             for($a=0;$a< count($_SESSION["Selected_itemArray"]); $a++){ 
                         $orderDetail = new Session_itemSelected("", "", "", "", "");
                         $orderDetail = $_SESSION["Selected_itemArray"][$a];
                         $ID = $orderDetail->getUserID();
                         if($ID == $UserID){
                         $code = $orderDetail->getProductCode();
                         $quantity = $orderDetail->getQuantity();
                         $price =$orderDetail->getUnitPrice();
                         $totalprice = $orderDetail->getTotalprice();
                         $OrderDetail_ctrl = new OrderDetailsController();

                         $lastOrderDetailID = $OrderDetail_ctrl->getOrderDetailsID();
                          $first2 = substr($lastOrderDetailID, 0, 5);
                              $Rest2 = substr($lastOrderDetailID, 5) + 1;
                         $newID2 = $first2.$Rest2;

                         $newOrderDetail = new OrderDetailsOB($newID2,$newID,$code,$quantity,$price);
                         $OrderDetail_ctrl->addRecord($newOrderDetail); 
                            }
                    }
                    $invoice_ctrl = new InvoiceController();
                    $lastInvoiceID = $invoice_ctrl->getInvoiceNo();
                    if($lastInvoiceID == NULL){
                        $newInvoiceID = "1000";
                    }else{
                        $newInvoiceID = $lastInvoiceID + 1;
                    }
                    $getInvoiceRecord = new InvoiceOB("","","","","","");
                    $getInvoiceRecord = $invoice_ctrl->getUserInvoiceNo($UserID);
                    
                    if($getInvoiceRecord == NULL){
                        $newUserInvoice = new InvoiceOB($newInvoiceID, date("d-m-Y"), $UserID, $totalprice,"Unpaid", "");
                        $invoice_ctrl->insertInvoice($newUserInvoice);
                          echo 'create invoice SUCCESSFULL';
                        
                    }else{
                        $invoiceNo = $getInvoiceRecord->getInvoiceNo();
                        $invoiceAmount= 0;
                        $invoiceAmount = $getInvoiceRecord->getInvoiceAmount() + $totalprice;
                        
                        $newUserInvoice = new InvoiceOB($invoiceNo, date("d-m-Y"), $UserID, $invoiceAmount,"Unpaid","");
                        $invoice_ctrl->updateInvoice($newUserInvoice, $UserID);
                        echo 'UPDATE SUCCESSFULL';
                    }
                    
                    unset($_SESSION["Selected_itemArray"]);
                    
                    $cus_ctrl = new CustomerController();
                    $cus_ctrl->updateUserUsedCredit($UserID, $totalprice);
                    
                    $user->setUsedCredit($totalprice);
                    $_SESSION["user"] = $user;
                    
                    echo '<script> alert("ADD ORDER SUCCESSFUL. Credit deducted");</script>';
                    echo "<script> location.href='../../index.php'; </script>";
                    
                
            }
            }
            if($paymentMethod == 2){
            $newOrder = new OrderOB($newID, $UserID, $orderDate, $pUp, $deliveryAddress, $requireddate, $totalprice, "Unpaid");
            $order_ctrl->addOrder($newOrder);
            
             for($a=0;$a< count($_SESSION["Selected_itemArray"]); $a++){ 
         $orderDetail = new Session_itemSelected("", "", "", "", "");
         $orderDetail = $_SESSION["Selected_itemArray"][$a];
         $ID = $orderDetail->getUserID();
         if($ID == $UserID){
         $code = $orderDetail->getProductCode();
         $quantity = $orderDetail->getQuantity();
         $price =$orderDetail->getUnitPrice();
         $totalprice = $orderDetail->getTotalprice();
         $OrderDetail_ctrl = new OrderDetailsController();
         
         $lastOrderDetailID = $OrderDetail_ctrl->getOrderDetailsID();
          $first2 = substr($lastOrderDetailID, 0, 5);
              $Rest2 = substr($lastOrderDetailID, 5) + 1;
         $newID2 = $first2.$Rest2;
                  
         $newOrderDetail = new OrderDetailsOB($newID2,$newID,$code,$quantity,$price);
         $OrderDetail_ctrl->addRecord($newOrderDetail); 
            }
    }
    unset($_SESSION["Selected_itemArray"]);
    echo 'Order Add successfull';
     echo '<script> alert("ADD ORDER SUCCESSFUL.");</script>';
    echo "<script> location.href='../../index.php'; </script>";
            }
   
    echo 'hehehhehehehhehehehe';
        }
    }
    ?>
    
    </body>

</html>
