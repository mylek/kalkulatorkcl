<?php

namespace Kalkulator\KalkulatorBundle\Repository;

use Doctrine\ORM\EntityRepository;


class DzienRepository extends EntityRepository {
    public function getDzien(\DateTime $data){
	$od = $data->format('Y-m-d 00:00:00');
	$do = $data->format('Y-m-d 23:59:59');
        $qb = $this->createQueryBuilder('p')
                        ->select('p.data, c.id, c.gram, c, d.nazwa,
			 (d.bialka * 100) / c.gram AS bialka,
			 (d.kalorii * 100) / c.gram AS kalorii,
			 (d.wegle * 100) / c.gram AS wegle,
			 (d.tluszcze * 100) / c.gram AS tluszcze,
			 (d.cena * 100) / c.gram AS cena')
                        ->join('p.dania', 'c')
			->leftJoin('c.produkty', 'd');
	$qb->where('p.data >= :od AND p.data <= :do')
                        ->setParameter('od', $od)
			->setParameter('do', $do);
	return $qb->getQuery()->getArrayResult();
    }
}

