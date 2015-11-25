<?php

namespace ZB\CartBundle\Entity;

use ZB\CartBundle\Model\Product as BaseProduct;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="zb_product")
 */
class Product extends BaseProduct{
    
}