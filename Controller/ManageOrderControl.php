<?php

include_once('../databaseconn.php');
include_once('../Object/OrderOB.php');
include_once('../Object/OrderDetailsOB.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ManageOrderControl {

    public function getOrderUserID($userID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM orders WHERE userID = '$userID'";
        $orderlist_result = $conn->query($query);
        $i = 0;
        if (!$orderlist_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        if ($orderlist_result) {
            while ($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)) {
                $orderID = $row["orderID"];
                $orderDate = $row["orderDate"];
                $Pickup = $row["Pickup"];
                $DeliveryAddress = $row["DeliveryAddress"];
                $RequiredDate = $row["RequiredDate"];
                $TotalAmount = $row["TotalAmount"];
                $Status = $row["Status"];
                $result[$i] = new OrderOB($orderID, $userID, $orderDate, $Pickup, $DeliveryAddress, $RequiredDate, $TotalAmount, $Status);
                $i++;
            }
        }
        return $result;
    }

    public function getDetailsOrderID($orderID) {
        $conn2 = $conn = Database::getInstance();
        $query2 = "SELECT * FROM orderdetails WHERE orderId = '$orderID'";
        $orderdetails_result = $conn2->query($query2);
        if (!$orderdetails_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn2->close();
        $i = 0;
        if ($orderdetails_result) {
            while ($row2 = $orderdetails_result->fetch(PDO::FETCH_ASSOC)) {
                $orderDetailsID = $row2["orderDetailsId"];
                $orderID = $row2["orderID"];
                $productcode = $row2["productCode"];
                $Quantity = $row2["Quantity"];
                $UnitPrice = $row2["UnitPrice"];
                $result[$i] = new OrderDetailsOB($orderDetailsID, $orderID, $productcode, $Quantity, $UnitPrice);
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

    public function getOrderBy($orderID) {
        $conn = Database::getInstance();
        $query = "SELECT users.Name FROM users,orders WHERE users.userID = orders.userID AND orders.orderID = '$orderID'";
        $OrderBy = $conn->query($query);
        if (!$OrderBy) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        while ($row = $OrderBy->fetch(PDO::FETCH_ASSOC)) {
            $result = $row["Name"];
        }
        return $result;
    }

    public function getAllOrders() {
        $conn = Database::getInstance();
        $query = "SELECT * FROM ORDERS";
        $orderlist_result = $conn->query($query);
        $i = 0;
        if ($orderlist_result) {
            while ($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)) {
                $orderID = $row["orderID"];
                $userid = $row["userID"];
                $orderDate = $row["orderDate"];
                $Pickup = $row["Pickup"];
                $DeliveryAddress = $row["DeliveryAddress"];
                $RequiredDate = $row["RequiredDate"];
                $TotalAmount = $row["TotalAmount"];
                $Status = $row["Status"];
                $result[$i] = new OrderOB($orderID, $userid, $orderDate, $Pickup, $DeliveryAddress, $RequiredDate, $TotalAmount, $Status);
                $i++;
            }
        }

        return $result;
    }

    public function updateStatus($orderID, $Status) {
        $conn = Database::getInstance();
        $query = "UPDATE orders SET STATUS = '$Status' WHERE orderID = '$orderID'";
        $updateResult = $conn->query($query);
        if (!$updateResult) {
            trigger_error('Invalid Query : ' . $conn->error);
        }
    }

    public function getStatus($orderID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM orders WHERE orderID = '$orderID'";
        $Result = $conn->query($query);
        if ($Result) {
            while ($row = $Result->fetch(PDO::FETCH_ASSOC)) {
                $orderID = $row["orderID"];
                $userID = $row["userID"];
                $orderDate = $row["orderDate"];
                $Pickup = $row["Pickup"];
                $DeliveryAddress = $row["DeliveryAddress"];
                $RequiredDate = $row["RequiredDate"];
                $TotalAmount = $row["TotalAmount"];
                $Status = $row["Status"];
            }
        }
        return $Status;
    }

}
