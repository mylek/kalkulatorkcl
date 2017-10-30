<?php

namespace Kalkulator\KalkulatorBundle\Repository;

use Doctrine\ORM\EntityRepository;


class PosilekRepository extends EntityRepository {
    public function getQueryBuilder(array $params = array()){
        $qb = $this->createQueryBuilder('p')
                        ->select('p.id, p.nazwa,
             SUM((c.gram / 100) * d.bialka) AS bialka,
				 SUM((c.gram / 100) * d.kalorii) AS kalorii,
				 SUM((c.gram / 100) * d.wegle) AS wegle,
				 SUM((c.gram / 100) * d.tluszcze) AS tluszcze,
				 SUM((c.gram / 100) * d.cena) AS cena')
                        ->join('p.posilek_produkty', 'c')
                        ->leftJoin('c.produkty', 'd');
        if(!empty($params['user_id'])){
            $qb->where('p.user = :user_id')->setParameter('user_id', $params['user_id']);
                    
            if(!empty($params['orderBy'])){
                $orderDir = !empty($params['orderDir']) ? $params['orderDir'] : NULL;
                $qb->orderBy($params['orderBy'], $orderDir);
            }
        }
        
        $qb->groupBy('p.id, p.nazwa');
        
        return $qb;
    }
}

