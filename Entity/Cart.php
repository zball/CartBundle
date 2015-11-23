<?php

namespace ZB\CartBundle\Entity;

use ZB\CartBundle\Model\Cart as BaseCart;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ZB\CartBundle\Repository\CartRepository")
 * @ORM\Table(name="zb_cart")
 */
class Cart extends BaseCart{
    
}