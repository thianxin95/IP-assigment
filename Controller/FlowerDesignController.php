<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/Assignment2018/Object/ProductOB.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/Assignment2018/databaseconn.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlowerDesignController
 *
 * @author Chan Jeng Yang
 */
class FlowerDesignController {
    
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
