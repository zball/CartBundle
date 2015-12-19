<?php

namespace ZB\CartBundle\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;
use ZB\CartBundle\Event\CartEvent;
use ZB\CartBundle\Model\SessionManager;

class EventSubscriber implements EventSubscriberInterface
{
    private $entityManager;
    private $sessionManager;
    
    public function __construct(EntityManager $em, SessionManager $sm){
        $this->entityManager = $em;
        $this->sessionManager = $sm;
    }
    
    public static function getSubscribedEvents(){
        
        return array(
            'zb_cart.created' => ['onCartCreate', 0],
            'zb_cart.set' => ['onCartSet', 0],
            'zb_cart.item_updated' => [ 'onItemAdd', 0 ],
            'zb_cart.item_added' => [ 'onCartUpdate', 0 ],
            'zb_cart.item_removed' => [ 'onItemRemoved', 0 ],
            );
    }

    public function onCartCreate(CartEvent $event){
        $cart = $event->getCart();
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
        
        $this->sessionManager->setSessionCart($cart);
        
    }
    
    public function onCartSet(CartEvent $event){
        // $session = new Session();
        // $session->set('zb_cart', $event->getCart());
    }
    
   public function onCartUpdate(CartEvent $event){
        
        $cart = $event->getCart();
        $cart->setCartSubTotal();
        
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
    }
    
    public function onItemRemoved(CartEvent $event){
        $this->onCartUpdate($event);
    }
    
    public function onItemAdd(CartEvent $event){
        $this->onCartUpdate($event);
    }
}