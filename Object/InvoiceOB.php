<?php

class InvoiceOB {
    private $invoiceNo;
    private $invoiceDate;
    private $invoiceUserID;
    private $invoiceAmount;
    private $paymentStatus;
    private $paymentDate;
    
    function __construct($invoiceNo, $invoiceDate, $invoiceUserID, $invoiceAmount, $paymentStatus, $paymentDate) {
        $this->invoiceNo = $invoiceNo;
        $this->invoiceDate = $invoiceDate;
        $this->invoiceUserID = $invoiceUserID;
        $this->invoiceAmount = $invoiceAmount;
        $this->paymentStatus = $paymentStatus;
        $this->paymentDate = $paymentDate;
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
