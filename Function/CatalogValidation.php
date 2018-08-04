<?php

$servername = "localhost";
$db_user = "root";
$db_password = "";
$db_table = "fioredb";

class CatalogValidation {
    
    private $_db;
    static $_instance;
    
    function __construct() {
        $this->_db = new PDO('mysql:host=localhost;dbname=fioredb', 'root', '');
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    private static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    private function query($sql) {
        return $this->_db->query($sql);
    }
    
    private function close(){
        self::$_instance = null;
    }
    
    public function checkProductCode($productCode){
        $sql = "SELECT productCode FROM product WHERE productCode = '$productCode'";
        $conn = CatalogValidation::getInstance();
        $productResult = $conn->query($sql);
        if(!$productResult){
            trigger_error("Invalid query: " . $conn->error);
        }
        $conn->close();
        
        $row = $productResult->fetch(PDO::FETCH_ASSOC);
        $productCode = $row["productCode"];
        
        $result = $productCode; 
        
        return $result;
        
        }
        
    public function checkAvailability($productCode){
        $sql = "SELECT Availability FROM product WHERE productCode = '$productCode'";
        $conn = CatalogValidation::getInstance();
        $productResult = $conn->query($sql);
        if(!$productResult){
            trigger_error("Invalid query: " . $conn->error);
        }
        $conn->close();
        
        $row = $productResult->fetch(PDO::FETCH_ASSOC);
        $productAvailability = $row["Availability"];
        
        $result = $productAvailability; 
        
        return $result;
        
        }
        
    public function checkProductAvailable($productCode){
        $sql = "SELECT productCode FROM product WHERE productCode = '$productCode' AND Availability = 'Available'";
        $conn = CatalogValidation::getInstance();
        $productResult = $conn->query($sql);
        if(!$productResult){
            trigger_error("Invalid query: " . $conn->error);
        }
        $conn->close();
        
        $row = $productResult->fetch(PDO::FETCH_ASSOC);
        $productCode = $row["productCode"];
        
        $result = $productCode; 
        
        return $result;
        
        }
        
}

?>
