<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderDetailsOB
 *
 * @author leang
 */
class OrderDetailsOB {
    private $orderDetailsID;
    private $orderID;
    private $productCode;
    private $Quantity;
    private $UnitPrice;
    
    public function OrderDetailsOB($orderDetailsID, $orderID,$productCode, $Quantity, $UnitPrice){
        $this->orderDetailsID = $orderDetailsID;
        $this->orderID = $orderID;
        $this->productCode = $productCode;
        $this->Quantity = $Quantity;
        $this->UnitPrice = $UnitPrice;
    }
    function getOrderDetailsID() {
        return $this->orderDetailsID;
    }

    function getOrderID() {
        return $this->orderID;
    }

    function getProductCode() {
        return $this->productCode;
    }

    function getQuantity() {
        return $this->Quantity;
    }

    function getUnitPrice() {
        return $this->UnitPrice;
    }

    function setOrderDetailsID($orderDetailsID) {
        $this->orderDetailsID = $orderDetailsID;
    }

    function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    function setProductCode($productCode) {
        $this->productCode = $productCode;
    }

    function setQuantity($Quantity) {
        $this->Quantity = $Quantity;
    }

    function setUnitPrice($UnitPrice) {
        $this->UnitPrice = $UnitPrice;
    }


}
