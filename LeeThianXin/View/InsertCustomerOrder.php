<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
              <!-- plugins:css -->
        <link rel="stylesheet" href="../../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- inject:css -->
        <link rel="stylesheet" href="../../css/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="../../images/favicon.png" />
        <title>Customer order page</title>
    </head>
    <body>
        <?php
        include_once '../../Object/OrderOB.php';
        include_once '../../Controller/OrderController.php';
        include_once '../../Object/CustomerOb.php';
        include_once '../../Object/Session_itemSelected.php';
        include_once '../../Object/OrderDetailsOB.php';
        include_once '../../Controller/OrderDetailsController.php';
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
             echo '</br>this is total price: '.$totalprice;
        
        ?>
          <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Please enter order detail</h4>

                                        <form class="forms-sample" action="InsertCustomerOrder.php" method="POST">
                                            <div class="form-group">
                                                <label for="totalAmount">Total Amount(RM): </label>
                                                
                                                <input type="text" class="form-control" value="RM <?php echo $totalprice;?>" name="totalAmount" placeholder="Total Amount(RM)" readonly>
                                                        
                                            </div>
                                         
                                            <div class="form-group">
                                                <label for="requiredate">Require date: </label>
                                                <?php
                                                        echo '<input type="date" class="form-control" name="requiredate" min= "'. date("Y-m-d").'">';
                                                        ?>
                                            </div>
                                            <div class="form-group">
                                                
                                            Pick up at store 
<!--                                            <input type="checkbox"  name="pickup" value="Pickup" checked></br>-->
                                             <input type="radio" name="pickup" value="Yes"> Yes
                                             <input type="radio" name="pickup" value="No"> No<br>
                                            </div>

                                            <div class="form-group">
                                                <label for="deliveryAddress">Delivery address</label>
                                                <input type="text" class="form-control" name="deliveryAddress" placeholder="Delivery Address">
                                            </div>
                                                                                                                       
                                            <button type="submit" class="btn btn-gradient-primary mr-2" name="submit" value="prodceedOrder">Proceed Order</button>
                                            <button class="btn btn-light">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
        
        <?php
        if(isset($_POST['submit'])){
            if($_POST['submit'] == 'prodceedOrder'){
                echo $_POST['pickup'];
                
                $order_ctrl = new OrderController();
                //OVER HERE
                $lastID = $order_ctrl->getOrderID();
                

              $first = substr($lastID, 0, 3);
              $Rest = substr($lastID, 3) + 1;

               
             // $Rest += 1;
             $newID = $first.$Rest;
//                if($lastID == 0){
//                    $newID = "ord1";
//                }else{
//                $n1 = $lastID+1;
//                echo 'OVER HERERRER '.$n1;
//                $s1 = "ord".$n1;
//                $newID = $s1;
//                }
              $orderDate = date("d-m-Y");
            
              
                $requireddate = $_POST['requiredate'];
                $pUp= "yes";
                 
                if ($_POST['pickup'] == "Yes"){
                    $pUp = "Yes";
                } elseif($_POST['pickup'] == "No"){
                    $pUp = "No";
                }
                $deliveryAddress = $_POST['deliveryAddress'];
                 $newOrder = new OrderOB($newID, $UserID, $orderDate, $pUp, $deliveryAddress, $requireddate, $totalprice, "Unpaid");
                 
                 
                 echo 'New Order: '.$newOrder->getOrderID().' '.$newOrder->getUserID().' '.$newOrder->getOrderDate().' '.$newOrder->getPickup().' '.$newOrder->getDeliveryAddress().' '.$newOrder->getRequiredDate().' '.$newOrder->getTotalAmount().' '.$newOrder->getStatus();
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
         //OVER HERE
         $lastOrderDetailID = $OrderDetail_ctrl->getOrderDetailsID();
                 $first2 = substr($lastOrderDetailID, 0, 5);
              $Rest2 = substr($lastOrderDetailID, 5) + 1;
             // $Rest2 += 1;
//         if($lastOrderDetailID == 0){
//             $newID2 = "ordtl1";
//         }else{
//             
//
//               $n2 = $lastOrderDetailID+1;
//                $s2 = "ordtl".$n2;
//                $newID2 = $s2;
//                  }
              $newID2 = $first2.$Rest2;
              
         
         $newOrderDetail = new OrderDetailsOB($newID2,$newID,$code,$quantity,$price);
         $OrderDetail_ctrl->addRecord($newOrderDetail);
         }
         
             }
                
                unset($_SESSION["Selected_itemArray"]);
            }
            echo 'Good Job';
            
        }
        ?>
    </body>
</html>
