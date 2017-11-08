<?php

namespace Kalkulator\KalkulatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Kalkulator\KalkulatorBundle\Form\Type\ProduktType;
use Kalkulator\KalkulatorBundle\Entity\Produkt;

/**
 * @Route("/kalkulator/produkty")
 */
class ProduktyController extends Controller {
    
    protected $limit = 10;
    
    protected $breadcrumbs = null;
    
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->breadcrumbs = $this->get("white_october_breadcrumbs");
        $this->breadcrumbs->addItem("Widok dnia", $this->get("router")->generate("kal_dzien_dodaj"));
        $this->breadcrumbs->addItem("Lista produktów", $this->get("router")->generate("kal_produkty_lista"));
    }
    
    /**
    * @Route(
    *      "/{page}",
    *      name="kal_produkty_lista",
     *     defaults = {"page" = 1},
     *     requirements = {"page" = "\d+"}
    * )
    * @Template
    */
    public function listaAction($page){
        $Repo = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Produkt');
        
        $qb = $Repo->getQueryBuilder(array(
            'status' => 'aktywne',
            'orderBy' => 'p.nazwa',
            'users' => $this->getUser(),
            'admin' => $this->getUser()->isAdmin(),
        ));
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $this->limit);
        
        
        return array(
            'pagination' => $pagination,
            'pageTitle' => 'Lista produktów'
        );
    }
    
    /**
    * @Route(
    *      "/usun/{id}",
    *      name="kal_produkty_usun"
    * )
    * @Template
    */
    public function usunAction($id){
        $Repo = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Produkt');
        $produkt = $Repo->find($id);
        
        if(NULL == $produkt){
            throw $this->createNotFoundException('Nie znaleziono takiego produktu');
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($produkt);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('success', 'Poprawnie usunięto rekord z bazy danych!');
        return $this->redirect($this->generateUrl('kal_produkty_lista'));
    }
    
    /**
     * @Route(
     *      "/aktualizuj/{id}",
     *      name="kal_produkty_aktualizuj"
     * )
     * @Template
     */
    public function aktualizujAction(Request $Request, $id){
        $Repo = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Produkt');
        $produkt = $Repo->find($id);
        
        if(NULL == $produkt){
            throw $this->createNotFoundException('Nie znaleziono takiego produktu');
        }
        
        $form = $this->createForm(new ProduktType(), $produkt);
        
        if($Request->isMethod('POST')){
            $Session = $this->get('session');
            $form->handleRequest($Request);
            
            if($form->isValid()){
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($produkt);
                $em->flush();
                
                $Session->getFlashBag()->add('success', 'Zaktualizowano rekord.');
                
                return $this->redirect($this->generateUrl('kal_produkty_lista'));
            }else{
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza!');
            }
        }
        
        return array(
            'register' => $produkt,
            'form' => $form->createView(),
            'pageTitle' => sprintf('Edycja produktu %s', $produkt->getNazwa()),
        );
    }
    
    
    /**
     * @Route(
     *      "/dodaj",
     *      name="kal_produkty_dodaj"
     * )
     * @Template
     */
    public function dodajAction(Request $Request){
        $produkt = new Produkt();
        $form = $this->createForm(new ProduktType(), $produkt);
        $Session = $this->get('session');
        
        if($Request->isMethod('POST')){

            $form->handleRequest($Request);

            if($form->isValid()) {
                // Jeśli admin to ustawia 0
                $produkt->setUser(($this->getUser()->isAdmin()) ? NULL : $this->getUser());
                $produkt->save();
                $em = $this->getDoctrine()->getManager();
                $em->persist($produkt);
                $em->flush();

                $Session->getFlashBag()->add('success', 'Zaktualizowano rekord.');
                $Session->set('registered', true);
                
                return $this->redirect($this->generateUrl('kal_produkty_lista'));
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza!');
            }
        }

        return array(
            'form' => $form->createView(),
            'pageTitle' => 'Dodaj nowy produkt'
        );
    }
}
