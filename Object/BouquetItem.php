<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BouquetItem
 *
 * @author Hibiki
 */
class BouquetItem {
    private $custOrderID;
    private $productCode;
    private $quantity;
    private $unitPrice;
    
    public function __construct($custOrderID, $productCode, $quantity, $unitPrice) {
        $this->custOrderID = $custOrderID;
        $this->productCode = $productCode;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
    }
    public function getCustOrderID() {
        return $this->custOrderID;
    }

    public function getProductCode() {
        return $this->productCode;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getUnitPrice() {
        return $this->unitPrice;
    }

    public function setCustOrderID($custOrderID) {
        $this->custOrderID = $custOrderID;
    }

    public function setProductCode($productCode) {
        $this->productCode = $productCode;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setUnitPrice($unitPrice) {
        $this->unitPrice = $unitPrice;
    }


}
