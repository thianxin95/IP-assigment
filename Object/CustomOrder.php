<?php
    include_once 'CustomOrderBuilder.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomOrder
 *
 * @author Chan Jeng Yang
 */
class CustomOrder {
    private $custOrderID;
    private $userID;
    private $pickup;
    private $deliveryAdd;
    private $requireDate;
    private $totalAmt;
    private $paymentStatus;
    
    public function __construct(CustomOrderBuilder $builder) {
        $this->custOrderID = $builder->getCustOrderID();
        $this->userID = $builder->getUserID();
        $this->pickup = $builder->getPickup();
        $this->deliveryAdd = $builder->getDeliveryAdd();;
        $this->requireDate = $builder->getRequireDate();
        $this->totalAmt = $builder->getTotalAmt();
        $this->paymentStatus = $builder->getPaymentStatus();
    }

    static function createBuilder($custOrderID, $userID,$requireDate, $totalAmt){
        return new CustomOrderBuilder($custOrderID, $userID,$requireDate, $totalAmt);
    }
    /*public function __construct($custOrderID, $userID, $pickup, $deliveryAdd, $requireDate, $totalAmt, $paymentStatus) {
        $this->custOrderID = $custOrderID;
        $this->userID = $userID;
        $this->pickup = $pickup;
        $this->deliveryAdd = $deliveryAdd;
        $this->requireDate = $requireDate;
        $this->totalAmt = $totalAmt;
        $this->paymentStatus = $paymentStatus;
    }*/
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

    public function setCustOrderID($custOrderID) {
        $this->custOrderID = $custOrderID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setPickup($pickup) {
        $this->pickup = $pickup;
    }

    public function setDeliveryAdd($deliveryAdd) {
        $this->deliveryAdd = $deliveryAdd;
    }

    public function setRequireDate($requireDate) {
        $this->requireDate = $requireDate;
    }

    public function setTotalAmt($totalAmt) {
        $this->totalAmt = $totalAmt;
    }

    public function setPaymentStatus($paymentStatus) {
        $this->paymentStatus = $paymentStatus;
    }



}
