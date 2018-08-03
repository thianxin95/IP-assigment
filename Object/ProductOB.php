<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductOb
 *
 * @author leang
 */
class ProductOB {
    //put your code here
    private $productCode;
    private $productType;
    private $productDes;
    private $Availability;
    private $price;
    
    function __construct($productCode, $productType, $productDes, $Availability, $price) {
        $this->productCode = $productCode;
        $this->productType = $productType;
        $this->productDes = $productDes;
        $this->Availability = $Availability;
        $this->price = $price;
    }

    
    function getProductCode() {
        return $this->productCode;
    }

    function getProductType() {
        return $this->productType;
    }

    function getProductDes() {
        return $this->productDes;
    }

    function getAvailability() {
        return $this->Availability;
    }

    function getPrice() {
        return $this->price;
    }

    function setProductCode($productCode) {
        $this->productCode = $productCode;
    }

    function setProductType($productType) {
        $this->productType = $productType;
    }

    function setProductDes($productDes) {
        $this->productDes = $productDes;
    }

    function setAvailability($Availability) {
        $this->Availability = $Availability;
    }

    function setPrice($price) {
        $this->price = $price;
    }


}
