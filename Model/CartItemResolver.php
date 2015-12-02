<?php

namespace ZB\CartBundle\Model;

use ZB\CartBundle\Model\ProductInterface;
use ZB\CartBundle\Factory\FactoryInterface;
use ZB\CartBundle\Form\Type\CartItemType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;
use Doctrine\ORM\EntityRepository;

class CartItemResolver{
    
    private $cartItem;
    private $productRepository;
    private $formFactory;
    
    public function __construct(
        FactoryInterface $itemFactory, 
        EntityRepository $productRepository,
        FormFactory $formFactory
    ){
        $this->cartItem = $itemFactory->buildNew();
        $this->productRepository = $productRepository;
        $this->formFactory = $formFactory;
    }
    
    public function resolveItem(Request $request){
        
        $productId = $request->get('product_id');
        $product = $this->productRepository->find($productId);
        
        if(!$product)
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException("No product by that ID could be located.");
        
        if(!$product instanceof ProductInterface)
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException("No product provided.");
            
        $form = $this->formFactory->create(CartItemType::class, $this->cartItem);
        $form->handleRequest($request);
        
        if($form->isValid()){
            $this->cartItem->setProduct($product);
            $this->cartItem->setUnitPrice($product->getUnitPrice());
            
            return $this->cartItem;
        }
        
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException("Invalid form submission.");
        
        
        
    }
}