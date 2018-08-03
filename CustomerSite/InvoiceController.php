<?php
include_once ('../Object/CustomerOb.php');
include_once ('../Object/InvoiceDB.php');
include_once ('databaseconn.php');

session_start();

$user = new Customer("", "", "", "", "", "", "", "", "","");
if ($_SESSION["user"] == null) {
    echo "<script> location.href='login.php'; </script>";
}
$user = $_SESSION["user"];
$Username = $user->getUserID();


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
    $conn_updatedb = Database::getInstance();
    $query_updatedb = "SELECT * FROM invoices WHERE userID='$Username'";   
    $update_result = $conn_updatedb->query($query_updatedb);
    if (!$update_result) {
        trigger_error('Invalid query: ' . $conn->error);
    }
        
       $InvoiceRecord = new InvoiceOB();
      
        if (!$Record) {
            throw new Exception("Error, something went wrong, XML or things not found."); 
        }
        $InvoiceRecord->setInvoiceNo($Record->getElementsByTagName("InvoiceNumber")->item(0)->nodeValue);
        $InvoiceRecord->setInvoiceDate($Record->getElementsByTagName("InvoiceDate")->item(0)->nodeValue);
        $InvoiceRecord->setInvoiceUserID($Record->getElementsByTagName("UserID")->item(0)->nodeValue);
        $InvoiceRecord->setInvoiceOrderID($Record->getElementsByTagName("OrderID")->item(0)->nodeValue);
        $InvoiceRecord->setInvoiceAmount($Record->getElementsByTagName("InvoiceAmount")->item(0)->nodeValue);
        $InvoiceRecord->setPaymentStatus($Record->getElementsByTagName("PaymentStatus")->item(0)->nodeValue);
        
        return $dailyrecord;
    }

    
    
    public function clearRecord(){ // Same problem as getRecord, getElementsByTagName doesnt work
        $oldRecord = $this->domDocument->getElementById("RID1"); //get Root
        $this->domDocument->documentElement->removeChild($oldRecord); // remove root
        // save back to disk 
        $this->domDocument->save($this->xmlPath);
    }
    
}
?>

