<?php

namespace Kalkulator\KalkulatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Kalkulator\KalkulatorBundle\Form\Type\ProduktType;
use Kalkulator\KalkulatorBundle\Entity\Produkt;

/**
 * @Route("/kalkulator/posilki")
 */
class PosilkiController extends Controller {
    
    protected $limit = 10;
    
    /**
    * @Route(
    *      "/{page}",
    *      name="kal_posilki_lista",
     *     defaults = {"page" = 1},
     *     requirements = {"page" = "\d+"}
    * )
    * @Template
    */
    public function listaAction($page){
        $Repo = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Posilek');
        
        $qb = $Repo->getQueryBuilder(array(
            'user_id' => $this->getUser(),
            'orderBy' => 'p.nazwa'
        ));
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $this->limit);
        
        
        return array(
            'pagination' => $pagination,
            'pageTitle' => 'Lista posilków'
        );
    }
    
    /**
    * @Route(
    *      "/usun/{id}",
    *      name="k_posilki_usun"
    * )
    * @Template
    */
    public function usunAction($id){
        $Repo = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Posilek');
        $posilek = $Repo->find($id);
        
        if(NULL == $posilek){
            throw $this->createNotFoundException('Nie znaleziono takiego posiłku');
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($posilek);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('success', 'Posilke został usunięty');
        return $this->redirect($this->generateUrl('kal_posilki_lista'));
    }
    
    /**
	* @Route(
	*      "/edytuj/{id}",
	*      name="k_posilek_dodaj"
	* )
	* @Template("KalkulatorKalkulatorBundle:Danie:dodaj.html.twig")
	*/
	public function aktualizujAction(Request $Request, $id) {

		$Repo = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Posilek');
        $posilek = $Repo->find($id);
		if(NULL == $posilek) {
			throw $this->createNotFoundException('Nie znaleziono takiego posilku');
		}

		$prodObj = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Produkt');
		$produkty = $prodObj->findBy(array('usun' => 0), array('nazwa' => 'DESC'));
		$Session = $this->get('session');

		if ($Request->isMethod('POST')) {
			$postData = $Request->request->all();
			$produkty_posilek = array();
			if (!empty($postData) && !empty($postData['produkt'])) {
				$em = $this->getDoctrine()->getManager();
				//$dzienObj = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Dzien');
			    //$dzienObj = $dzienObj->find($id);				

                // zapis kopie dnia
                $dzienObj = new \Kalkulator\KalkulatorBundle\Entity\Dzien();
                $dzienObj->setUser($this->getUser());
                $dzienObj->setData(new \DateTime($postData['data'] . ' ' . $postData['time']));
                
				$em->persist($dzienObj);
			    $em->flush();

				// zapisz produktów odnowa
				foreach ($postData['produkt'] as $key => $id_produktu)
				{
				    if (!empty($id_produktu) && $postData['gram'][$key] > 0) {
					$produkty_posilek[] = array(
					    'produkt_id' => $id_produktu,
					    'gram' => $postData['gram'][$key],
					);
					$produktObj = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Produkt');
					$produktObj = $produktObj->find($id_produktu);
					if(!$produktObj)
					    continue;
					
					$danie = new \Kalkulator\KalkulatorBundle\Entity\Danie();
					$danie->setGram($postData['gram'][$key]);
					$danie->setProdukty($produktObj);
					$danie->setDzienId($dzienObj);
					$em->persist($danie);
					$em->flush();
				    }
				}

				$this->get('session')->getFlashBag()->add('success', 'Danie zostało zaktualizowane');
				return $this->redirect($this->generateUrl('kal_dzien_dodaj'));
			}
		}

		 return array(
            'produkty' => $produkty,
			'dzien' => date('Y-m-d'),
			'czas' => date('H').':00',
			'dania' => $posilek->getPosilekProdukty(),
            'akcja' => 'posilek'
        	);
	}
}