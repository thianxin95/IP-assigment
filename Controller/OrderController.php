<?php
/**
 * Description of OrderController
 *
 * @author Daniel
 */
include_once '../../databaseconn.php';
include_once '../../Object/OrderOB.php';

class OrderController {
    //get last order ID
    private $tableName = "orders";
    public function getOrderID(){
        $conn = Database::getInstance();
        $query = "SELECT IF( MAX( orderID ) IS NULL , 0, MAX( orderID ) ) AS 'CurrentOrderID' FROM orders ORDER BY orderID DESC";
        $orderID_result = $conn->query($query);
        $conn->close();
        if($orderID_result){
            while($row = $orderID_result->fetch(PDO::FETCH_ASSOC)){
                $CurrentOrderID = $row["CurrentOrderID"];
                $result = $CurrentOrderID;
            }
        }
        return $result;
    }
    
    public function addOrder(OrderOB $orderOB){
        $conn = Database::getInstance();
        
        $orderID = $orderOB->getOrderID();
        $userID = $orderOB->getUserID();
        $orderDate = $orderOB->getOrderDate();
        $Pickup = $orderOB->getPickup();
        $DeliveryAddress = $orderOB->getDeliveryAddress();
        $RequiredDate = $orderOB->getRequiredDate();
        $TotalAmount = $orderOB->getTotalAmount();
        $Status = $orderOB->getStatus();
        
        $query = "INSERT INTO orders VALUES ('$orderID','$userID','$orderDate','$Pickup','$DeliveryAddress','$RequiredDate','$TotalAmount','$Status')";
        $addResult = $conn->query($query);
        $conn->close();
        if(!$addResult){
            trigger_error('Invalid Query : ' . $conn->error);
        }
        
        

        
        
    }
}
