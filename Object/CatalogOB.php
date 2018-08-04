<?php
/**
 * Description of CatalogOB
 *
 * @author Daniel
 */
class CatalogOB {
    private $productCode;
    private $producttype;
    private $productquantity;
    private $totalprice;
    private $userID;
    private $userType;
    
    public function CatalogOB($productCode, $producttype, $productquantity, $totalprice, $userID, $userType) {
        $this->productCode = $productCode;
        $this->producttype = $producttype;
        $this->productquantity = $productquantity;
        $this->totalprice = $totalprice;
        $this->userID = $userID;
        $this->userType = $userType;
    }
    
    function getProductCode() {
        return $this->productCode;
    }

    function getProducttype() {
        return $this->producttype;
    }

    function getProductquantity() {
        return $this->productquantity;
    }

    function getTotalprice() {
        return $this->totalprice;
    }

    function getUserID() {
        return $this->userID;
    }

    function getUserType() {
        return $this->userType;
    }

    function setProductCode($productCode) {
        $this->productCode = $productCode;
    }

    function setProducttype($producttype) {
        $this->producttype = $producttype;
    }

    function setProductquantity($productquantity) {
        $this->productquantity = $productquantity;
    }

    function setTotalprice($totalprice) {
        $this->totalprice = $totalprice;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setUserType($userType) {
        $this->userType = $userType;
    }




}
