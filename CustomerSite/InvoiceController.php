<?php
include 'Object/CustomerOb.php';
class InvoiceController {

    private $xmlPath;
    private $domDocument;
    
    public function __construct($xmlPath) {
        //loads the document 
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
        // TODO: free memory associated with the DOMDocument
        unset($this->domDocument); 
    }

    public function getRecord() { 
//problemetic possibly because there is no getElementbyID Source UPDATE : ALL FIX
        $invoiceRecord = new InvoiceOB();
        $Record = $this->domDocument->getElementById("invoiceRecord");
        if (!$Record) {
            throw new Exception("Error, something went wrong, XML or things not found."); 
        }
        
        $invoiceRecord->setInvoiceNo($Record->getElementsByTagName("InvoiceNumber")->item(0)->nodeValue);
        $invoiceRecord->setInvoiceDate($Record->getElementsByTagName("InvoiceDate")->item(0)->nodeValue);
        $invoiceRecord->setInvoiceUserID($Record->getElementsByTagName("UserID")->item(0)->nodeValue);
       # $invoiceRecord->setInvoiceOrderID($Record->getElementsByTagName("OrderID")->item(0)->nodeValue);
        $invoiceRecord->setInvoiceAmount($Record->getElementsByTagName("InvoiceAmount")->item(0)->nodeValue);
        $invoiceRecord->setPaymentStatus($Record->getElementsByTagName("PaymentStatus")->item(0)->nodeValue);
        
        return $dailyrecord;
    }

    
    
    public function clearRecord(){ // Same problem as getRecord, getElementsByTagName doesnt work
        $oldRecord = $this->domDocument->getElementById("invoiceRecord"); //get Root
        $this->domDocument->documentElement->removeChild($oldRecord); // remove root
        // save back to disk 
        $this->domDocument->save($this->xmlPath);
    }
    
    public function updateRecord(InvoiceOB $dailyrecord) {

        $Record = $this->domDocument->createElement("InvoiceRecord");
        $Record->setAttribute("recordID", "invoiceRecord");
        $this->domDocument->documentElement->appendChild($Record);
        
        $invoiceNumber = $this->domDocument->createElement("InvoiceNumber", $dailyrecord->getInvoiceNo());
        $Record->appendChild($invoiceNumber);
        
        
        $invoiceDate = $this->domDocument->createElement("InvoiceDate", $dailyrecord->getInvoiceDate());
        $Record->appendChild($invoiceDate);
        
        $userID = $this->domDocument->createElement("UserID", $dailyrecord->getInvoiceUserID());
        $Record->appendChild($userID);
        
       # $orderID = $this->domDocument->createElement("OrderID",$dailyrecord->getInvoiceOrderID());
        #$Record->appendChild($orderID);
        
        $InvoicetotalAmount = $this->domDocument->createElement("InvoiceAmount", $dailyrecord->getInvoiceAmount());
        $Record->appendChild($InvoicetotalAmount);
        
        $invoicePaymentStatus = $this->domDocument->createElement("PaymentStatus",$dailyrecord->getPaymentStatus());
        $Record->appendChild($invoicePaymentStatus);
        
        $this->domDocument->save($this->xmlPath);
        
    }

}

