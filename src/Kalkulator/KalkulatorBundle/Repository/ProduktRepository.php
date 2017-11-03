<?php

namespace Kalkulator\KalkulatorBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ProduktRepository extends EntityRepository {
    public function getQueryBuilder(array $params = array()){
        $qb = $this->createQueryBuilder('p')
                        ->select('p');
        
        if(!empty($params['users'])){
            $qb->andWhere('p.user = :user_id')->setParameter('user_id', $params['users']);
        }
        
        if(!empty($params['status'])){
            if('aktywne' == $params['status']){
                $qb->andWhere('p.usun = :usun')->setParameter('usun', 0);
            }
            
            if(!empty($params['orderBy'])){
                $orderDir = !empty($params['orderDir']) ? $params['orderDir'] : NULL;
                $qb->orderBy($params['orderBy'], $orderDir);
            }
        }
        
        return $qb;
    }
    
    public function getProductUser(\Common\UserBundle\Entity\User $User)
    {
        $qb = $this->createQueryBuilder('p')->select('p');
        $qb->andWhere('p.user = :user_id OR p.user IS NULL')->setParameter('user_id', $User);
        //$qb->andWhere('p.user = :null')->setParameter('null', 'N;');
        $qb->andWhere('p.usun = :usun')->setParameter('usun', 0);
        return $qb->getQuery()->getResult();
    }
}

