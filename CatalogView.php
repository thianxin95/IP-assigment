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
        </table>
        <br/>
        <form action="CatalogView.php" method="POST">
           <label>Which product would like to update : </label>
           <input type="text" name="productupdate"/>
           <label>Change Availability to : </label>
           <input type="text" name="textchange"/>
           <input type="submit" value="Submit" />
        </form>
        
        
        <?php 
                        $productCode = $_POST['productupdate'];
                        $textChange = $_POST['textchange'];
                        
                        $updatequery = "UPDATE product SET Availability = '$textChange' WHERE productCode = '$productCode'";
                        $stmt = $conn->query($updatequery);
                        
                        $stmt->execute();
                        
                        ?>
        
        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
    </body>
</html>
