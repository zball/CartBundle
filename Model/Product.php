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
     * {@inheritDoc}
     */
    public function getId(){
        return $this->id;
    }
    
    
}