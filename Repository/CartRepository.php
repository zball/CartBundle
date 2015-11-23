<?php

namespace ZB\CartBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcher;
use ZB\CartBundle\CartEvents;
use ZB\CartBundle\Event\CartEvent;

class CartRepository extends EntityRepository{
    
    public function createNew(){
        $className = $this->getClassName();
        $cart = new $className();
        
        $event = new CartEvent($cart);
        $dispatcher = new EventDispatcher();
        $dispatcher->dispatch(CartEvents::CART_CREATED, $event);
        
        return new $className(); 
    }
}