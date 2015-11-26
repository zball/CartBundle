<?php

namespace ZB\CartBundle\Entity;

use ZB\CartBundle\Model\CartItem as BaseItem;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="zb_cart_item")
 */
class Item extends BaseItem{
    
}