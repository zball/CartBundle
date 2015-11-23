<?php

namespace ZB\CartBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CartRepository extends EntityRepository{
    
    public function createNew(){
        $className = $this->getClassName();
        echo $className; exit;
        return new $className(); 
    }
}