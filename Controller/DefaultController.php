<?php

namespace ZB\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use ZB\CartBundle\Entity\CartItem;
use ZB\CartBundle\Form\Type\CartItemType;

class DefaultController extends Controller
{
    /**
     * @Route("/cart", name="zb_cart_index")
     */
    public function indexAction(){
        
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'cart' => $this->getCart()
        ));
    }
    
    /**
     * @Route("/cart/x", name="zb_cart_x")
     */
    public function xAction(Request $request)
    {
        
        $session = $request->getSession();
        $session->remove('zb_cart');
        
        print_r($session->get('zb_cart'));
        exit;
        
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
        
        $cartItem = $itemResolver->resolveItem($request, $cartManager->getCart());
        
        
        if($cartItem){
            $cartManager->addCartItem($cartItem);
            return $this->redirectToRoute('zb_cart_index');
        }
        
        $this->redirect($request->server->get('HTTP_REFERER'));
    }
    
    /**
     * @Route("/cart/save", name="zb_cart_save")
     */
    public function saveAction(Request $request){
        $cart = $this->getCartManager()->getCart();
        
        $em = $this->getDoctrine()->getManager();
        
        $cart = $em->merge($cart);
        $em->persist($cart);
        $em->flush();
        
        $this->get('zb_cart.cart_manager')->setCart($cart);
        
        return $this->redirectToRoute('zb_cart_index');
    }
    
    public function getCartManager(){
        return $this->get('zb_cart.cart_manager');
    }
    
    public function getCart(){
        return $this->getCartManager()->getCart();
    }
}
