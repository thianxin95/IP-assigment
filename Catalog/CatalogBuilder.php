<?php

/**
 * Description of FacadePattern
 *
 * @author Chen Chun Hang
 */

abstract class getProduct{
    abstract function getProduct();
}

class ProductOB {

    private $productCode;
    private $productType;
    private $productDes;
    private $Availability;
    private $price;
    
    function __construct() {
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

class ProductBuilder extends getProduct{
    
    private $product;
    
    function __construct() {
        $this->product = new ProductOB();
    }
    
    function setProductCode($productCode) {
        $this->product->setProductCode($productCode);
    }

    function setProductType($productType) {
        $this->product->setProductType($productType);
    }

    function setProductDes($productDes) {
        $this->product->setProductDes($productDes);
    }

    function setAvailability($Availability) {
        $this->product->setAvailability($Availability);
    }

    function setPrice($price) {
        $this->product->setPrice($price);
    }
    
    public function getProduct() {
        return $this->product;
    }

}