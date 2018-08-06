<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/Assignment2018/databaseconn.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/Assignment2018/Object/ProductOB.php');

class ProductController {
    public function getAllProduct(){
        $sql = "SELECT * FROM product";
        $conn = Database::getInstance();
        $productResult = $conn->query($sql);
        if(!$productResult){
            trigger_error("Invalid query: " . $conn->error);
        }
        $conn->close();
        $i = 0;
     if($productResult){
         while ($row = $productResult->fetch(PDO::FETCH_ASSOC)) {
             $productCode = $row["productCode"];
             $producttype = $row["producttype"];
             $productdes = $row["productdes"];
             $Availability = $row["Availability"];
             $price = $row["price"];
             $result[$i] = new ProductOB($productCode, $producttype, $productdes, $Availability, $price);
             $i++;
         }
     }
     return $result;                        
}
   
    public function getProduct($productCode){
            $sql = "SELECT * FROM product WHERE productCode = '$productCode'";
            $conn = Database::getInstance();
            $productResult = $conn->query($sql);
            if(!$productResult){
                trigger_error("Invalid query: " . $conn->error);
            }
            $conn->close();

             while ($row = $productResult->fetch(PDO::FETCH_ASSOC)) {
                 $productCode = $row["productCode"];
                 $producttype = $row["producttype"];
                 $productdes = $row["productdes"];
                 $Availability = $row["Availability"];
                 $price = $row["price"];
                 $result = new ProductOB($productCode, $producttype, $productdes, $Availability, $price);
                 
             }

         return $result; 

    }
    
    public function getAvailableFlower(){
        $prod = array();
        $conn = Database::getInstance(); 
        $query ="SELECT * FROM product  WHERE product.producttype = 'Fresh flower' AND product.Availability = 'Available'";
        $resultSet = $conn->query($query);
        if(!$resultSet){
            trigger_error('Invalid query: ' . $conn->error);
        }
        $count =0;
        if($resultSet){
            while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                $prod[] = new ProductOB($row['productCode'], $row['producttype'],
                $row['productdes'], $row['Availability'], $row['price']);
                $count++;

            }
        } 
        $conn->close();
        return $prod;
    }
    
    public function getAvailableDesign(){
        $connection = Database::getInstance(); 
        $query ="SELECT * FROM product  WHERE product.producttype = 'Floral arrangement' AND product.Availability = 'Available'";
        $resultSet = $connection->query($query);
        if(!$resultSet){
            trigger_error('Invalid query: ' . $conn->error);
        }
        $connection->close();
        $count =0;
        if($resultSet){
            while($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
                $prod[$count] = new ProductOB($row['productCode'], $row['producttype'],
                $row['productdes'], $row['Availability'], $row['price']); 
                $count++;

            }
        } 
        return $prod;
    }
}

