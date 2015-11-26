<?php

namespace ZB\CartBundle\Model;

interface CartItemInterface{
    
     /**
     * Returns the product unique id.
     *
     * @return mixed
     */
    public function getId();
    
    public function getQuantity();
    
    public function getUnitPrice();
    
}