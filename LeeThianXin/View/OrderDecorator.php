<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderDecorator
 *
 * @author Daniel
 */
class OrderDecorator {
    protected $orderOB;
    protected $orderID;
    protected $userID;
    protected $orderDate;
    protected $Pickup;
    protected $DeliveryAddress;
    protected $RequiredDate;
    protected $TotalAmount;
    protected $Status;


    public function __construct(OrderOB $order_in) {
        $this->orderOB = $order_in;
        $this->modifyOrder();
    }
    
    function modifyOrder(){    
        $this->Pickup = $this->orderOB->getPickup();
        $this->DeliveryAddress = $this->orderOB->getDeliveryAddress();
    }
    
    function showPickUP(){
 
        return $this->Pickup;
    }
    
    function showAddress(){
        return $this->DeliveryAddress;
    }
}
