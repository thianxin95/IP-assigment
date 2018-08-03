<?php
include_once ('../Object/DailyRecordOB.php');
class ReportController {

    private $xmlPath;
    private $domDocument;
    
    public function __construct($xmlPath) {
        //loads the document 
        $doc = new DOMDocument();
        $doc->load($xmlPath);

        //is this the desired xml file? 
       /* If ($doc->doctype->name != "Daily_OrderProcessed" || $doc->doctype->systemId != "Daily_OrderProcessed.dtd") {
            throw new Exception("Incorrect document type");
        }*/
        /// The name check seems a little bit problemetic , removing it works
        
        
        //is the document valid and well-formed? 
        if ($doc->validate()) {
            $this->domDocument = $doc;
            $this->xmlPath = $xmlPath;
        } else {
            throw new Exception("Document did not validate");
        }
    }

    public function __destruct() {
        // TODO: free memory associated with the DOMDocument
        unset($this->domDocument); 
    }

    public function getRecord() { 
//problemetic possibly because there is no getElementbyID Source UPDATE : ALL FIX
        $dailyrecord = new DailyRecordOB();
        $Record = $this->domDocument->getElementById("RID1");
        if (!$Record) {
            throw new Exception("Error, something went wrong, XML or things not found."); 
        }
        
        $dailyrecord->setOrderCount($Record->getElementsByTagName("OrderCount")->item(0)->nodeValue);
        $dailyrecord->setDate($Record->getElementsByTagName("Date")->item(0)->nodeValue);
        $dailyrecord->setTotalAmount($Record->getElementsByTagName("TotalAmount")->item(0)->nodeValue);
        $dailyrecord->setPickupCount($Record->getElementsByTagName("PickupCount")->item(0)->nodeValue);
        $dailyrecord->setDeliveryCount($Record->getElementsByTagName("DeliveryCount")->item(0)->nodeValue);
        
        return $dailyrecord;
    }

    
    
    public function clearRecord(){ // Same problem as getRecord, getElementsByTagName doesnt work
        $oldRecord = $this->domDocument->getElementById("RID1"); //get Root
        $this->domDocument->documentElement->removeChild($oldRecord); // remove root
        // save back to disk 
        $this->domDocument->save($this->xmlPath);
    }
    
    public function updateRecord(DailyRecordOB $dailyrecord) {

        $Record = $this->domDocument->createElement("Record");
        $Record->setAttribute("recordID", "RID1");
        $this->domDocument->documentElement->appendChild($Record);
        
        $OrderCount = $this->domDocument->createElement("OrderCount", $dailyrecord->getOrderCount());
        $Record->appendChild($OrderCount);
        
        
        $Date = $this->domDocument->createElement("Date", $dailyrecord->getDate());
        $Record->appendChild($Date);
        
        $TotalAmount = $this->domDocument->createElement("TotalAmount", $dailyrecord->getTotalAmount());
        $Record->appendChild($TotalAmount);
        
        $newOrderType = $this->domDocument->createElement("OrderTypeCount");
        $Record->appendChild($newOrderType);
        
        $DeliveryCount = $this->domDocument->createElement("DeliveryCount", $dailyrecord->getDeliveryCount());
        $newOrderType->appendChild($DeliveryCount);
        
        $PickupCount = $this->domDocument->createElement("PickupCount",$dailyrecord->getPickupCount());
        $newOrderType->appendChild($PickupCount);
        
        $this->domDocument->save($this->xmlPath);
        
    }

}
