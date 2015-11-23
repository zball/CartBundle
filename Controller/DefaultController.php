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
        echo 'yo'; exit;
        return array('name' => $name);
    }
}
