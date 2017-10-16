<?php

namespace Kalkulator\KalkulatorBundle\Repository;

use Doctrine\ORM\EntityRepository;


class DanieRepository extends EntityRepository {

    	public function getSumaDzien(\DateTime $data){
		$od = $data->format('Y-m-d 00:00:00');
		$do = $data->format('Y-m-d 23:59:59');
		$qb = $this->createQueryBuilder('d')
		                ->select('
				 SUM((d.gram / 100) * p.bialka) AS bialka,
				 SUM((d.gram / 100) * p.kalorii) AS kalorii,
				 SUM((d.gram / 100) * p.wegle) AS wegle,
				 SUM((d.gram / 100) * p.tluszcze) AS tluszcze,
				 SUM((d.gram / 100) * p.cena) AS cena')
		                ->join('d.dzien_id', 'da')
				->leftJoin('d.produkty', 'p');
		$qb->where('da.data >= :od AND da.data <= :do')
		                ->setParameter('od', $od)
				->setParameter('do', $do);
		$res = $qb->getQuery()->getSingleResult();
		return $res;
	}
    
    public function getDzien(\DateTime $data){
	$od = $data->format('Y-m-d 00:00:00');
	$do = $data->format('Y-m-d 23:59:59');
        $qb = $this->createQueryBuilder('d')
                        ->select('da.data, da.id as dzien_id, d.gram, p.nazwa,
			 (d.gram / 100) * p.bialka  AS bialka,
			 (d.gram / 100) * p.kalorii AS kalorii,
			 (d.gram / 100) * p.wegle AS wegle,
			 (d.gram / 100) * p.tluszcze AS tluszcze,
			 (d.gram / 100) * p.cena AS cena')
                        ->join('d.dzien_id', 'da')
			->leftJoin('d.produkty', 'p');
	$qb->where('da.data >= :od AND da.data <= :do')
                        ->setParameter('od', $od)
			->setParameter('do', $do)
			->orderBy("da.data", 'DESC');
	$res = $qb->getQuery()->getArrayResult();

	$wynik = array();
	if(!empty($res)) {
		foreach($res as $row) {
			$wynik[$row['dzien_id']]['czas'] = $row['data'];
			if(!isset($wynik[$row['dzien_id']]['suma'])) {
				$wynik[$row['dzien_id']]['suma'] = array(
					'bialka' => 0,
					'kalorii' => 0,
					'wegle' => 0,
					'tluszcze' => 0,
					'cena' => 0,
					'gram' => 0,
				);	
			}
			$wynik[$row['dzien_id']]['suma']['bialka'] += $row['bialka'];
			$wynik[$row['dzien_id']]['suma']['kalorii'] += $row['kalorii'];
			$wynik[$row['dzien_id']]['suma']['wegle'] += $row['wegle'];
			$wynik[$row['dzien_id']]['suma']['tluszcze'] += $row['tluszcze'];
			$wynik[$row['dzien_id']]['suma']['cena'] += $row['cena'];
			$wynik[$row['dzien_id']]['suma']['gram'] += $row['gram'];
			$wynik[$row['dzien_id']]['produkty'][] = array(
				'gram' => $row['gram'],
				'bialka' => $row['bialka'],
				'kalorii' => $row['kalorii'],
				'wegle' => $row['wegle'],
				'tluszcze' => $row['tluszcze'],
				'cena' => $row['cena'],
				'nazwa' => $row['nazwa'],
			);
		}	
	}
	uasort($wynik, function($a, $b){
		return $a["czas"] > $b["czas"];
	});
	
	return $wynik;
    }
}

