<?php

namespace ZB\CartBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\MappedSuperclass 
 */
abstract class CartItem implements CartItemInterface{
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="integer")
     */ 
     protected $quantity = 1;
     
     /**
     * @ORM\Column(type="float")
     */ 
     protected $unitPrice;
    
    /**
     * {@inheritDoc}
     */
    public function getId(){
        return $this->id;
    }
    
    public function getQuantity(){
        return $this->quantity;
    }
    
    public function getUnitPrice(){
        return $this->unitPrice;
    }
    
    public function setQuantity($quantity){
        $this->quantity = $quantity;
        
        return $this;
    }
    
    public function setUnitPrice($unitPrice){
        $this->unitPrice = $unitPrice;
        
        return $this;
    }
    
    
}