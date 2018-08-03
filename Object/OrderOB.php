<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OrderOB{
    private $orderID;
    private $userID;
    private $orderDate;
    private $Pickup;
    private $DeliveryAddress;
    private $RequiredDate;
    private $TotalAmount;
    private $Status;
    
    public function __construct($orderID, $userID, $orderDate, $Pickup, $DeliveryAddress, $RequiredDate, $TotalAmount, $Status){
        $this->orderID = $orderID;
        $this->userID = $userID;
        $this->orderDate = $orderDate;
        $this->Pickup = $Pickup;
        $this->DeliveryAddress = $DeliveryAddress;
        $this->RequiredDate = $RequiredDate;
        $this->TotalAmount = $TotalAmount;
        $this->Status = $Status;
    }
    
    
    function getOrderID() {
        return $this->orderID;
    }

    function getUserID() {
        return $this->userID;
    }

    function getOrderDate() {
        return $this->orderDate;
    }

    function getPickup() {
        return $this->Pickup;
    }

    function getDeliveryAddress() {
        return $this->DeliveryAddress;
    }

    function getRequiredDate() {
        return $this->RequiredDate;
    }

    function getTotalAmount() {
        return $this->TotalAmount;
    }

    function getStatus() {
        return $this->Status;
    }

    function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setOrderDate($orderDate) {
        $this->orderDate = $orderDate;
    }

    function setPickup($Pickup) {
        $this->Pickup = $Pickup;
    }

    function setDeliveryAddress($DeliveryAddress) {
        $this->DeliveryAddress = $DeliveryAddress;
    }

    function setRequiredDate($RequiredDate) {
        $this->RequiredDate = $RequiredDate;
    }

    function setTotalAmount($TotalAmount) {
        $this->TotalAmount = $TotalAmount;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }


    
}