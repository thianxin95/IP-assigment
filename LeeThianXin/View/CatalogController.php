
<?php

/**
 * Description of CatalogController
 *
 * @author Daniel
 */
include_once '../Model/Order.php';
include_once '../../Object/CatalogOB.php';

class CatalogController {
    private $xmlPath;
    private $domDocument;
    
    public function __construct($xmlPath) {
        $doc = new DOMDocument();
        $doc->load($xmlPath);
        
    if ($doc->validate()) {
            $this->domDocument = $doc;
            $this->xmlPath = $xmlPath;           
        } else {
            throw new Exception("Document did not validate");
        }
        
    }
    
    public function __destruct() {
        unset($this->domDocument);
    }
    
    public function getRecord(){
        $orderRecord = new Order();
        $Record = $this->domDocument->getElementById("ORD1");
        if(!$Record){
            throw new Exception("Error, something went wrong, XML or things not found.");
        }
        
        $orderRecord->setOrderID($Record->getElementsByTagName("orderID")->item(0)->nodeValue);
        $orderRecord->setUserID($Record->getElementsByTagName("userID")->item(0)->nodeValue);
        $orderRecord->setOrderDate($Record->getElementsByTagName("orderDate")->item(0)->nodeValue);
        $orderRecord->setPickup($Record->getElementsByTagName("pickup")->item(0)->nodeValue);
        $orderRecord->setDeliveryAddress($Record->getElementsByTagName("deliveryAddress")->item(0)->nodeValue);
        $orderRecord->setRequiredDate($Record->getElementsByTagName("requiredDate")->item(0)->nodeValue);
        $orderRecord->setStatus($Record->getElementsByTagName("status")->item(0)->nodeValue);
        
        return $orderRecord;
    }
    
    public function clearRecord(){
        $oldRecord = $this->domDocument->getElementById("c1");
        $this->domDocument->documentElement->removeChild($oldRecord); // remove root
        // save back to disk 
        $this->domDocument->save($this->xmlPath);
    }
    
    public function updateRecord(CatalogOB $catalogOB){
        $this->domDocument->formatOutput=TRUE;
        
        $CatalogRow = $this->domDocument->createElement("CatalogRow");      
        $this->domDocument->documentElement->appendChild($CatalogRow);

        $productCode = $this->domDocument->createElement("productCode", $catalogOB->getProductCode());
        $CatalogRow->appendChild($productCode);

        $productType = $this->domDocument->createElement("productType", $catalogOB->getProducttype());
        $CatalogRow->appendChild($productType);

        $productQuantity = $this->domDocument->createElement("productQuantity", $catalogOB->getProductquantity());
        $CatalogRow->appendChild($productQuantity);

        $totalPrice = $this->domDocument->createElement("totalPrice", $catalogOB->getTotalprice());
        $CatalogRow->appendChild($totalPrice);

        $userID = $this->domDocument->createElement("userID", $catalogOB->getUserID());
        $CatalogRow->appendChild($userID);

        $userType = $this->domDocument->createElement("userType", $catalogOB->getUserID());
        $CatalogRow->appendChild($userType);

        
//        
//        $CatalogRow = $this->domDocument->createElement("CatalogRow");
//        $CatalogRow->setAttribute("rowID", "c1");
//        $this->domDocument->documentElement->appendChild($CatalogRow);
//
//        $orderID = $this->domDocument->createElement("orderID", $order->getOrderID());
//        $CatalogRow->appendChild($orderID);
//
//        $userID = $this->domDocument->createElement("userID", $order->getUserID());
//        $CatalogRow->appendChild($userID);
//
//        $orderDate = $this->domDocument->createElement("orderDate", $order->getOrderDate());
//        $CatalogRow->appendChild($orderDate);
//
//        $pickup = $this->domDocument->createElement("pickup", $order->getPickup());
//        $CatalogRow->appendChild($pickup);
//
//        $deliveryAddress = $this->domDocument->createElement("deliveryAddress", $order->getDeliveryAddress());
//        $CatalogRow->appendChild($deliveryAddress);
//
//        $requiredDate = $this->domDocument->createElement("requiredDate", $order->getRequiredDate());
//        $CatalogRow->appendChild($requiredDate);
//
//        $totalAmount = $this->domDocument->createElement("totalAmount", $order->getTotalAmount());
//        $CatalogRow->appendChild($totalAmount);
//
//        $status = $this->domDocument->createElement("status", $order->getStatus());
//        $CatalogRow->appendChild($status);
        
        
        $this->domDocument->save($this->xmlPath);
    }

}
