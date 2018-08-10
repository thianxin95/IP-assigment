<!DOCTYPE html>
<!--
/**
 * Description of InsertCustomerOrder
 *
 * @author Daniel Lee
 */
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

        if (isset($_SESSION["Selected_itemArray"])) {
            echo "Your session is here. </br> ";
        }

        if ($_SESSION["Selected_itemArray"] == null) {
            echo "Nothing";
            echo"empty";
        }

        if (isset($_SESSION["user"])) {
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
        echo 'Welcome ' . $Username;

        $totalprice = 0;
        ;
        for ($a = 0; $a < count($_SESSION["Selected_itemArray"]); $a++) {
            $orderDetail = new Session_itemSelected("", "", "", "", "");
            $orderDetail = $_SESSION["Selected_itemArray"][$a];
            $ID = $orderDetail->getUserID();
            if ($ID == $UserID) {
                $totalprice += $orderDetail->getTotalprice();
            }
        }
        echo '</br>this is total price: ' . $totalprice;
        ?>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Please enter order detail</h4>

                    <form class="forms-sample" action="InsertCustomerOrder.php" method="POST">
                        <div class="form-group">
                            <label for="totalAmount">Total Amount(RM): </label>

                            <input type="text" class="form-control" value="RM <?php echo $totalprice; ?>" name="totalAmount" placeholder="Total Amount(RM)" readonly>

                        </div>

                        <div class="form-group">
                            <label for="requiredate">Require date: </label>
<?php
echo '<input type="date" class="form-control" name="requiredate" min= "' . date("Y-m-d") . '">';
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
                        <button class="btn btn-light" name="submit" value="cancel">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

<?php
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'cancel') {
        unset($_SESSION["Selected_itemArray"]);

        echo '<script> alert("ORDER CANCEL");</script>';
        echo "<script> location.href='../../index.php'; </script>";
    }
    if ($_POST['submit'] == 'prodceedOrder') {
        if ($_POST['requiredate'] == '' || $_POST['pickup'] == '' || $_POST['deliveryAddress'] == '') {
            echo '<script> alert("All field given are require to be fill in.");</script>';
        } else {
            $order_ctrl = new OrderController();
            $lastID = $order_ctrl->getOrderID();
            if ($lastID == NULL) {
                $newID = "ord1001";
            } else {
                $first = substr($lastID, 0, 3);
                $Rest = substr($lastID, 3) + 1;
                $newID = $first . $Rest;
            }
            $orderDate = date("d-m-Y");
            $requireddate = $_POST['requiredate'];
            $pUp = "";
            if ($_POST['pickup'] == "Yes") {
                $pUp = "Yes";
            } elseif ($_POST['pickup'] == "No") {
                $pUp = "No";
            }
            $deliveryAddress = $_POST['deliveryAddress'];
            $newOrder = new OrderOB($newID, $UserID, $orderDate, $pUp, $deliveryAddress, $requireddate, $totalprice, "Unpaid");
            $_SESSION["Order"] = $newOrder;

            echo 'New Order: ' . $newOrder->getOrderID() . ' ' . $newOrder->getUserID() . ' ' . $newOrder->getOrderDate() . ' ' . $newOrder->getPickup() . ' ' . $newOrder->getDeliveryAddress() . ' ' . $newOrder->getRequiredDate() . ' ' . $newOrder->getTotalAmount() . ' ' . $newOrder->getStatus();
            $order_ctrl->addOrder($newOrder);

            for ($a = 0; $a < count($_SESSION["Selected_itemArray"]); $a++) {
                $orderDetail = new Session_itemSelected("", "", "", "", "");
                $orderDetail = $_SESSION["Selected_itemArray"][$a];
                $ID = $orderDetail->getUserID();
                if ($ID == $UserID) {
                    $code = $orderDetail->getProductCode();
                    $quantity = $orderDetail->getQuantity();
                    $price = $orderDetail->getUnitPrice();
                    $totalprice = $orderDetail->getTotalprice();
                    $OrderDetail_ctrl = new OrderDetailsController();
                    $lastOrderDetailID = $OrderDetail_ctrl->getOrderDetailsID();
                    if ($lastOrderDetailID == NULL) {
                        $newID2 = "ordtl1001";
                    } else {
                        $first2 = substr($lastOrderDetailID, 0, 5);
                        $Rest2 = substr($lastOrderDetailID, 5) + 1;
                        $newID2 = $first2 . $Rest2;
                    }
                    $newOrderDetail = new OrderDetailsOB($newID2, $newID, $code, $quantity, $price);
                    $OrderDetail_ctrl->addRecord($newOrderDetail);
                }
            }

            unset($_SESSION["Selected_itemArray"]);
            echo '<script> alert("ADD ORDER SUCCESSFUL.");</script>';
            echo "<script> location.href='ReviewOrder.php'; </script>";
        }
    }
}
?>
    </body>
</html>
