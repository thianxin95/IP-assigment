<?php

include_once('../databaseconn.php');
include_once('../Object/CustomOrder.php');
include_once('../Object/OrderDetailsOB.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ManageCOrderControl {

    public function getOrderUserID($userID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM customorder WHERE userID = '$userID'";
        $orderlist_result = $conn->query($query);
        $i = 0;
        if (!$orderlist_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        if ($orderlist_result) {
            while ($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)) {
                $orderID = $row["custOrderID"];
                $Pickup = $row["Pickup"];
                $DeliveryAddress = $row["DeliveryAddress"];
                $RequiredDate = $row["RequiredDate"];
                $TotalAmount = $row["TotalAmount"];
                $Status = $row["paymentStatus"];
                $result[$i] = new CustomOrder($orderID, $userID, $Pickup, $DeliveryAddress, $RequiredDate, $TotalAmount, $Status);
                $i++;
            }
        }
        if (empty($result)) {
            return null;
        } else {
            return $result;
        }
    }

    public function getCustomOrder($custOrderID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM customorder WHERE custOrderID = '$custOrderID'";
        $orderlist_result = $conn->query($query);
        $i = 0;
        if (!$orderlist_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        if ($orderlist_result) {
            while ($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)) {
                $orderID = $row["custOrderID"];
                $Pickup = $row["Pickup"];
                $DeliveryAddress = $row["DeliveryAddress"];
                $RequiredDate = $row["RequiredDate"];
                $TotalAmount = $row["TotalAmount"];
                $Status = $row["paymentStatus"];
                $result[$i] = new CustomOrder($orderID, "", $Pickup, $DeliveryAddress, $RequiredDate, $TotalAmount, $Status);
                $i++;
            }
        }
        if (empty($result)) {
            return null;
        } else {
            return $result;
        }
    }

    public function getBouquetItem($custOrderID) {
        $conn2 = $conn = Database::getInstance();
        $query2 = "SELECT * FROM bouquetitem WHERE custOrderID = '$custOrderID'";
        $orderdetails_result = $conn2->query($query2);
        if (!$orderdetails_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn2->close();
        $i = 0;
        if ($orderdetails_result) {
            while ($row2 = $orderdetails_result->fetch(PDO::FETCH_ASSOC)) {
                $custOrderID = $row2["custOrderID"];
                $productcode = $row2["productCode"];
                $Quantity = $row2["quantity"];
                $UnitPrice = $row2["unitPrice"];
                $result[$i] = new BouquetItem($custOrderID, $productcode, $Quantity, $UnitPrice);
                $i ++;
            }
        }
        return $result;
    }

    public function getProductDes($productCode) {
        $conn3 = $conn = Database::getInstance();
        $query3 = "SELECT * FROM product WHERE productcode = '$productCode'";
        $product_result = $conn3->query($query3);
        if (!$product_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn3->close();
        $product_list = $product_result->fetch(PDO::FETCH_ASSOC);
        return $product_list["productdes"];
    }

    public function getOrderBy($custOrder) {
        $conn = Database::getInstance();
        $query = "SELECT users.Name FROM users,customorder WHERE users.userID = customorder.userID AND customorder.custOrderID = '$custOrder'";
        $OrderBy = $conn->query($query);
        if (!$OrderBy) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        while ($row = $OrderBy->fetch(PDO::FETCH_ASSOC)) {
            $result = $row["Name"];
        }
        return $result;
    }

    public function getAllCustomOrders() {
        $conn = Database::getInstance();
        $query = "SELECT * FROM customorder";
        $orderlist_result = $conn->query($query);
        $i = 0;
        if ($orderlist_result) {
            while ($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)) {
                $orderID = $row["custOrderID"];
                $Pickup = $row["Pickup"];
                $DeliveryAddress = $row["DeliveryAddress"];
                $RequiredDate = $row["RequiredDate"];
                $TotalAmount = $row["TotalAmount"];
                $Status = $row["paymentStatus"];
                $result[$i] = new CustomOrder($orderID, "", $Pickup, $DeliveryAddress, $RequiredDate, $TotalAmount, $Status);
                $i++;
            }
        }
        if (empty($result)) {
            return null;
        } else {
            return $result;
        }
    }

    public function updateStatus($orderID, $Status) {
        $conn = Database::getInstance();
        $query = "UPDATE CustomOrder SET paymentStatus = '$Status' WHERE custOrderID = '$orderID'";
        $updateResult = $conn->query($query);
        if (!$updateResult) {
            trigger_error('Invalid Query : ' . $conn->error);
        }
    }

    public function getStatus($custorderID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM customorder WHERE custOrderID = '$custorderID'";
        $Result = $conn->query($query);
        if ($Result) {
            while ($row = $Result->fetch(PDO::FETCH_ASSOC)) {
                $Status = $row["paymentStatus"];
            }
        }
        return $Status;
    }

}
