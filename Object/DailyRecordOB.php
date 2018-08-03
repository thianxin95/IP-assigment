<?php

class DailyRecordOB{
    private $OrderCount;
    private $Date;
    private $TotalAmount;
    private $DeliveryCount;
    private $PickupCount;
    
    public function __construct(){
        
    }
    
    function getOrderCount() {
        return $this->OrderCount;
    }

    function getDate() {
        return $this->Date;
    }

    function getTotalAmount() {
        return $this->TotalAmount;
    }

    function getDeliveryCount() {
        return $this->DeliveryCount;
    }

    function getPickupCount() {
        return $this->PickupCount;
    }

    function setOrderCount($OrderCount) {
        $this->OrderCount = $OrderCount;
    }

    function setDate($Date) {
        $this->Date = $Date;
    }

    function setTotalAmount($TotalAmount) {
        $this->TotalAmount = $TotalAmount;
    }

    function setDeliveryCount($DeliveryCount) {
        $this->DeliveryCount = $DeliveryCount;
    }

    function setPickupCount($PickupCount) {
        $this->PickupCount = $PickupCount;
    }


}
