<?php

namespace Kalkulator\KalkulatorBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

use Air\BlogBundle\Entity\Dzien;

class KalkulatorExtension extends \Twig_Extension{

	/**
	* @var Doctrine
	*/
	private $doctrine;

 	public function __construct(Doctrine $doctrine)
        {
            $this->doctrine = $doctrine;
        }
    public function getName() {
        return 'kalkulator_kalkulator_extension';
    }
    
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('kakulator_menu', array($this, 'menu'), array('is_safe' => array('html'))),
	    new \Twig_SimpleFunction('kalkulator_suma_dzien', array($this, 'suma_dzien'), array('is_safe' => array('html'))),
        );
    }
    
    public function initRuntime(\Twig_Environment $environment) {
        $this->environment = $environment;
    }
    
    public function menu() {
        $menu = array(
            'Dodaj posiłek' => array(
                'class' => 'fa fa-plus-square',
                'submenu' =>   array(
                        'Dodaj posiłek' => 'kal_danie_dodaj'
                    )
            ),
	   'Dni' => array(
                'class' => 'fa fa-calendar',
                'submenu' =>   array(
                        'Dni' => 'kal_dzien_dodaj'
                    )
            ),
            'Produkty' => array(
                'class' => 'fa fa-th-large',
                'submenu' =>   array(
                        'Lista produktów' => 'kal_produkty_lista',
                        'Dodaj produkt' => 'kal_produkty_dodaj',
                    )
            ),
            'Posilki' => array(
                'class' => 'fa fa-cutlery',
                'submenu' =>   array(
                        'Lista pposilków' => 'kal_posilki_lista',
                    )
            ),
        );
        
        return $this->environment->render('KalkulatorKalkulatorBundle:Template:menu.html.twig', array(
            'menu' => $menu
        ));
    }

	public function suma_dzien() {
		$request = Request::createFromGlobals();
		$data = $request->cookies->get('dzien');
		$dni = 7;
		if(empty($data))
			$data = 'NOW';

		$data_wybrana = new \DateTime($data);
		$data_start = new \DateTime($data);
		$data_stop = new \DateTime($data);
		$data_start->sub(new \DateInterval('P'.$dni.'D'));
		$data_stop->add(new \DateInterval('P'.$dni.'D'));
		
		$dni = array();
		while ($data_start->format('U') <= $data_stop->format('U')) {
		   $dni[$data_start->format('Y-m-d')] = $data_start->format('Y-m-d');
		   $data_start->add(new \DateInterval('P1D'));
		}

		// pobiera sume z wybranego dnia
		$DzienRepository = $this->doctrine->getRepository('KalkulatorKalkulatorBundle:Danie');
		$suma = $DzienRepository->getSumaDzien($data_wybrana);

		
        
        	return $this->environment->render('KalkulatorKalkulatorBundle:Template:suma_dzien.html.twig', array(
            		'dni' => $dni,
			'data_wybrany' => $data_wybrana->format('Y-m-d'),
			'suma' => $suma
        	));
    }
}

