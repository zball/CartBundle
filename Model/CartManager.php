<?php

namespace ZB\CartBundle\Model;

use AppBundle\Entity\Cart;

class CartManager implements CartManagerInterface{
    
    public function getCart(){
        
        $cart = new Cart();
        return $cart;
        
    }
}