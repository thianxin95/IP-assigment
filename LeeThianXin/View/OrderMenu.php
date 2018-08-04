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
        include_once '../../Object/CatalogOB.php';
        include_once './CatalogController.php';
        include_once '../../Object/CustomerOb.php';             
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
           
            <form action="OrderMenu.php" method="GET">                          
                 
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
                  Product Code: <input type="text" name="code" required="">
                  Quantity: <input type="number" name="quantity" required="" min="1" max="200">
                  <br><br>
             
                                  
               <input type="submit" name="submit" value="Add to Cart"> 
               
            </form>
            <form action="OrderMenu.php" method="GET">
                <input type="submit" name="writeFile" value="TRY THIS"> 
            </form>
            
        </div>
        <div class="tap2">
        <?php     
        $code = "";
        $sumupprice = "";
        
        

        
        if(isset($_GET['submit'])){
                $code = test_input($_GET['code']);
                $productDetail = $_productcont->getProduct($code);
                $price = $productDetail->getPrice();

                
                $quantity = test_input($_GET['quantity']);
                $sumupprice = $quantity * $price;
                
                    $xmlPath = "./CatalogItem.xml";
                    $item = new CatalogOB("","","","","","");
                    $item_controller = new CatalogController($xmlPath);
                    $item->setProductCode($productDetail->getProductCode());
                    $item->setProducttype($productDetail->getProductType());
                    $item->setProductquantity($quantity);
                    $item->setTotalprice($sumupprice);
                    $item->setUserID($UserID);
                    $item->setUserType($Usertype);
                    $item_controller->updateRecord($item);
                    
                    
                  //  echo $item->getProductCode();
                
                echo ("RM$sumupprice");
            
        }
        
        if(isset($_GET['writeFile'])){              
            echo '</br>OVER HERE';
                    $xmlPath = "./CatalogItem.xml";
                    $item = new CatalogOB("","","","","","");
                    $item_controller = new CatalogController($xmlPath);
                    $item->setProductCode($productCode2);
                    $item->setProducttype($producttype2);
                    $item->setProductquantity($quantity);
                    $item->setTotalprice($sumupprice);
                    $item->setUserID($UserID);
                    $item->setUserType($Usertype);
                      
                    echo $item->getProductCode();
                       
        }
        function test_input($data){
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data; 
        }             
        echo "<h2>Your Input:</h2>";
        echo "<br>";
        
        ?>
        
            </div>
        
    </body>
</html>
