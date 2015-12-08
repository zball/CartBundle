<?php

namespace ZB\CartBundle\Model;

use Symfony\Component\HttpFoundation\Session\Session;
use ZB\CartBundle\Model\CartInterface;

class SessionManager{
    
    private $session;
    
    public function __construct(Session $session){
        $this->session = $session;
    }
    
    public function setSessionCart(CartInterface $cart){
        $this->session->set('zb_cart', $cart);
    }
    
    public function getCartInSession(){
        if( $this->session->has('zb_cart') ){
            return $this->session->get('zb_cart');
        }
        return false;
    }
    
    public function getSession(){
        return $this->session;
    }
}