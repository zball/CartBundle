<?php

namespace ZB\CartBundle\Model;

use AppBundle\Entity\Cart;
use ZB\CartBundle\Repository\CartRepository;
use ZB\CartBundle\Event\CartEvent;
use ZB\CartBundle\CartEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CartManager implements CartManagerInterface{
    
    private $cartRepository;
    private $eventDispatcher;
    
    public function __construct(
        CartRepository $cartRepository, 
        EventDispatcherInterface $eventDispatcher
    ){
        $this->cartRepository = $cartRepository;
        $this->eventDispatcher = $eventDispatcher;
    }
    
    public function createNew(){
        $cart = $this->cartRepository->createNew();
        
        $event = new CartEvent($cart);
        $this->eventDispatcher->dispatch(CartEvents::CART_CREATED, $event);
        
        return $cart;
    }
    
    public function getCart(){
        
    }
}