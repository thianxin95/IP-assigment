<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DelivertDecorator
 *
 * @author Daniel
 */
class DelivertDecorator extends OrderDecorator{
    private $orderDec;
    public function __construct(OrderDecorator $orderDec_in) {
        $this->orderDec = $orderDec_in;
    }
    function Delivery(){

         $this->orderDec->DeliveryAddress = '</br>NOTE:</br>Your receive method is use our delivery service.</br>Address is '.$this->orderDec->DeliveryAddress;
                         
    }
}
