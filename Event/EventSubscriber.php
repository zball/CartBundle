<?php

namespace ZB\CartBundle\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use ZB\CartBundle\Event\CartEvent;

class EventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return array(
            'zb_cart.created' => array('onCartCreate', 0),
            );
    }

    public function onCartCreate(CartEvent $event)
    {
        $session = new Session();
        $session->set('zb_cart', $event->getCart());
    }
}