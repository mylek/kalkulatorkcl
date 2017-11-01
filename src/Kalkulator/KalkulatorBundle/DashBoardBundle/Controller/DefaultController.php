<?php

namespace Kalkulator\KalkulatorBundle\DashBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KalkulatorKalkulatorBundleDashBoardBundle:Default:index.html.twig', array('name' => $name));
    }
}
