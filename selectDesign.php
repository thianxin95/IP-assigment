<?php 
       ini_set('display_errors', 1);
       include_once './databaseconn.php';
       include_once './Object/ProductOB.php';
       include_once './Object/BouquetItem.php';
       include_once './customOrderXmlWriter.php';
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
        <h4>Select Design</h4>
        <form method="post" action="">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Design name</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
            <?php
                $prod = array();
                $count = 0;
                $prodControl = new ProductController();
                $prod = $prodControl->getAvailableDesign();
                $arrangement = new ProductOB("","","","","");
                foreach($prod as $design){  
                    $arrangement = $design;
                    echo "<tr>";
                    echo "<td><input type='radio' name='design' value='$count'/></td>";
                    echo "<td>".$arrangement->getProductDes()."</td>";
                    echo "<td>".$arrangement->getPrice()."</td>";
                    echo "</tr>";
                    $count++;
                }
                
                 
            ?>
                </tbody>
            </table>
            <input type="submit" class="btn-gradient-primary" value="Next" />
        </form>
        
         <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //$cusOrder = array(); 
           // for($num = 0; $num < count($prod);$num++){
              //  if(isset($_POST['add'.$num])){
                if(isset($_POST['design'])){
                    $productCode = $prod[$_POST['design']]->getProductCode ();
                  //  echo "<p>".$productCode."  and  ".$qty."</p>";
                    $qty = 1;
                    $bouquet = new BouquetItem('',$productCode,$qty,$prod[$_POST['design']]->getPrice());
                //    $cusOrder = $_SESSION[customOrder];
                  //  echo count($cusOrder);
                  //  $cusOrder[] = $bouquet;     
                 //   $_SESSION["customOrder"] = $cusOrder;
                    $_SESSION["customOrder"][] = $bouquet;
                    $cusOrder = $_SESSION["customOrder"];
                    $record = new customOrderXmlWriter();
                    $record->writeToXML($cusOrder);
                //    echo count($cusOrder);
                    echo "<script>location.href = './customOrder.xml'</script>";
                }
                else {
                    echo "<p>Please select one design.</p>";
                }
                
            //    for($a = 0; $a < count($_SESSION["customOrder"])
            }
      //  }
            
             
        ?>   
        
    </body>
</html>
