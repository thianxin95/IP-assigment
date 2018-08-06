<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    
        <title>Product Sales</title>
    </head>
    <body>
        <?php
         include_once '../../Object/OrderDetailsOB.php'; 
         include_once '../../Controller/OrderDetailsController.php'; 
         include_once './ReviewOrderController.php';
         
         $orderDetail_ctrl = new OrderDetailsController;
         $orderDetaillist = new OrderDetailsOB("","","","","");
         $orderDetaillist = $orderDetail_ctrl->getAllOrderDetail();
         
         for($i=0; $i<count($orderDetaillist); $i++){
            $xmlPath = "reviewOrder.xml";
            $drob = new OrderDetailsOB("","","","","");
            $ReviewOrder_ctrl = new ReviewOrderController($xmlPath);
            $drob->setOrderDetailsID($orderDetaillist[$i]->getOrderDetailsID());
            $drob->setOrderID($orderDetaillist[$i]->getOrderID());
            $drob->setProductCode($orderDetaillist[$i]->getProductCode());
            $drob->setQuantity($orderDetaillist[$i]->getQuantity());
            $drob->setUnitPrice($orderDetaillist[$i]->getUnitPrice());
            echo "<script> location.href='reviewOrder.xml';</script>";
         }
        ?>
       
    </body>
</html>
