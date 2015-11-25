<?php

namespace ZB\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/cart", name="zb_cart_index")
     */
    public function indexAction()
    {
        $cart = $this->getCart();
        
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'cart' => $cart
        ));
    }
    
    public function getCart(){
        return $this->get('zb_cart.cart_manager')->getCart();
    }
}
