<?php

namespace ZB\CartBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\Column(type="float")
     */ 
     protected $cartSubTotal;
    
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
    
    /**
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart", cascade={"persist", "merge"}, fetch="EAGER")
     */
    protected $cartItems;
    
    
    public function __construct(){
        $this->cartItems = new ArrayCollection();
        $this->createdAt = new \DateTime('now');
        $this->setExpiresAt();
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
    
    public function addCartItem(CartItem $cartItem){
        $this->cartItems[] = $cartItem;
        return $this;
    }
    
    public function removeCartItem(CartItem $cartItem){
        $this->cartItems->removeElement($cartItem);
    }
    
    public function setExpiresAt(){
        $this->expiresAt = new \DateTime();
        $this->expiresAt->modify("+30 days");
    }
    
    public function getCartSubTotal(){
        return $this->cartSubTotal;
    }
    
    public function setCartSubTotal(){
        $this->cartSubTotal = 0;
        $cartItems = $this->getCartItems();
        
        foreach($cartItems as $cartItem){
            $this->cartSubTotal += ($cartItem->getUnitPrice() * $cartItem->getQuantity());
        }
    }
    
    public function setCartItems(array $cartItems){
        $this->cartItems = $cartItems;
        
        return $this;
    }
    
}