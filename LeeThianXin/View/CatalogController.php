
<?php

/**
 * Description of CatalogController
 *
 * @author Daniel
 */

include_once '../../Object/OrderDetailsOB.php';

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
    
    public function clearRecord(){
        $oldRecord = $this->domDocument->getElementById("c1");
        $this->domDocument->documentElement->removeChild($oldRecord); // remove root
        // save back to disk 
        $this->domDocument->save($this->xmlPath);
    }
    
    public function updateRecord(OrderDetailsOB $orderDetailsOB){
  
        
        $CatalogRow = $this->domDocument->createElement("CatalogRow"); 
        $CatalogRow->setAttribute("productCode", "aabba1");
        $this->domDocument->documentElement->appendChild($CatalogRow);

        $OrderDetailsID = $$this->domDocument->createElement("OrderDetailsID", "2");
        $CatalogRow->appendChild($OrderDetailsID);

        $OrderID = $this->domDocument->createElement("OrderID", "3");
        $CatalogRow->appendChild($OrderID);

        $ProductCode = $this->domDocument->createElement("ProductCode", "4");
        $CatalogRow->appendChild($ProductCode);

        $Quantity = $this->domDocument->createElement("Quantity", "5");
        $CatalogRow->appendChild($Quantity);

        $UnitPrice = $this->domDocument->createElement("UnitPrice", "6");
        $CatalogRow->appendChild($UnitPrice);
        
      
        $this->domDocument->save($this->xmlPath);
    }

}
