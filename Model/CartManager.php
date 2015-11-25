<?php

namespace ZB\CartBundle\Model;

use ZB\CartBundle\Repository\CartRepository;
use ZB\CartBundle\Event\CartEvent;
use ZB\CartBundle\CartEvents;
use ZB\CartBundle\Factory\FactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CartManager implements CartManagerInterface{
    
    private $cartRepository;
    private $eventDispatcher;
    private $cartFactory;
    
    public function __construct(
        CartRepository $cartRepository, 
        EventDispatcherInterface $eventDispatcher,
        FactoryInterface $cartFactory
    ){
        $this->cartRepository = $cartRepository;
        $this->eventDispatcher = $eventDispatcher;
        $this->cartFactory = $cartFactory;
    }
    
    public function createNew(){
        $cart = $this->cartFactory->buildNew();
        
        $event = new CartEvent($cart);
        $this->eventDispatcher->dispatch(CartEvents::CART_CREATED, $event);
        
        return $cart;
    }
    
    public function getCart(){
        
    }
}