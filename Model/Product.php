<?php

namespace ZB\CartBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\MappedSuperclass 
 */
abstract class Product implements ProductInterface{
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
     protected $name;
     
     /**
     * @ORM\Column(type="float")
     */ 
     protected $unitPrice;
     
     public function getName(){
         return $this->name;
     }
     
     public function getUnitPrice(){
         return $this->unitPrice;
     }
     
     public function setName($name){
         $this->name = $name;
         
         return $this;
     }
     
     public function setUnitPrice($unitPrice){
         $this->unitPrice = $unitPrice;
         
         return $this;
     }
    
}