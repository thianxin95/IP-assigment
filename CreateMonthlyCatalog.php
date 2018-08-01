<!DOCTYPE html>
<html lang="en">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <?php include('PageTitle.php') ?>
        <!-- plugins:css -->
        <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="css/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="images/favicon.png" />
    </head>
    <body>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Code</th>
                    <th>Product Type</th>
                    <th>Product Description</th>
                    <th>Stock Availability</th>
                    <th>Product Price</th>
                </tr>
            </thead>
           <tbody>
                        <?php 
                        include ('databaseconn.php');
                        $conn = Database::getInstance();
                        
                        $query = "SELECT * FROM product";
                        $product_result = $conn->query($query);
                        if(!$product_result){
                            trigger_error('Invalid query: ' . $conn->error);
                        }
                        $conn->close();
                        if($product_result){
                            while($row = $product_result->fetch(PDO::FETCH_ASSOC)){
                               $productCode = $row["productCode"];
                               $productType = $row["producttype"];
                               $productDescrip = $row["productdes"];
                               $productAvail = $row["Availability"];
                               $productPrice = $row["price"];
                               echo("<tr>");
                                    echo("<td>$productCode</td>");
                                    echo("<td>$productType</td>");
                                    echo("<td>$productDescrip</td>");
                                    echo("<td>$productAvail</td>");
                                    echo("<td>$productPrice</td>");
                               echo("</tr>");
                                }
                        }

                        
                               ?> 
           </tbody>
        </table>
        
        <form action="CreateMonthlyCatalog.php" method="POST">
            <label>Enter product to be shown in <select name="monthdroplist">
                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>
                </select> Catalog </label><br>
                <label>Enter the product to be showed : </label><br>
                <label>Product 1 : </label><input type="text" name="product1"/><br>
                <label>Product 2 : </label><input type="text" name="product2"/><br>
                <label>Product 3 : </label><input type="text" name="product3"/><br>
                <label>Product 4 : </label><input type="text" name="product4"/><br>
                <label>Product 5 : </label><input type="text" name="product5"/><br>
                <input type="submit" value="Submit"/>
        </form>
        
        <?php
                        $product1 = $_POST['product1'];
                        $product2 = $_POST['product2'];
                        $product3 = $_POST['product3'];
                        $product4 = $_POST['product4'];
                        $product5 = $_POST['product5'];
                       
                        
                         
                        $selectquery = "SELECT * FROM product WHERE productCode = '$product1' OR productCode = '$product2' "
                                . "OR productCode = '$product3'  OR productCode = '$product4'  OR productCode = '$product5' ";
                        
                        $productArray = array();
                        
                        $result = $conn->query($selectquery);
                        
                        if(!$result){
                            trigger_error('Invalid query: ' . $conn->error);
                        }
                        
                        if($result){
                            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                array_push($productArray, $row);
                            }
                                
                        }
                        
                        if(count($productArray)){
                           createXMLfile($productArray); 
                        }
                        
                        $conn->close();
                        
                        function createXMLfile($productArray){
                            $month = $_POST['monthdroplist']; 
                            $catalogCode = "1001";
                            
                            $filePath = "flowercatalog.xml";
                            
                            $dom = new DOMDocument("1.0","utf-8");
                            
                            $root = $dom->createElement("catalogs");
                            $root->setAttribute("catalogID", $catalogCode);
                            $root->setAttribute("month", $month);
                            
                            for($i = 0; $i<count($productArray); $i++){
                                $catalogid = $productArray[$i]["productCode"];
                                $catalogtype = $productArray[$i]["producttype"];
                                $catalogdes = $productArray[$i]["productdes"];
                                $catalogavail = $productArray[$i]["Availability"];
                                $catalogprice = $productArray[$i]["price"];
                                
                                $catalog = $dom->createElement("catalog");
                                $id = $dom->createElement("code", $catalogid);
                                $catalog->appendChild($id);
                                $type = $dom->createElement("type", $catalogtype);
                                $catalog->appendChild($type);
                                $des = $dom->createElement("description", $catalogdes);
                                $catalog->appendChild($des);
                                $stock = $dom->createElement("stock", $catalogavail);
                                $catalog->appendChild($stock);
                                $price = $dom->createElement("price", $catalogprice);
                                $catalog->appendChild($price);
                                
                                $root->appendChild($catalog);
                            }
                            
                            $dom->appendChild($root);
                            $dom->save($filePath);
                        }
        ?>
        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
    </body>
</html>
