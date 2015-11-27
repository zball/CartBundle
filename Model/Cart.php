<?php

namespace ZB\CartBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\MappedSuperclass 
 */
abstract class Cart implements CartInterface{
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \DateTime
     * 
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    
    /**
     * @var \DateTime
     * 
     * @ORM\Column(type="datetime")
     */
    protected $expiresAt;
    
    protected $cartItems = [];
    
    public function __construct(){
        $this->createdAt = new \DateTime('now');
    }
    
    /**
     * {@inheritDoc}
     */
    public function getId(){
        return $this->id;
    }
    
    public function getCreatedAt(){
        return $this->createdAt;
    }
    
    public function getCartItems(){
        return $this->cartItems;
    }
    
    public function setCartItems(array $cartItems){
        $this->cartItems = $cartItems;
        
        return $this;
    }
    
}