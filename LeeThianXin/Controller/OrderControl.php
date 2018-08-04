<?php

include_once '../DA/OrderDA.php';
/**
 * Description of OrderControl
 *
 * @author Daniel
 */
class OrderControl {
    
    private $orderDA;
    
    function __construct($orderDA) {
        $this->orderDA = $orderDA;
    }

    
    function insertOrder(Order $order){
        if ($this->orderDA == NULL){
           $this->orderDA = new OrderDA();
        }
        return $this->orderDA->insertOrder($order);
        
    }

}
