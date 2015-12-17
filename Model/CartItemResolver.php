<?php

namespace ZB\CartBundle\Model;

use ZB\CartBundle\Model\ProductInterface;
use ZB\CartBundle\Factory\FactoryInterface;
use ZB\CartBundle\Model\CartInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;
use Doctrine\ORM\EntityRepository;

class CartItemResolver{
    
    private $cartItem;
    private $productRepository;
    private $formFactory;
    private $cartItemType;
    
    public function __construct(
        FactoryInterface $itemFactory, 
        EntityRepository $productRepository,
        FormFactory $formFactory,
        AbstractType $cartItemType
    ){
        $this->cartItem = $itemFactory->buildNew();
        $this->productRepository = $productRepository;
        $this->formFactory = $formFactory;
        $this->cartItemType = $cartItemType;
    }
    
    public function resolveItem(Request $request, CartInterface $cart){
        
        $productId = $request->get('product_id');
        $product = $this->productRepository->find($productId);
        
        if(!$product)
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException("No product by that ID could be located.");
        
        if(!$product instanceof ProductInterface)
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException("No product provided.");
            
        $form = $this->formFactory->create(get_class($this->cartItemType), $this->cartItem);
        $form->handleRequest($request);
        
        if($form->isValid()){
            $this->cartItem->setProduct($product);
            $this->cartItem->setUnitPrice($product->getUnitPrice());
            $this->cartItem->setCart($cart);
            
            return $this->cartItem;
        }
        
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException("Invalid form submission.");
        
        
        
    }
}