<?php

include_once '../../Object/OrderDetailsOB.php';
class ReviewOrderController {
    //put your code here
    

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
        $Record = $this->domDocument->getElementById("Record");
        if (!$Record) {
            throw new Exception("Error, something went wrong, XML or things not found.");
        }

        $invoiceRecord->setInvoiceNo($Record->getElementsByTagName("orderID")->item(0)->nodeValue);
        $invoiceRecord->setInvoiceDate($Record->getElementsByTagName("userID")->item(0)->nodeValue);
        $invoiceRecord->setInvoiceUserID($Record->getElementsByTagName("orderDate")->item(0)->nodeValue);
        $invoiceRecord->setInvoiceUserID($Record->getElementsByTagName("Pickup")->item(0)->nodeValue);
        $invoiceRecord->setInvoiceUserID($Record->getElementsByTagName("DeliveryAddress")->item(0)->nodeValue);
        $invoiceRecord->setInvoiceUserID($Record->getElementsByTagName("RequiredDate")->item(0)->nodeValue);
        $invoiceRecord->setInvoiceUserID($Record->getElementsByTagName("TotalAmount")->item(0)->nodeValue);
        $invoiceRecord->setInvoiceUserID($Record->getElementsByTagName("Status")->item(0)->nodeValue);
       
  

        return $dailyrecord;
    }

//    public function clearRecord() { // Same problem as getRecord, getElementsByTagName doesnt work
//        $oldRecord = $this->domDocument->getElementById("Record"); //get Root
//        $this->domDocument->documentElement->removeChild($oldRecord); // remove root
//        // save back to disk 
//        $this->domDocument->save($this->xmlPath);
//    }
//
//    public function updateRecord(InvoiceOB $dailyrecord) {
//
//        $Record = $this->domDocument->createElement("InvoiceRecord");
//        $Record->setAttribute("recordID", "invoiceRecord");
//        $this->domDocument->documentElement->appendChild($Record);
//
//        $invoiceNumber = $this->domDocument->createElement("InvoiceNumber", $dailyrecord->getInvoiceNo());
//        $Record->appendChild($invoiceNumber);
//
//
//        $invoiceDate = $this->domDocument->createElement("InvoiceDate", $dailyrecord->getInvoiceDate());
//        $Record->appendChild($invoiceDate);
//
//        $userID = $this->domDocument->createElement("UserID", $dailyrecord->getInvoiceUserID());
//        $Record->appendChild($userID);
//        
//       # $orderID = $this->domDocument->createElement("OrderID",$dailyrecord->getInvoiceOrderID());
//        #$Record->appendChild($orderID);
//        
//        $InvoicetotalAmount = $this->domDocument->createElement("InvoiceAmount", $dailyrecord->getInvoiceAmount());
//        $Record->appendChild($InvoicetotalAmount);
//
//        $invoicePaymentStatus = $this->domDocument->createElement("PaymentStatus", $dailyrecord->getPaymentStatus());
//        $Record->appendChild($invoicePaymentStatus);
//
//        $this->domDocument->save($this->xmlPath);
//    }
//
//    public function getInvoice($userID) {
//        include_once 'Object/InvoiceOB.php';
//        $conn = Database::getInstance();
//        $query = "SELECT * FROM invoices WHERE userID = '$userID'";
//        $invoice_result = $conn->query($query);
//
//        if ($invoice_result) {
//            while ($row = $invoice_result->fetch(PDO::FETCH_ASSOC)) {
//                $invoice_no = $row['invoice_no'];
//                $invoice_date = $row['invoice date'];
//                $invoice_amt = $row['invoice_amount'];
//                $paymentStatus = $row['paymentStatus'];
//                $paymentDate = $row['paymentDate'];
//                $result = new InvoiceOB($invoice_no, $invoice_date, $userID, "", $invoice_amt, $paymentStatus, $paymentDate);
//            }
//        }
//        if (empty($result)) {
//            return null;
//        }
//        return $result;
//    }
//    public function delInvoice($InvoiceNo, $userID) {
//        include_once 'Object/InvoiceOB.php';
//        $conn = Database::getInstance();
//        $query = "DELETE FROM invoices WHERE invoice_no = '$InvoiceNo'";
//        $invoice_result = $conn->query($query);
//        $conn->close();
//        $conn2 = Database::getInstance();
//        $query = "UPDATE users SET usedCredit = 0 WHERE userID = '$userID'";
//        $result = $conn2->query($query);
//        $conn2->close();
//    }
}
