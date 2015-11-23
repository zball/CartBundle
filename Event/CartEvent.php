<?php

namespace ZB\CartBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use ZB\CartBundle\Model\Cart;

class CartEvent extends Event
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function getCart()
    {
        return $this->cart;
    }
}