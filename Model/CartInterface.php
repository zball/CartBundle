<?php

namespace ZB\CartBundle\Model;

interface CartInterface{
    
     /**
     * Returns the cart unique id.
     *
     * @return mixed
     */
    public function getId();
    
    public function getCreatedAt();
    
}