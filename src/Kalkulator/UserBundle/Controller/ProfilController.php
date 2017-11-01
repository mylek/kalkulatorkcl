<?php
namespace Kalkulator\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Kalkulator\UserBundle\Form\Type\AccountSettingsType;
use Kalkulator\UserBundle\Form\Type\ChangePasswordType;

/**
 * @Route("/panel/profil")
 */
class ProfilController extends Controller
{
    /**
     * @Route(
     * "/",
     * name = "kal_user_profil"
     * )
     * @Template()
     */
    public function indexAction(Request $Request)
    {
        $User = $this->getUser();
        
        // Account Settings Form
        $accountSettingsForm = $this->createForm(new AccountSettingsType(), $User);
        if($Request->isMethod('POST') && $Request->request->has('accountSettings')){
            $accountSettingsForm->handleRequest($Request);
            if($accountSettingsForm->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($User);
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('success', 'Twoje dane zostały zmienione!');
                return $this->redirect($this->generateUrl('kal_user_profil'));
            }else{
                $this->get('session')->getFlashBag()->add('error', 'Popraw błędy formularza!');
            }
        }
        
        // Change Password
        $changePasswdForm = $this->createForm(new ChangePasswordType(), $User);
        
        if($Request->isMethod('POST') && $Request->request->has('changePassword')){
            $changePasswdForm->handleRequest($Request);
            
            if($changePasswdForm->isValid()){
                
                try {
                    $userManager = $this->get('user_manager');
                    $userManager->changePassword($User);

                    $this->get('session')->getFlashBag()->add('success', 'Twoje hasło zostało zmienione!');
                    return $this->redirect($this->generateUrl('kal_user_profil'));
                    
                } catch (UserException $ex) {
                    $this->get('session')->getFlashBag()->add('error', $ex->getMessage());
                }
                
            }else{
                $this->get('session')->getFlashBag()->add('error', 'Popraw błędy formularza2!');
            }
        }
        
        return array(
            'accountSettingsForm' => $accountSettingsForm->createView(),
            'changePasswdForm' => $changePasswdForm->createView(),
        );
    }
}