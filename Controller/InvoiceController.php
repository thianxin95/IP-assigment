<?php

/**
 * Description of InvoiceController
 *
 * @author Daniel
 */
include_once '../../databaseconn.php';
include_once '../../Object/InvoiceOB.php';
class InvoiceController {
    public function getUserInvoiceNo($userID){
        $conn = Database::getInstance();
        $query = "SELECT * FROM invoices WHERE userID = '$userID'";
        $invoice_result = $conn->query($query);
       
         if (!$invoice_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        if($invoice_result){
            while($row = $invoice_result->fetch(PDO::FETCH_ASSOC)){
                $invoiceNo = $row["invoiceNo"]; 
                $invoiceDate = $row["invoiceDate"];
                $userID = $row["userID"];
                $invoiceAmount = $row["invoiceAmount"];
                $paymentStatus = $row["paymentStatus"];
                $paymentDate = $row["paymentDate"];
                $result = neW InvoiceOB($invoiceNo,$invoiceDate,$userID,$invoiceAmount,$paymentStatus,$paymentDate);
                
            }
        }
        if(empty($result)){
            return null;
        }else{
            return $result;
        }
    }
    
    public function insertInvoice(InvoiceOB $invoice){
        $conn = Database::getInstance();
        $invoiceNo = $invoice->getInvoiceNo();
        $invoiceDate = $invoice->getInvoiceDate();
        $userID = $invoice->getInvoiceUserID();
        $invoiceAmount = $invoice->getInvoiceAmount();
        $paymentStatus = $invoice->getPaymentStatus();
        $paymentDate = $invoice->getPaymentDate();
        
        $query = "INSERT INTO invoices VALUES ('$invoiceNo', '$invoiceDate', '$userID', '$invoiceAmount', '$paymentStatus', '$paymentDate')";
        $addResult = $conn->query($query);
        $conn->close();
              if(!$addResult){
            trigger_error('Invalid Query : ' . $conn->error);
        }
        
    }
    
    public function updateInvoice(InvoiceOB $invoice, $userID){
        $conn = Database::getInstance();
        $invoiceNo = $invoice->getInvoiceNo();
        $invoiceDate = $invoice->getInvoiceDate();
        $userID = $invoice->getInvoiceUserID();
        $invoiceAmount = $invoice->getInvoiceAmount();
        $paymentStatus = $invoice->getPaymentStatus();
        $paymentDate = $invoice->getPaymentDate();
        $query = "UPDATE invoices SET invoiceDate ='$invoiceDate', invoiceAmount = '$invoiceAmount', paymentStatus ='$paymentStatus', paymentDate = '$paymentDate'";
        $updateResult = $conn->query($query);
        if (!$updateResult) {
            trigger_error('Invalid Query : ' . $conn->error);
        }
    }
    public function getInvoiceNo(){
        $conn = Database::getInstance();
        $query = "SELECT invoiceNo FROM invoices ORDER BY invoiceNo DESC LIMIT 1";
        $invoice_result = $conn->query($query);
        //$i;
         if (!$invoice_result) {
            trigger_error('Invalid query: ' . $conn->error);
        }
        $conn->close();
        if($invoice_result){
            while($row = $invoice_result->fetch(PDO::FETCH_ASSOC)){
                $invoiceNo = $row["invoiceNo"]; 
                $result = $invoiceNo;
//                $result[$i] = $invoiceNo;
//                $i++;
            }
    }
    if(empty($result)){
            return null;
        }else{
            return $result;
        }
}
}
