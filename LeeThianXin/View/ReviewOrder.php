<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
           <link rel="stylesheet" href="../../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">

        <link rel="stylesheet" href="../../css/style.css">

        <link rel="shortcut icon" href="../../images/favicon.png" />
        <title>Review Order</title>
    </head>
    <body>
        <?php
        include_once '../../Object/OrderOB.php';
        include_once './OrderDecorator.php';
        include_once './PickupOrderDecorator.php';
        include_once './DelivertDecorator.php';
        include_once '../../Object/CustomerOb.php';
        session_start();
        if (isset($_SESSION["Order"])) {
            echo '*';
        }
        if($_SESSION["Order"] == null){
            echo "<script> location.href='../../login.php'; </script>";
            echo"empty";
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


        $order = new OrderOB("", "", "", "", "", "", "", "");
        
        $order = $_SESSION["Order"];

        $decorator = new OrderDecorator($order);

        $customerDec = new PickupOrderDecorator($decorator);
        $deliDec = new DelivertDecorator($decorator);

        echo ('showing User : ');
        echo ($decorator->showAddress());
        writeln('');

        echo '</br>You Order Information...';
        echo '</br>Order ID: '.$order->getOrderID();
        echo '</br>User ID: '.$order->getUserID();
        echo '</br>Order Date: '.$order->getOrderDate();
        if ($order->getPickup() == "Yes"){
            $customerDec->itemPickUp();
            writeln($decorator->showPickUP());
            
        }else {
            $deliDec->Delivery();
            writeln($decorator->showAddress());
        }
        //echo ('showing userID after star added : ');
       //$customerDec->starUserID();
        
        writeln('');

        function writeln($line_in) {
            echo $line_in . "<br/>";
        }
       // 
        ?>
        
        <form action="ReviewOrder.php" method="POST">
            <button type="submit" name="submit" class="btn btn-gradient-primary btn-rounded btn-fw" value="leave">Leave</button>
    </form>
        
        <?php
        if(isset($_POST['submit'])){
            if($_POST['submit'] == 'leave'){
                
                unset($_SESSION["Order"]);
                echo "<script> location.href='../../index.php'; </script>";
            }
        }
        ?>
    </body>
</html>
