<?php

namespace Common\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;

use Common\UserBundle\Form\Type\RememberPasswordType;
use Common\UserBundle\Exception\UserException;

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
	
	/**
     * @Route(
     *      "/przypomnij_haslo",
     *      name = "user_remember"
     * )
     * @Template()
     */
    public function rememberAction(Request $Request){
        $rememberPasswordForm = $this->createForm(new RememberPasswordType());
        $info = null;
        if($Request->isMethod('POST')) {
            $rememberPasswordForm->handleRequest($Request);
            if($rememberPasswordForm->isValid()){
                
                try {
                    $userEmail = $rememberPasswordForm->get('email')->getData();

                    $userManager = $this->get('user_manager');
                    $userManager->sendResetPasswordLink($userEmail);

                    $this->get('session')->getFlashBag()->add('success', 'Instrukcje resetowania hasła zostały wysłane na adres e-mail.');
                    return $this->redirect($this->generateUrl('user_remember'));
                
                } catch (UserException $exc) {
					
                    $this->get('session')->getFlashBag()->add('danger', $exc->getMessage());
                }
            }
        }
        return array(
            'form' => $rememberPasswordForm->createView(),
        );
    }
    
    /**
     * @Route(
     *      "/reset-password/{actionToken}",
     *      name = "user_resetPassword"
     * )
     */
    public function resetPasswordAction($actionToken)
    {
        try {
            
            $userManager = $this->get('user_manager');
            $userManager->resetPassword($actionToken);
            
            $this->get('session')->getFlashBag()->add('success', 'Na Twój adres e-mail zostało wysłane nowe hasło!');
            
        } catch (UserException $ex) {
            $this->get('session')->getFlashBag()->add('danger', $ex->getMessage());
        }
        
        return $this->redirect($this->generateUrl('user_remember'));
    }
}
