<?php


/**
 * Description of Session_itemSelected
 *
 * @author Daniel
 */
class Session_itemSelected {
    private $userID;
    private $productCode;
    private $Quantity;
    private $UnitPrice;
    private $totalprice;
    
    function __construct($userID, $productCode, $Quantity, $UnitPrice, $totalprice) {
        $this->userID = $userID;
        $this->productCode = $productCode;
        $this->Quantity = $Quantity;
        $this->UnitPrice = $UnitPrice;
        $this->totalprice = $totalprice;
    }
    
    function getUserID() {
        return $this->userID;
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

    function getTotalprice() {
        return $this->totalprice;
    }

    function setUserID($userID) {
        $this->userID = $userID;
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

    function setTotalprice($totalprice) {
        $this->totalprice = $totalprice;
    }

    
        
    //put your code here
}
