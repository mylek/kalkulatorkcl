<?php

namespace Kalkulator\DashBoardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/panel")
 */
class DefaultController extends Controller
{
    /**
     * @Route(
     * "/",
     * name="kal_dashboard",
     * )
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
