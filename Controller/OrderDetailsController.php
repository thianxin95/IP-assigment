<?php

/**
 * Description of OrderDetailsController
 *
 * @author Daniel Lee
 */
include_once '../../databaseconn.php';
include_once '../../Object/OrderDetailsOB.php';
include_once '../../Object/OrderOB.php';

class OrderDetailsController {

    public function getOrderDetailsID() {
        $conn = Database::getInstance();
        $query = "SELECT orderDetailsId FROM orderdetails ORDER BY orderDetailsId DESC LIMIT 1";
        $orderDetailslist_result = $conn->query($query);
        if (!$orderDetailslist_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        if ($orderDetailslist_result) {
            while ($row = $orderDetailslist_result->fetch(PDO::FETCH_ASSOC)) {
                $orderDetailsId = $row["orderDetailsId"];
                $result = $orderDetailsId;
            }
        }
        if (empty($result)) {
            return null;
        } else {
            return $result;
        }
    }

    public function addRecord(OrderDetailsOB $OrderDetail) {
        $conn = Database::getInstance();
        $orderDetailID = $OrderDetail->getOrderDetailsID();
        $orderID = $OrderDetail->getOrderID();
        $productCode = $OrderDetail->getProductCode();
        $quantity = $OrderDetail->getQuantity();
        $unitPrice = $OrderDetail->getUnitPrice();
        $query = "INSERT INTO orderdetails VALUES ('$orderDetailID','$orderID','$productCode','$quantity','$unitPrice')";
        $addResult = $conn->query($query);
        $conn->close();
        if (!$addResult) {
            trigger_error('Invalid Query : ' . $conn->error);
        }
    }

    public function getAllOrderDetail() {
        $sql = "SELECT * FROM orderdetails";
        $conn = Database::getInstance();
        $orderDetailResult = $conn->query($sql);
        if (!$orderDetailResult) {
            trigger_error("Invalid query: " . $conn->error);
        }
        $conn->close();
        $i = 0;
        if ($orderDetailResult) {
            while ($row = $orderDetailResult->fetch(PDO::FETCH_ASSOC)) {
                $orderDetailsID = $row["orderDetailsId"];
                $orderID = $row["orderID"];
                $productCode = $row["productCode"];
                $Quantity = $row["Quantity"];
                $UnitPrice = $row["UnitPrice"];

                $result[$i] = new OrderDetailsOB($orderDetailsID, $orderID, $productCode, $Quantity, $UnitPrice);
                $i++;
            }
        }
        return $result;
    }
    

}
