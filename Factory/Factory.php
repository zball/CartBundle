<?php

namespace ZB\CartBundle\Factory;

class Factory implements FactoryInterface{
    
    private $className;
    
    public function __construct($className){
        $this->className = $className;   
    }
    
    public function buildNew(){
        return new $this->className();
    }
}