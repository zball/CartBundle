<?php

namespace ZB\CartBundle\Model;

use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;
use ZB\CartBundle\Model\CartInterface;

class SessionManager{
    
    private $session;
    private $entityManager;
    
    public function __construct(Session $session, EntityManager $em){
        $this->session = $session;
        $this->entityManager = $em;
    }
    
    public function setSessionCart(CartInterface $cart){
        $this->session->set('zb_cart', $cart->getId());
    }
    
    public function hasCartInSession(){
        if( $this->session->has('zb_cart') ){
            $cart = $this->session->get('zb_cart');
            return $cart;
        }
        return false;
    }
    
    public function getSession(){
        return $this->session;
    }
    
    public function getEntityManager(){
        return $this->entityManager;
    }
}