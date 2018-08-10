<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerOrderDecorator
 *
 * @author Daniel
 */
class PickupOrderDecorator extends OrderDecorator{
    private $orderDec;
    public function __construct(OrderDecorator $orderDec_in) {
        $this->orderDec = $orderDec_in;
    }
    function itemPickUp(){

//         $this->orderDec->Pickup = '</br>NOTE:</br>Your receive method is Pick up on store.'.$this->orderDec->Pickup;
        $this->orderDec->Pickup = '</br>NOTE:</br>Your receive method is Pick up on store.';
                         
    }
}
