<?php

namespace ZB\CartBundle\Factory;

class Factory implements FactoryInterface{
    
    private $className;
    
    public function __construct($className){
        $this->className = $className;   
    }
    
    public function buildNew(){
        
        if( class_exists( $this->className ) )
            return new $this->className();
        
        throw new \RuntimeException('Class: ' . $this->className . ' could not be found.');
        
    }
}