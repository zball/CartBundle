<?php

namespace ZB\CartBundle\Entity;

use ZB\CartBundle\Model\Product as BaseProduct;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ZB\CartBundle\Repository\ProductRepository")
 * @ORM\Table(name="zb_cart_product")
 */
class Product extends BaseProduct{
    
}