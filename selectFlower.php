<?php 
       ini_set('display_errors', 1);
       include_once './databaseconn.php';
       include_once './Object/ProductOB.php';
       include_once './Object/BouquetItem.php';
       include_once './Controller/ProductController.php';
       session_start();
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
        <title></title>
    </head>
    <body>
        <h4>Select Flowers</h4>
        
        <form method="post" action="">
            <table class="table">
                <thead>
                <tr>
                    <th>Product Code</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
            <?php
                $prod = array();
                $count = 0;
                $prodControl = new ProductController();
                $prod = $prodControl->getAvailableFlower();
                $product = new ProductOB("","","","","");
                
                foreach ($prod as $flower){
                    
                    $product = $flower;
                    echo "<tr>";
                    echo "<td>".$product->getProductCode()."</td>";
                    echo "<td>".$product->getProductDes()."</td>";
                    echo "<td>".$product->getPrice()."</td>";
                    echo "<td><input type='number' name='qty".$count."' min='0' value='0'/></td>";
                    echo "</tr>";
                    $count++;
                }
                //$query ="SELECT * FROM product  WHERE product.producttype = 'Flower' AND product.Availability = 'Available'";
                //$resultSet = $connection->query($query);
               // if(!resultSet){
               //     trigger_error('Invalid query: ' . $conn->error);
             //   }
                /*if($resultSet){
                    while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                        $prod[] = new Product($row['productCode'], $row['productType'],
                        $row['productdes'], $row['Availability'], $row['price']);
                        echo "<tr>";
                        echo "<td>$row[productCode]</td>";
                        echo "<td>$row[productdes]</td>";
                        echo "<td>$row[price]</td>";
                        echo "<td><input type='number' name='qty".$count."' min='0' value='0'/></td>";
                        echo "</tr>";
                              //  . "</td><td><input type='submit' name='add"
                              //  .$count."'</td></tr>";
                        $count++;

                    }
                } */
            ?>
                </tbody>
            </table>
            <input type="submit" class="btn-gradient-primary" value="Next" />
        </form>
         
        
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //$cusOrder = array(); 
            for($num = 0; $num < count($prod);$num++){
              //  if(isset($_POST['add'.$num])){
                $qty=$_POST['qty'.$num];
                if($qty>0){
                    $productCode = $prod[$num]->getProductCode ();
                    //echo "<p>$productCode"."  and  $qty</p>";
                    $bouquet = new BouquetItem('',$productCode,$qty,$prod[$num]->getPrice());
                    $cusOrder[] = $bouquet;     
                }
            }
            $_SESSION["customOrder"] = $cusOrder;
            echo "<script>location.href = './selectDesign.php'</script>";
            
        }
            
        ?>   
        
        
        

    </body>
</html>
