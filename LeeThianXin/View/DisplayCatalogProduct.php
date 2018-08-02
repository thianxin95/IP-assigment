<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Catalog</title>
    </head>
    <body>
        <h1>ITEM in catalog</h1>
        <?php
        include_once '../../Object/OrderDetailsOB.php';
        session_start();
                  if(isset($_SESSION["orderDetailarray"])){
              echo "Your session is here. </br> ";
          }          
       
        if ($_SESSION["orderDetailarray"] == null) {
            echo "Nothing";
            echo"empty";
        }
        
//                if(isset($_SESSION["user"])){
//              echo "Your user session is here. </br> ";
//          }          
//        $user = new Customer("", "", "", "", "", "", "", "", "", "");
//        if ($_SESSION["user"] == null) {
//            echo "<script> location.href='../../login.php'; </script>";
//            echo"empty";
//        }
//        $user = $_SESSION["user"];
//        $UserID = $user->getUserID();
//        $Username = $user->getName();
//        $Usertype = $user->getUserType();
//        echo 'Welcome ' .$Username ;
        
        
        

// 
//session_unset(); 
//
//session_destroy();
       
                          $b=0;
                          for($i = 0; $i< count($_SESSION["orderDetailarray"]); $i++){
                              $result[$b] = new OrderDetailsOB("", "", "", "", "");
                              $result[$b] = $_SESSION["orderDetailarray"][$i];
                              $b++;
                          }
                          
                       ?>
        <style>
            .w3-container {
                background-color: #99ff99
            }
           table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
        </style>
        <div class="w3-container">
            <h2>ALL Product in cart</h2>
            <table class="w3-table-all">
                <tr>
                    <th>Product Code</th>
                    <th>Quantity</th>
                    <th>Price per unit(RM)</th>
                </tr>
        <?php
                          
             for($a=0;$a< count($_SESSION["orderDetailarray"]); $a++){ 
         $orderDetail = new OrderDetailsOB("", "", "", "", "");
         $orderDetail = $_SESSION["orderDetailarray"][$a];
//         $orderID = $orderDetail->getOrderID();
//         if()
         $code = $orderDetail->getProductCode();
         $quantity = $orderDetail->getQuantity();
         $price =$orderDetail->getUnitPrice();
         echo '<tr>';
         echo "<td>$code</td>";
         echo "<td>$quantity</td>";
         echo "<td>$price</td>";
         echo("</tr>");
         
             }
             
             
             //                          for($a = 0; $a < count($productlist); $a++){                      
//                              $productCode = $productlist[$a]->getProductCode();
//                              $producttype = $productlist[$a]->getProductType();
//                              $productdes = $productlist[$a]->getProductDes();
//                              $Availability = $productlist[$a]->getAvailability();
//                              $price = $productlist[$a]->getPrice();
//                                echo("<tr>");
//                                echo("<td>$productCode</td>");
//                                echo("<td>$producttype</td>");
//                                echo("<td>$productdes</td>");
//                                echo("<td>$Availability</td>");
//                                echo("<td>RM$price</td>");                              
//                                echo("</tr>");
//                              
//                          }  
   
           
//                          $a = count($_SESSION["orderDetailarray"]);
//                          echo 'here'.$a;
//                          unset($_SESSION["orderDetailarray"][1]);
//                           $a = count($_SESSION["orderDetailarray"]);
//                          echo 'here'.$a;
//        
//        
//                        $OrderItemDetailList = $result;
//                       for($a = 0; $a < count($OrderItemDetailList); $a++){
//                           $orderDetailsID = $OrderItemDetailList->getOrderDetailsID();
//                           $orderID = $OrderItemDetailList->getOrderID();
//                           $productCode = $OrderItemDetailList->getProductCode();
//                           $Quantity = $OrderItemDetailList->getQuantity();
//                           $UnitOrice = $OrderItemDetailList->getUnitPrice();
//                           
//                           
//                       }
        
                          
                          



        ?>
                </table>
        </div>
    </body>
</html>
