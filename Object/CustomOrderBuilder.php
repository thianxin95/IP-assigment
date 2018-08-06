<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/Assignment2018/Object/Builder.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomOrderBuilder
 *
 * @author Hibiki
 */
class CustomOrderBuilder implements Builder{
    private $custOrderID;
    private $userID;
    private $pickup = "Yes";
    private $deliveryAdd = "-";
    private $requireDate;
    private $totalAmt;
    private $paymentStatus = "Unpaid";
    
    public function __construct($custOrderID, $userID,$requireDate, $totalAmt) {
        $this->custOrderID= $custOrderID;
        $this->userID = $userID;
        $this->requireDate = $requireDate;
        $this->totalAmt = $totalAmt;

    }

    public function getCustOrderID() {
        return $this->custOrderID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getPickup() {
        return $this->pickup;
    }

    public function getDeliveryAdd() {
        return $this->deliveryAdd;
    }

    public function getRequireDate() {
        return $this->requireDate;
    }

    public function getTotalAmt() {
        return $this->totalAmt;
    }

    public function getPaymentStatus() {
        return $this->paymentStatus;
    }

    public function custOrderID($custOrderID) {
        $this->custOrderID = $custOrderID;
        return $this;
    }

    public function userID($userID) {
        $this->userID = $userID;
        return $this;
    }

    public function pickup($pickup) {
        $this->pickup = $pickup;
        return $this;
    }

    public function deliveryAdd($deliveryAdd) {
        $this->deliveryAdd = $deliveryAdd;
        return $this;
    }

    public function requireDate($requireDate) {
        $this->requireDate = $requireDate;
        return $this;
    }

    public function totalAmt($totalAmt) {
        $this->totalAmt = $totalAmt;
        return $this;
    }

    public function setPaymentStatus($paymentStatus) {
        $this->paymentStatus = $paymentStatus;
    }

    public function build() {
        return new CustomOrder($this);
    }

}
