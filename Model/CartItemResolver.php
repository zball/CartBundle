<?php

namespace ZB\CartBundle\Model;

use ZB\CartBundle\Model\ProductInterface;
use ZB\CartBundle\Factory\FactoryInterface;

class CartItemResolver{
    
    private $cartItem;
    
    public function __construct(FactoryInterface $itemFactory){
        $this->cartItem = $itemFactory->buildNew();
    }
    
    public function resolveItem(ProductInterface $product){
        
        $this->cartItem->setProduct($product);
        $this->cartItem->setUnitPrice($product->getUnitPrice());
        $this->cartItem->setQuantity(5);
        
        return $this->cartItem;
        
    }
}