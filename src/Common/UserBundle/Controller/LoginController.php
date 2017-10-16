<?php

namespace Common\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /**
     * @Route(
     *      "/login",
     *      name = "kal_login"
     * )
     * @Template()
     */
    public function loginAction(Request $Request)
    {
        $Session = $this->get('session');
        
        // Login Form
        if($Request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)){
            $loginError = $Request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        }else{
            $loginError = $Session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        }
        
        if(isset($loginError)){
            $this->get('session')->getFlashBag()->add('error', $loginError->getMessage());
        }
        
        $userName = $Session->get(SecurityContextInterface::LAST_USERNAME);
        
        return array(
            'loginError' => $loginError,
            'userName' => $userName
        );
    }
}
