<?php

class DailyRecordOB {

    private $OrderPaid;
    private $OrderCanceled;
    private $Date;
    private $AmountPaid;
    private $DeliveryCount;
    private $PickupCount;

    function __construct() {
        
    }

    function getOrderCanceled() {
        return $this->OrderCanceled;
    }

    function setOrderCanceled($OrderCanceled) {
        $this->OrderCanceled = $OrderCanceled;
    }

    function getOrderPaid() {
        return $this->OrderPaid;
    }

    function getDate() {
        return $this->Date;
    }

    function getAmountPaid() {
        return $this->AmountPaid;
    }

    function getDeliveryCount() {
        return $this->DeliveryCount;
    }

    function getPickupCount() {
        return $this->PickupCount;
    }

    function setOrderPaid($OrderPaid) {
        $this->OrderPaid = $OrderPaid;
    }

    function setDate($Date) {
        $this->Date = $Date;
    }

    function setAmountPaid($AmountPaid) {
        $this->AmountPaid = $AmountPaid;
    }

    function setDeliveryCount($DeliveryCount) {
        $this->DeliveryCount = $DeliveryCount;
    }

    function setPickupCount($PickupCount) {
        $this->PickupCount = $PickupCount;
    }

}
