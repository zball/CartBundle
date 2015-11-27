<?php

namespace ZB\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use ZB\CartBundle\Entity\CartItem;

class DefaultController extends Controller
{
    /**
     * @Route("/cart", name="zb_cart_index")
     */
    public function indexAction()
    {
        $cartManager = $this->getCartManager();
        $itemResolver = $this->get('zb_cart.item_resolver');
        
        $product = $this->getDoctrine()
            ->getRepository('ZBCartBundle:Product')
            ->find(1);
            
            // echo '<pre>';
            // \Doctrine\Common\Util\Debug::dump($product); exit;
            
        $cartItem = $itemResolver->resolveItem($product);
            
        $cartManager->addCartItem($cartItem);
        
        $cart = $cartManager->getCart();
        
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'cart' => $cart
        ));
    }
    
    public function getCartManager(){
        return $this->get('zb_cart.cart_manager');
    }
}
