<?php

class InvoiceOB {
    private $invoiceNo;
    private $invoiceDate;
    private $invoiceUserID;
    private $invoiceOrderID;
    private $invoiceAmount;
    private $paymentStatus;
    private $paymentDate;
    
    public function InvoiceDB($invoiceNo, $invoiceDate,$invoiceUserID,$invoiceOrderID,$invoiceAmount,$paymentStatus, $paymentDate){
        $this->invoiceNo = $invoiceNo;
        $this->invoiceDate = $invoiceDate;
        $this->invoiceUserID = $invoiceUserID;
        $this->invoiceOrderID=$invoiceOrderID;
        $this->invoiceAmount=$invoiceAmount;
        $this->paymentStatus = $paymentStatus;
        $this->paymentStatus = $paymentDate;
        
        
    }
    function getInvoiceNo() {
        return $this->invoiceNo;
    }

    function getInvoiceDate() {
        return $this->invoiceDate;
    }

    function getInvoiceUserID() {
        return $this->invoiceUserID;
    }

    function getInvoiceOrderID() {
        return $this->invoiceOrderID;
    }

    function getInvoiceAmount() {
        return $this->invoiceAmount;
    }

    function getPaymentStatus() {
        return $this->paymentStatus;
    }

    function getPaymentDate() {
        return $this->paymentDate;
    }

    function setInvoiceNo($invoiceNo) {
        $this->invoiceNo = $invoiceNo;
    }

    function setInvoiceDate($invoiceDate) {
        $this->invoiceDate = $invoiceDate;
    }

    function setInvoiceUserID($invoiceUserID) {
        $this->invoiceUserID = $invoiceUserID;
    }

    function setInvoiceOrderID($invoiceOrderID) {
        $this->invoiceOrderID = $invoiceOrderID;
    }

    function setInvoiceAmount($invoiceAmount) {
        $this->invoiceAmount = $invoiceAmount;
    }

    function setPaymentStatus($paymentStatus) {
        $this->paymentStatus = $paymentStatus;
    }

    function setPaymentDate($paymentDate) {
        $this->paymentDate = $paymentDate;
    }


}
