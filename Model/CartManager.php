<?php

namespace ZB\CartBundle\Model;

use ZB\CartBundle\Repository\CartRepository;
use ZB\CartBundle\Event\CartEvent;
use ZB\CartBundle\CartEvents;
use ZB\CartBundle\Factory\FactoryInterface;
use ZB\CartBundle\Model\CartItemInterface;
use ZB\CartBundle\Model\ProductInterface;
use ZB\CartBundle\Model\CartInterface;
use ZB\CartBundle\Model\SessionManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


class CartManager implements CartManagerInterface{
    
    private $cartRepository;
    private $eventDispatcher;
    private $cartFactory;
    private $sessionManager;
    
    public function __construct(
        CartRepository $cartRepository, 
        EventDispatcherInterface $eventDispatcher,
        FactoryInterface $cartFactory,
        SessionManager $sessionManager
    ){
        $this->cartRepository = $cartRepository;
        $this->eventDispatcher = $eventDispatcher;
        $this->cartFactory = $cartFactory;
        $this->sessionManager = $sessionManager;
    }
    
    public function createNew(){
        
        $cart = $this->cartFactory->buildNew();
        
        $event = new CartEvent($cart);
        $this->eventDispatcher->dispatch(CartEvents::CART_CREATED, $event);
        
        $this->setCart($cart);
        
        return $cart;
    }
    
    public function getCart(){
        if($cartId = $this->sessionManager->hasCartInSession()){
            $cart = $this->cartRepository->find($cartId);
        }else{
            $cart = $this->createNew();
        }
        
        return $cart;
    }
    
    public function setCart(CartInterface $cart){
        
        $this->sessionManager->setSessionCart($cart);
        
        $event = new CartEvent($cart);
        $this->eventDispatcher->dispatch(CartEvents::CART_SET, $event);
    }
    
    public function addCartItem(CartItemInterface $item){
        
        $cart = $this->getCart();
        
        if($cartItem = $this->productAlreadyInCart($item->getProduct())){
            
            $cartItem->setQuantity($item->getQuantity());
            
            
            $event = new CartEvent($cart);
            $this->eventDispatcher->dispatch(CartEvents::ITEM_UPDATED, $event);
        }else{
            
            
            $cart->addCartItem($item);
            
            $event = new CartEvent($cart);
            $this->eventDispatcher->dispatch(CartEvents::ITEM_ADDED, $event);
        }
    }
    
    public function removeCartItem(CartItemInterface $item){
        $cart = $this->getCart();
        $cart->removeCartItem($item);
        
        $event = new CartEvent($cart);
        $this->eventDispatcher->dispatch(CartEvents::ITEM_REMOVED, $event);
    }
    
    public function productAlreadyInCart(ProductInterface $product){
        foreach($this->getCart()->getCartItems() as $item){
            if($item->getProduct() == $product){
                return $item;
            }
        }
        return false;
    }
    
    public function removeCart(){
        $this->session->clear('zb_cart');
    }
    
    public function emptyCart(){
        $cart = $this->getCart();
        $entityManager = $this->sessionManager->getEntityManager();
        
        $cartItems = $cart->getCartItems();
        foreach($cartItems as $item){
            $cart->removeCartItem($item);
            $entityManager->remove($item);
        }
        
        $event = new CartEvent($cart);
        $this->eventDispatcher->dispatch(CartEvents::ITEM_UPDATED, $event);
    }
}