<?php
/**
 * Description of Order
 *
 * @author Daniel
 */
class Order {
    
    private $orderID;
    private $userID;
    private $orderDate;
    private $pickup;
    private $deliveryAddress;
    private $requiredDate;
    private $totalAmount;
    private $status;
    
    public function Order($orderID, $userID, $orderDate, $pickup, $deliveryAddress, $requiredDate, $totalAmount, $status) {
        $this->orderID = $orderID;
        $this->userID = $userID;
        $this->orderDate = $orderDate;
        $this->pickup = $pickup;
        $this->deliveryAddress = $deliveryAddress;
        $this->requiredDate = $requiredDate;
        $this->totalAmount = $totalAmount;
        $this->status = $status;
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
        return $this->pickup;
    }

    function getDeliveryAddress() {
        return $this->deliveryAddress;
    }

    function getRequiredDate() {
        return $this->requiredDate;
    }

    function getTotalAmount() {
        return $this->totalAmount;
    }

    function getStatus() {
        return $this->status;
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

    function setPickup($pickup) {
        $this->pickup = $pickup;
    }

    function setDeliveryAddress($deliveryAddress) {
        $this->deliveryAddress = $deliveryAddress;
    }

    function setRequiredDate($requiredDate) {
        $this->requiredDate = $requiredDate;
    }

    function setTotalAmount($totalAmount) {
        $this->totalAmount = $totalAmount;
    }

    function setStatus($status) {
        $this->status = $status;
    }



    
}
