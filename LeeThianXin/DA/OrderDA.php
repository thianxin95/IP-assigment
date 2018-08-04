<?php

include '../../databaseconn.php';
include_once '../Model/Order.php';

/**
 * Description of OrderDA
 *
 * @author Daniel
 */
    $conn = Database::getInstance();
class OrderDA {
    

    //put your code here      
    public function getOrder($userID){
        $conn = Database::getInstance();
        $query = "SELECT * FROM orders WHERE userID = '$userID'";
        $orderlist_result = $conn->query($query);
        if(!$orderlist_result){
            trigger_error('Invalid query: '. $conn->error);
        }
        $conn->close();
        if($orderlist_result){
            while($row = $orderlist_result->fetch(PDO::FETCH_ASSOC)){
                $orderList[$i] = new Order($row["orderID"], $row["userID"], $row["orderDate"], $row["Pickup"], $row["DeliveryAddress"], $row["RequiredDate"], $row["TotalAmount"], $row["Status"]);
                $i++;                                   
            }
            
        }
        return $orderList;
    }
    
    public function insertOrder(Order $order){
        
        $newOrder = [
            'orderID' => $order->getOrderID(),
            'userID' => $order->getUserID(),
            'orderDate' => $order->getOrderDate(),
            'pickup' => $order->getPickup(),
            'deliveryAddress' => $order->getDeliveryAddress(),
            'requiredDate' => $order->getRequiredDate(),
            'totalAmount' => $order->getTotalAmount(),
            'status' => $order->getStatus()
        ];
        
        $conn = Database::getInstance();
        $query = "INSERT INTO orders (orderID, userID, orderDate, Pickup, DeliveryAddress, RequiredDate, TotalAmount, Status) VALUES "
                . "(:orderID, :userID, :orderDate, :pickup, :deliveryAddress, :requiredDate, :totalAmount, :status)";
        $stmt = $conn->prepare($query);
        $stmt->execute($newOrder);
    }
}

