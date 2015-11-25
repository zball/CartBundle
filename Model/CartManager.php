<?php

namespace ZB\CartBundle\Model;

use ZB\CartBundle\Repository\CartRepository;
use ZB\CartBundle\Event\CartEvent;
use ZB\CartBundle\CartEvents;
use ZB\CartBundle\Factory\FactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class CartManager implements CartManagerInterface{
    
    private $cartRepository;
    private $eventDispatcher;
    private $cartFactory;
    
    public function __construct(
        CartRepository $cartRepository, 
        EventDispatcherInterface $eventDispatcher,
        FactoryInterface $cartFactory,
        Session $session
    ){
        $this->cartRepository = $cartRepository;
        $this->eventDispatcher = $eventDispatcher;
        $this->cartFactory = $cartFactory;
        $this->session = $session;
    }
    
    public function createNew(){
        
        $cart = $this->cartFactory->buildNew();
        
        $event = new CartEvent($cart);
        $this->eventDispatcher->dispatch(CartEvents::CART_CREATED, $event);
        
        return $cart;
    }
    
    public function getCart(){
        
        if( $this->session->has('zb_cart') ){
            return $this->session->get('zb_cart');
        }
        
        return $this->createNew();
    }
    
    public function removeCart(){
        $this->session->clear('zb_cart');
    }
}