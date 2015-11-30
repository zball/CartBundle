<?php

namespace ZB\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use ZB\CartBundle\Entity\CartItem;

class DefaultController extends Controller
{
    /**
     * @Route("/cart", name="zb_cart_index")
     */
    public function indexAction()
    {
        $cartManager = $this->getCartManager();
        $cart = $cartManager->getCart();
        
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'cart' => $cart
        ));
    }
    
    /**
     * @Route("/cart/empty", name="zb_cart_empty")
     */
    public function emptyAction(Request $request)
    {
        
        $cartManager = $this->getCartManager();
        $cartManager->emptyCart();
        
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'cart' => $cartManager->getCart()
        ));
    }
    
    /**
     * @Route("/cart/add/{product_id}", name="zb_cart_add")
     */
    public function addAction(Request $request, $product_id){
        
        $cartManager = $this->getCartManager();
        $itemResolver = $this->get('zb_cart.item_resolver');
        
        $cartItem = $itemResolver->resolveItem($request);
        
        $product = $this->getDoctrine()
            ->getRepository('ZBCartBundle:Product')
            ->find($product_id);
            
        echo '<Pre>';
        echo $request->get('product_id');
        exit;
        //\Doctrine\Common\Util\Debug::dump($request);exit;
            
        
        
        // // echo '<Pre>';
        // // \Doctrine\Common\Util\Debug::dump($cartItem);exit;
        
        $cartManager->addCartItem($cartItem);
    }
    
    public function getCartManager(){
        return $this->get('zb_cart.cart_manager');
    }
}
