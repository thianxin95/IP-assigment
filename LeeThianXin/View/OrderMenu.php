<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Order Page</title>
    </head>
    <style>      
        table,th,td{
            border: 1px solid black;
        }
        .chooseProduct{
            background-color: lightblue;
        }
        .tap2{
            background-color: #9FA8DA;
        }
    </style>
    <body>
        <?php
        include_once '../../Object/ProductOB.php';
        include_once '../../Controller/ProductController.php';
        include_once './CatalogController.php';
        include_once '../../Object/CustomerOb.php'; 
        include_once '../../Object/OrderDetailsOB.php';
        include_once '../../Controller/OrderDetailsController.php';
        
          session_start();
          if(isset($_SESSION["user"])){
              echo "Your session is here. </br> ";
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
        ?>
        <div class="chooseProduct">
            <h1>Product list</h1>
           
            <form action="OrderMenu.php" method="POST">                          
                 
                  <table>
                      <tr>
                          <th>Product Code</th>
                          <th>Product Type</th>
                          <th>Description</th>
                          <th>Availability</th>
                          <th>Price</th>
                          
                      </tr>
                         <?php

                          
                          $_productcont = new ProductController();
                          $productlist = $_productcont->getAllProduct();
                          
                          for($a = 0; $a < count($productlist); $a++){                      
                              $productCode = $productlist[$a]->getProductCode();
                              $producttype = $productlist[$a]->getProductType();
                              $productdes = $productlist[$a]->getProductDes();
                              $Availability = $productlist[$a]->getAvailability();
                              $price = $productlist[$a]->getPrice();
                                echo("<tr>");
                                echo("<td>$productCode</td>");
                                echo("<td>$producttype</td>");
                                echo("<td>$productdes</td>");
                                echo("<td>$Availability</td>");
                                echo("<td>RM$price</td>");                              
                                echo("</tr>");
                              
                          }                                                                       
                  ?>
                       
                  </table>
                  Product Code: 
                  <select name="productcode"> 
                      <option value="0">--Select Product Code--</option>
                      <?php for($b=0; $b<count($productlist); $b++){
                              $productCode = $productlist[$b]->getProductCode();

     echo '<option value="'.$productCode.'">'.$productCode.'</option>';
                  }
                  
                  ?>
<!--                  <input type="text" name="code">-->
                      
                      <input type="number" name="quantity" placeholder="Quantity">
                  <br><br>
             
                                  
               <input type="submit" name="submit" value="Add item into catalog"> 
               

           
        <?php     
        $code = "";
        $sumupprice = "";
                      
        if(isset($_POST['submit'])){
            $i=0;
            if($_POST['submit'] =='Add item into catalog'){
              
                
                $proCode = $_POST['productcode'];
                $quantity = $_POST['quantity'];
                
                          for($c = 0; $c < count($productlist); $c++){ 
                              
                              $productCode = $productlist[$c]->getProductCode();
                              if($productCode == $proCode){
                              $price = $productlist[$c]->getPrice();
                              }
                              
                          }   
                
              $OrderDetails_ctrl = new OrderDetailsController();
              $lastID = $OrderDetails_ctrl->getOrderDetailsID();
              $first = substr($lastID, 0, 5);
              $Rest = substr($lastID, 5);
              $lastOrderID = $OrderDetails_ctrl->getOrderID();
              $first2 = substr($lastOrderID, 0, 3);
              $Rest2 = substr($lastOrderID, 3);
              
  
              $Rest += 1;
              $newID = $first.$Rest;

             $Rest2 +=1;
             $newOrderID = $first2.$Rest2;
    
             
              $orderDetails = new OrderDetailsOB($newID, $newOrderID, $proCode, $quantity, $price);
              $_SESSION["orderDetailarray"][] = $orderDetails;

                
                echo '</br>Order Detail ='.$orderDetails->getOrderDetailsID().' '.$orderDetails->getOrderID().' '.$orderDetails->getProductCode().' '.$orderDetails->getQuantity().' '.$orderDetails->getUnitPrice().'</br>';
               
            }
          
        }
           

        ?>
                            </form>
            
            <a class="nav-link" href="DisplayCatalogProduct.php"> view catalog item </a>

            </div>
        
    </body>
</html>
