<?php

namespace ZB\CartBundle\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use ZB\CartBundle\Event\CartEvent;

class EventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(){
        
        return array(
            'zb_cart.created' => array('onCartCreate', 0),
            'zb_cart.set' => array('onCartSet', 0),
            );
    }

    public function onCartCreate(CartEvent $event){
        // $session = new Session();
        // $session->set('zb_cart', $event->getCart());
    }
    
    public function onCartSet(CartEvent $event){
        // $session = new Session();
        // $session->set('zb_cart', $event->getCart());
    }
}