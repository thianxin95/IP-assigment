<?php

include_once('databaseconn.php');
include_once('Object/OrderOB.php');
include_once('Object/OrderDetailsOB.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * <!-- Author     : leang -->
 */

class OrderListController {

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
        if (empty($result)) {
            return null;
        } else {
            return $result;
        }
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

    public function getInvoiceUserID($userID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM invoices WHERE userID = '$userID'";
        $invoicelist_result = $conn->query($query);
        $i = 0;
        if (!$invoicelist_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        if ($invoicelist_result) {
            while ($row = $invoicelist_result->fetch(PDO::FETCH_ASSOC)) {
                $invoiceNO = $row["invoiceNo"];
                $invoiceDate = $row["invoiceDate"];
                $invoiceUserID = $row["userID"];
                
                $invoiceAmount = $row["invoiceAmount"];
                $PaymentStatus = $row["paymentStatus"];
                $PaymentDate = $row["paymentDate"];
                $result[$i] = new InvoiceOB($invoiceNO, $invoiceDate, $invoiceUserID, $invoiceAmount, $PaymentStatus, $PaymentDate);
                $i++;
            }
        }
        return $result;
    }

    public function getOrderBy($orderID) {
        $conn = Database::getInstance();
        $query = "SELECT users.Name FROM users,orders WHERE users.userID = orders.userID AND orders.orderID = '$orderID'";
        $OrderBy = $conn->query($query);
        if (!$OrderBy) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        return $OrderBy;
    }

    public function getAllOrders() {
        $conn = Database::getInstance();
        $query = "SELECT * FROM ORDERS";
        $orderlist_result = $conn->query($query);

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

        return $orderlist_result;
    }

    public function updateOrderStatus($orderID, $Status) {
        $conn = Database::getInstance();
        $query = "UPDATE orders SET STATUS = '$Status' WHERE orderID = '$orderID'";
        $updateResult = $conn->query($query);
        if (!$updateResult) {
            trigger_error('Invalid Query : ' . $conn->error);
        }
    }

}
