<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Common\UserBundle\Entity\User;
use Common\UserBundle\Form\Type\RegisterUserType;

class DefaultController extends Controller
{
    /**
     * @Route(
     *      "/",
     *      name="front_home",
     * )
     * @Template
     */
    public function indexAction(Request $Request)
    {
		// Register User Form
        $User = new User();
        $registerUserForm = $this->createForm(new RegisterUserType(), $User);
		
		$messages = [];
		
		if($Request->isMethod('POST')){
            $registerUserForm->handleRequest($Request);
            
            if($registerUserForm->isValid()){
                try{
                    
                    $userManager = $this->get('user_manager');
                    $userManager->registerUser($User);
                    
                    $this->get('session')->getFlashBag()->add('success', 'Konto zostało utworzone. Na Twoją skrzynkę pocztową została wysłana wiadomość aktywacyjna.');
                    
                    return $this->redirect('app_dev.php');
                    
                } catch (UserException $ex) {
					dump($ex);die;
                    $this->get('session')->getFlashBag()->add('error', $ex->getMessage());
                }
                
            } else {
				foreach($registerUserForm->getErrors() as $row) {
					$messages['danger'][] = $row->getMessage();
				}
			}
        }
		
		return [
			'register_form' => $registerUserForm->createView(),
			'messages' => $messages,
		];
    }
}
