<?php

namespace Kalkulator\DashBoardBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\SecurityContext as SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;

class KalkulatorExtension extends \Twig_Extension {

    /**
     * @var Doctrine
     */
    private $doctrine;

    /**
     * @var SecurityContext
     */
    private $context;

    public function __construct(Doctrine $doctrine, SecurityContext $context) {
        $this->doctrine = $doctrine;
        $this->context = $context;
    }

    public function getName() {
        return 'kal_dashboard_extension';
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('rexi_menu', array($this, 'menu'), array('is_safe' => array('html'))),
        );
    }

    public function initRuntime(\Twig_Environment $environment) {
        $this->environment = $environment;
    }

    public function menu() {
        $menu = array(
            'Dashboard' => array(
                'class' => 'fa fa-lg fa-fw fa-home',
                'submenu' => array(
                    'Dashboard' => 'rexi_dashboard',
                )
            ),
            'Uzytkownicy' => array(
                'class' => 'fa fa-user',
                'submenu' => array(
                    'Lista użytkowników' => 'rexi_user_list',
                    'Dodaj użytkownika' => 'rexi_add_user'
                )
            ),
            'Bloki wycen' => array(
                'class' => 'fa fa-sitemap',
                'submenu' => array(
                    'Lista bloków' => 'rexi_bloki_wycen_list',
                    'Dodaj blok' => 'rexi_bloki_wycen_add'
                )
            )
        );

        return $this->environment->render('RexiDashBoardBundle:Template:menu.html.twig', array(
                    'menu' => $menu
        ));
    }
}
