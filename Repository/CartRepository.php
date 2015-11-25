<?php

namespace ZB\CartBundle\Repository;

use Doctrine\ORM\EntityRepository;


class CartRepository extends EntityRepository{
    
    public function createNew(){
        $className = $this->getClassName();
        $cart = new $className();
        
        return $cart; 
    }
}