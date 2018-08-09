<?php
/**
 * Description of customOrderControl.php
 *
 * @author Chan Jeng Yang
 */
    ini_set('display_errors', 1);
    include_once './Object/CustomOrder.php';
    include_once './databaseconn.php';

class customOrderControl {
    
    private $tableName = "customorder";


    public function insertRecord(CustomOrder $order){
        $data= [
            'custOrderID' => $order->getCustOrderID(),
            'userID' => $order->getUserID(),
            'Pickup' => $order->getPickup(),
            'DeliveryAddress' => $order->getDeliveryAdd(),
            'RequiredDate' => $order->getRequireDate(),
            'TotalAmount' => $order->getTotalAmt(),
            'PaymentStatus' =>$order->getPaymentStatus()
        ];
        
        $connection = Database::getInstance(); 
        $query = "INSERT INTO $this->tableName (custOrderID,userID,Pickup,DeliveryAddress,RequiredDate,TotalAmount,PaymentStatus)"
                . "VALUES (:custOrderID,:userID,:Pickup,:DeliveryAddress,:RequiredDate,:TotalAmount,:PaymentStatus)";
        $stmt = $connection->prepare($query);
        $stmt->execute($data);    
        $connection->close();
    }
    public function getLastInsertedID(){
        $connection = Database::getInstance();
        $query = "SELECT * FROM $this->tableName ORDER BY custOrderID DESC LIMIT 1";
        $result = $connection->query($query);
        if(!$result){
            trigger_error("Invalid query: " . $connection->error);
        }
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if(!$row){
            $userID = "CO000";
        } else {
            $userID = $row["custOrderID"];
        } 
        $connection->close();
       // while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        return $userID;
    }
    
}
