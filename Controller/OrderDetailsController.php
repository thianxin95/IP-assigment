<?php


/**
 * Description of OrderDetailsController
 *
 * @author Daniel
 */
include_once '../../databaseconn.php';
include_once '../../Object/OrderDetailsOB.php';
include_once '../../Object/OrderOB.php';
class OrderDetailsController {
    public function getOrderDetailsID(){
        $conn = Database::getInstance();
        $query = "SELECT IF( MAX( orderDetailsId ) IS NULL , 0, MAX( orderDetailsId ) ) AS 'CurrentorderDetailsID' FROM orderdetails ORDER BY orderDetailsId DESC";
      // $query = "SELECT COUNT(*) AS 'CurrentRow' FROM orderdetails";
        $orderDetailslist_result = $conn->query($query);
        $conn->close();
        if($orderDetailslist_result){
            while($row = $orderDetailslist_result->fetch(PDO::FETCH_ASSOC)){
                $CurrentorderDetailsID = $row["CurrentorderDetailsID"];
                $result = $CurrentorderDetailsID;
//                $CurrentRow = $row["CurrentRow"];
//                $result = $CurrentRow;
            }
        }
        return $result;
    }
    
    public function getOrderID(){
        $conn = Database::getInstance();
        $query = "SELECT IF( MAX( orderID ) IS NULL , 0, MAX( orderID ) ) AS 'CurrentOrderID' FROM orders ORDER BY orderID DESC";
        $orderlist_result = $conn->query($query);
        $conn->close();
        if($orderlist_result){
            while($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)){
                $CurrentOrderID = $row["CurrentOrderID"];
                $result = $CurrentOrderID;
            }
        }
        return $result;
    }
    public function addRecord(OrderDetailsOB $OrderDetail){
        $conn = Database::getInstance();
        $orderDetailID = $OrderDetail->getOrderDetailsID();
        $orderID = $OrderDetail->getOrderID();
        $productCode = $OrderDetail->getProductCode();
        $quantity = $OrderDetail->getQuantity();
        $unitPrice = $OrderDetail->getUnitPrice();
        $query = "INSERT INTO orderdetails VALUES ('$orderDetailID','$orderID','$productCode','$quantity','$unitPrice')";
        $addResult = $conn->query($query);
        $conn->close();
              if(!$addResult){
            trigger_error('Invalid Query : ' . $conn->error);
        }
    }
    
        public function getAllOrderDetail(){
        $sql = "SELECT * FROM orderdetails";
        $conn = Database::getInstance();
        $orderDetailResult = $conn->query($sql);
        if(!$orderDetailResult){
            trigger_error("Invalid query: " . $conn->error);
        }
        $conn->close();
        $i = 0;
     if($orderDetailResult){
         while ($row = $orderDetailResult->fetch(PDO::FETCH_ASSOC)) {
             $orderDetailsID = $row["orderDetailsId"];
             $orderID = $row["orderID"];
             $productCode = $row["productCode"];
             $Quantity = $row["Quantity"];
             $UnitPrice = $row["UnitPrice"];
             
             $result[$i] = new OrderOB($orderDetailsID, $orderID, $productCode,$Quantity,$UnitPrice);
             $i++;
         }
     }
     return $result;                        
}
    
}
