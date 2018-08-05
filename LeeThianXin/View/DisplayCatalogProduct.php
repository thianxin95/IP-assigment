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
        include_once '../../Object/CustomerOb.php';
        include_once '../../Object/Session_itemSelected.php';
        session_start();
        //unset($_SESSION["Selected_itemArray"]);

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
//                          $b=0;
//                          for($i = 0; $i< count($_SESSION["Selected_itemArray"]); $i++){
//                              $result[$b] = new Session_itemSelected("", "", "", "");
//                              $result[$b] = $_SESSION["Selected_itemArray"][$i];
//                              $b++;
//                          }
                          
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
                    <th>Total price</th>
                </tr>
        <?php
               for($a=0;$a< count($_SESSION["Selected_itemArray"]); $a++){ 
         $orderDetail = new Session_itemSelected("", "", "", "", "");
         $orderDetail = $_SESSION["Selected_itemArray"][$a];
         $ID = $orderDetail->getUserID();
         if($ID == $UserID){
         $code = $orderDetail->getProductCode();
         $quantity = $orderDetail->getQuantity();
         $price =$orderDetail->getUnitPrice();
         $totalprice = $orderDetail->getTotalprice();
         echo '<tr>';
         echo "<td>$code</td>";
         echo "<td>$quantity</td>";
         echo "<td>$price</td>";
         echo "<td>$totalprice</td>";
         echo("</tr>");
         }
         
             }
                         
        ?>
                </table>
        </div>
        <a class="nav-link" href="InsertCustomerOrder.php">Make order here</a>
    </body>
</html>
