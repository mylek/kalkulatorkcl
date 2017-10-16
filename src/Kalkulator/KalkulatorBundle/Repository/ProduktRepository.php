<?php

namespace Kalkulator\KalkulatorBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ProduktRepository extends EntityRepository {
    public function getQueryBuilder(array $params = array()){
        $qb = $this->createQueryBuilder('p')
                        ->select('p');
        
        if(!empty($params['status'])){
            if('aktywne' == $params['status']){
                $qb->where('p.usun = :usun')->setParameter('usun', 0);
            }
            
            if(!empty($params['orderBy'])){
                $orderDir = !empty($params['orderDir']) ? $params['orderDir'] : NULL;
                $qb->orderBy($params['orderBy'], $orderDir);
            }
        }
        return $qb;
    }
}

