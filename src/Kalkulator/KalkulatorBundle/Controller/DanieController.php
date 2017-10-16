<?php

namespace Kalkulator\KalkulatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

class DanieController extends Controller {

    /**
     * @Route(
     *      "/",
     *      name="kal_danie_dodaj",
     * )
     * @Template
     */
    public function dodajAction(Request $Request) {
        $prodObj = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Produkt');
        $produkty = $prodObj->findBy(array('usun' => 0), array('nazwa' => 'DESC'));
        $Session = $this->get('session');

        if ($Request->isMethod('POST')) {

            $postData = $Request->request->all();
            $produkty_posilek = array();
            if (!empty($postData)) {
		// zapis dnia
		$em = $this->getDoctrine()->getManager();
		$dzien = new \Kalkulator\KalkulatorBundle\Entity\Dzien();
		$dzien->setUser($this->getUser());
		$dataObj = new \DateTime($postData['data'] . ' ' . $postData['time']);
		$dzien->setData(new \DateTime($postData['data'] . ' ' . $postData['time']));
		$em->persist($dzien);
                $em->flush();

		// zapisz cookies dnia
		$response = new Response();
		$response->headers->setCookie(new Cookie('dzien', $dataObj->format('Y-m-d'), 0, '/'));
		$response->headers->setCookie(new Cookie('czas', $dataObj->format('H:i'), 0, '/'));
		$response->send();

		if($dzien->getId() > 0) {
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
				$danie->setDzienId($dzien);
			        $em->persist($danie);
			        $em->flush();
			    }
			}
		}
                $Session->getFlashBag()->add('success', 'Posiłek został zapisany');
                $Session->set('registered', true);
            }
        }
        
	// wczytuje date z cookie
	$request = Request::createFromGlobals();
	$data = $request->cookies->get('dzien');
	$czas = $request->cookies->get('czas');

	if(empty($data))
		$data = 'NOW';
	$data = new \DateTime($data);
	$dzien = $data->format('Y-m-d');
	

        return array(
            'produkty' => $produkty,
		'dzien' => $dzien,
		'czas' => $czas
        );
    }

	/**
	* @Route(
	*      "/danie/edytuj/{id}--{akcja}",
	*      name="kal_danie_edytuj"
	* )
	* @Template("KalkulatorKalkulatorBundle:Danie:dodaj.html.twig")
	*/
	public function aktualizujAction(Request $Request, $id, $akcja) {

		$Repo = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Dzien');
        	$dzien = $Repo->find($id);
		
		if(NULL == $dzien) {
			throw $this->createNotFoundException('Nie znaleziono takiego dnia');
		}

		$data = $dzien->getData();
		

		$prodObj = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Produkt');
		$produkty = $prodObj->findBy(array('usun' => 0), array('nazwa' => 'DESC'));
		$Session = $this->get('session');

		if ($Request->isMethod('POST')) {
			$postData = $Request->request->all();
			$produkty_posilek = array();
			if (!empty($postData) && !empty($postData['produkt'])) {
				$em = $this->getDoctrine()->getManager();
				$dzienObj = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Dzien');
			        $dzienObj = $dzienObj->find($id);				

				if($akcja == 'kopiuj') {
					// zapis kopie dnia
					$dzienObj = new \Kalkulator\KalkulatorBundle\Entity\Dzien();
					$dzienObj->setUser($this->getUser());
					$dzienObj->setData(new \DateTime($postData['data'] . ' ' . $postData['time']));
				} else{
					// Edycja
					$dzienObj->setData(new \DateTime($postData['data'] . ' ' . $postData['time']));
					// usuwa aktualne produkty
					foreach ($dzienObj->getDania() as $danie) {
					    $em->remove($danie);
					}
				}
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
			'dzien' => $data->format('Y-m-d'),
			'czas' => $data->format('H:i'),
			'dania' => $dzien->getDania()
        	);
	}


    /**
    * @Route(
    *      "danie/usun/{id}",
    *      name="kal_danie_usun"
    * )
    * @Template
    */
    public function usunAction($id){
        $Repo = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Dzien');
        $dzien = $Repo->find($id);
        
        if(NULL == $dzien){
            throw $this->createNotFoundException('Nie znaleziono takiego dania');
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($dzien);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('success', 'Poprawnie usunięto danie');
        return $this->redirect($this->generateUrl('kal_dzien_dodaj'));
    }
    /**
     * @Route(
     *      "/ajax_pobierz_produkt",
     *      name="kal_danie_ajax_pobierz_produkt",
     * )
     * @Template
     */
    public function ajaxPobierzProduktAction(Request $request) {
        $id = $request->request->get('id');
        $Repo = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Produkt');
        $produkt = $Repo->find($id);

        $produkt_res = array();
        if ($produkt) {
            $produkt_res = array(
                'kalorii' => $produkt->getKalorii(),
                'porcja' => $produkt->getPorcja(),
                'bialka' => $produkt->getBialka(),
                'wegle' => $produkt->getWegle(),
                'tluszcze' => $produkt->getTluszcze(),
            );
        }

        $response = new Response(json_encode($produkt_res));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
