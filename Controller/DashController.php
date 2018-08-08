<!-- Author     : leang -->
<?php

include_once('databaseconn.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DashController
 *
 * @author leang
 */
class DashController {

    public function getUnpaidCount($userID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM orders WHERE userID = '$userID'";
        $orderlist_result = $conn->query($query);
        $i = 0;
        $conn->close();
        if (!$orderlist_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        
        while ($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)) {
            if($row['Status'] == "Unpaid"){
                $i++;
            }
        }
        return $i;
    }

    public function getUnpaidSub($userID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM orders WHERE userID = '$userID'";
        $orderlist_result = $conn->query($query);
        $i = 0;
        if (!$orderlist_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        while ($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)) {
            if($row['Status'] == "Unpaid"){
                $i = $i + $row['TotalAmount'];
            }
        }
        return $i;
    }

    public function getOrderCount($userID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM orders WHERE userID = '$userID'";
        $orderlist_result = $conn->query($query);
        $i = 0;
        if (!$orderlist_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        while ($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)) {
            $i++;
        }
        return $i;
    }
    public function getOrderSub($userID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM orders WHERE userID = '$userID'";
        $orderlist_result = $conn->query($query);
        $i = 0;
        if (!$orderlist_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        while ($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)) {
            $i = $row['TotalAmount'] + $i;
        }
        return $i;
    }

    public function getPaidCount($userID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM orders WHERE userID = '$userID'";
        $orderlist_result = $conn->query($query);
        $i = 0;
        if (!$orderlist_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        while ($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)) {
            if($row['Status'] == "Paid" || $row['Status'] == "Completed"){
                 $i++;
            }
        }
        return $i;
    }

    public function getPaidSub($userID) {
        $conn = Database::getInstance();
        $query = "SELECT * FROM orders WHERE userID = '$userID'";
        $orderlist_result = $conn->query($query);
        $i = 0;
        if (!$orderlist_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        while ($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)) {
            if($row['Status'] == "Paid" || $row['Status'] == "Completed"){
                 $i = $i + $row['TotalAmount'];
            }
        }
        return $i;
    }

}
