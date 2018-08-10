<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SalesOrderOB
 *
 * @author Daniel
 */
class SalesOrderOB {
    private $id;
    private $productCode;
    private $quantity;
    private $totalAmount;     
    
    function __construct($id, $productCode, $quantity, $totalAmount) {
        $this->id = $id;
        $this->productCode = $productCode;
        $this->quantity = $quantity;
        $this->totalAmount = $totalAmount;
    }
    function getId() {
        return $this->id;
    }

    function getProductCode() {
        return $this->productCode;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getTotalAmount() {
        return $this->totalAmount;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setProductCode($productCode) {
        $this->productCode = $productCode;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setTotalAmount($totalAmount) {
        $this->totalAmount = $totalAmount;
    }



}
