<?php
    include_once './Object/CustomOrder.php';
    include_once './databaseconn.php';

class customOrderDA {
    
    private $tableName = "customorder";


    public function insertRecord(CustomOrder $order){
        $connection = Database::getInstance(); 
        $query = "INSERT INTO".$this->tableName."(custOrderID,userID,Pickup,DeliveryAddress,RequiredDate,TotalAmount,PaymentStatus)"
                . "VALUES (?,?,?,?,?,?,?)";
        $stmt = $connection->query($query);
        $stmt->bindParam(1,$order->getCustOrderID());
        $stmt->bindParam(2,$order->getUserID());
        $stmt->bindParam(3,$order->getPickup());
        $stmt->bindParam(4,$order->getDeliveryAdd());
        $stmt->bindParam(5,$order->getRequireDate());
        $stmt->bindParam(6,$order->getTotalAmt());
        $stmt->bindParam(7,$order->getPaymentStatus());
        $stmt->execute();
                
    }
    // error
    public function getLastInsertedID(){
        $connection = Database::getInstance();
        $query = "SELECT * FROM ".$this->tableName."ORDER BY 'custOrderID' DESC LIMIT 1";
        $result = $connection->query($query);
        if(!$result){
            trigger_error("Invalid query: " . $conn->error);
        }
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
           $userID[] = $row["custOrderID"];
        }
        return $userID;
    }
    
}
