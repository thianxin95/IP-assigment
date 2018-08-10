<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SalesOrderController
 *
 * @author Daniel
 */
include_once '../../databaseconn.php';

class SalesOrderController {

    public function getProductID() {
        $conn = Database::getInstance();
        $query = "SELECT MIN(productCode) AS productCode FROM orderdetails GROUP BY productCode";
        $productID_Result = $conn->query($query);
        if (!$productID_Result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        $i = 0;
        if ($productID_Result) {
            while ($row = $productID_Result->fetch(PDO::FETCH_ASSOC)) {
                $productID = $row["productCode"];
                $result[$i] = $productID;
                $i++;
            
            }
        }
        if (empty($result)) {
            return null;
        } else {
            return $result;
        }
    }

    public function getQuantity($productCode) {
        $conn = Database::getInstance();
        $query = "SELECT Quantity FROM orderdetails WHERE productCode ='$productCode'";
        $quantity_result = $conn->query($query);
        if (!$quantity_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        $result = 0;
        if($quantity_result){
            while($row = $quantity_result->fetch(PDO::FETCH_ASSOC)){
                $quantity = $row["Quantity"];
                $result+=$quantity;
            }
        }
        if (empty($result)) {
            return null;
        } else {
            return $result;
        }
    }

    public function getUnitPrice($productCode){
        $conn = Database::getInstance();
        $query = "SELECT UnitPrice FROM orderdetails WHERE productCode ='$productCode'";
        $unitPrice_result = $conn->query($query);
        if (!$unitPrice_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        if($unitPrice_result){
            while($row = $unitPrice_result->fetch(PDO::FETCH_ASSOC)){
                $unitPrice = $row['UnitPrice'];
                $result = $unitPrice;
            }
        }
        if (empty($result)) {
            return null;
        } else {
            return $result;
        }
    }
}
