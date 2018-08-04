<?php

include_once '../../databaseconn.php';
include_once '../../Object/ProductOB.php';
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
}