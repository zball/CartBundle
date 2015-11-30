<?php

namespace ZB\CartBundle\Model;

use ZB\CartBundle\Model\ProductInterface;
use ZB\CartBundle\Factory\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

class CartItemResolver{
    
    private $cartItem;
    private $productRepository;
    
    public function __construct(FactoryInterface $itemFactory, EntityRepository $productRepository){
        $this->cartItem = $itemFactory->buildNew();
        $this->productRepository = $productRepository;
    }
    
    public function resolveItem(Request $request){
        
        $productId = $request->get('product_id');
        $product = $this->productRepository->find($productId);
        
        if(!$product)
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException("No product by that ID could be located.");
        
        echo '<pre>';
        \Doctrine\Common\Util\Debug::dump($product);exit;
        
        
        
        $this->cartItem->setProduct($product);
        $this->cartItem->setUnitPrice($product->getUnitPrice());
        $this->cartItem->setQuantity(5);
        
        return $this->cartItem;
        
    }
}