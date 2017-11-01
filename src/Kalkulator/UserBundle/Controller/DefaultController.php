<?php

namespace Kalkulator\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Kalkulator\UserBundle\Form\Type\RegisterUserType;
use Common\UserBundle\Entity\User;
use Kalkulator\UserBundle\Entity\UserInfo;

/**
 * @Route("/panel/user")
 */
class DefaultController extends Controller
{
    protected $limit = 10;
    
    /**
     * @Route(
     * "/{page}",
     * name = "kal_user_list",
     * defaults = {"page" = 1},
     * requirements = {"page" = "\d+"}
     * )
     * @Template()
     */
    public function indexAction(Request $request, $page)
    {
        $Repo = $this->getDoctrine()->getRepository('CommonUserBundle:User');
        
        $userTyp = $request->query->get('userTyp');
        if(NULL == $userTyp) {
            $userTyp = -1;
        }
        
        $queryParams = array(
            'orderBy' => 'u.username',
            'userTyp' => $userTyp,
            'search' => $request->query->get('search'),
        );
        $qb = $Repo->getQueryBuilder($queryParams);
        
        $paginator = $this->get('knp_paginator');
        $users = $paginator->paginate($qb, $page, $this->limit);
        
        return array(
            "users" => $users,
            "queryParams" => $queryParams,
        );
    }
    
    /**
     * @Route(
     *      "/aktualizuj/{id}",
     *      name="kal_user_aktualizuj"
     * )
     * @Template
     */
    public function aktualizujAction(Request $Request, $id){
        $Repo = $this->getDoctrine()->getRepository('CommonUserBundle:User');
        $Repo2 = $this->getDoctrine()->getRepository('KalkulatorUserBundle:UserInfo');
        $user = $Repo->find($id);
        $userInfo = $Repo2->findBy(array('id_user' => $id))[0];
        if(NULL == $user){
            throw $this->createNotFoundException('Nie znaleziono takiego użytkownika');
        }
        
        $registerUserForm = $this->createForm(new RegisterUserType()/*, $User*/);
        $registerUserForm->get('email')->setData($user->getEmail());
        $registerUserForm->get('username')->setData($user->getUsername());
        $registerUserForm->get('typ')->setData($user->getTyp());
        if($user->getInfo() !== null){
            $registerUserForm->get("imie")->setData($user->getInfo()->getImie());
            $registerUserForm->get("nazwisko")->setData($user->getInfo()->getNazwisko());
            $registerUserForm->get("imie_drugie")->setData($user->getInfo()->getImieDrugie());
            $registerUserForm->get("pesel")->setData($user->getInfo()->getPesel());
            $registerUserForm->get("nr_dowodu")->setData($user->getInfo()->getNrDowodu());
            $registerUserForm->get("miasto")->setData($user->getInfo()->getMiasto());
            $registerUserForm->get("ulica")->setData($user->getInfo()->getUlica());
            $registerUserForm->get("nr_domu")->setData($user->getInfo()->getNrDomu());
            $registerUserForm->get("nr_lokalu")->setData($user->getInfo()->getNrLokalu());
            
            $registerUserForm->get("telefon")->setData($user->getInfo()->getTelefon());     
            $registerUserForm->get("stanowisko")->setData($user->getInfo()->getStanowisko());     
            $registerUserForm->get("funkcja")->setData($user->getInfo()->getFunkcja());     
            $registerUserForm->get("wyksztalcenie")->setData($user->getInfo()->getWyksztalcenie());     
        }
        
        $registerUserForm->remove('plainPassword');
        
        if($Request->isMethod('POST')){
            $Session = $this->get('session');
            
            $registerUserForm->handleRequest($Request);
            
            if($registerUserForm->isValid()){
                $postData = $Request->request->all()['userRegister'];
                
                $user->setTyp($postData['typ']);
                if($user->getTyp() == 1) {
                    $user->setRoles(array('ROLE_USER'));
                } else {
                    $user->setRoles(array('ROLE_ADMIN'));
                }
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                
                if(null !== $userInfo) {
                    $userInfo->setPesel($postData['pesel']);
                    $userInfo->setImieDrugie($postData['imie_drugie']);
                    $userInfo->setNrDowodu($postData['nr_dowodu']);
                    $userInfo->setMiasto($postData['miasto']);
                    $userInfo->setUlica($postData['ulica']);
                    $userInfo->setNrDomu($postData['nr_domu']);
                    $userInfo->setNrLokalu($postData['nr_lokalu']);
                    
                    $userInfo->setTelefon($postData['telefon']);
                    $userInfo->setStanowisko($postData['stanowisko']);
                    $userInfo->setFunkcja($postData['funkcja']);
                    $userInfo->setWyksztalcenie($postData['wyksztalcenie']);
                    $em->persist($userInfo);
                    $em->flush();
                }
            }
        }
        
        return array(
            'form' => $registerUserForm->createView()
        );
    }
    
    /**
     * @Route(
     * "/dodaj",
     * name = "kal_add_user"
     * )
     * @Template()
     */
    public function dodajAction(Request $Request)
    {
        $User = new User();
        $UserInfo = new UserInfo();
        $registerUserForm = $this->createForm(new RegisterUserType()/*, $User*/);
        $registerUserForm->get('typ')->setData(0);
        
        if($Request->isMethod('POST')){
            $Session = $this->get('session');
            
            $registerUserForm->handleRequest($Request);
            
            if($registerUserForm->isValid()){
                $postData = $Request->request->all()['userRegister'];
                try {
                    $User->setPassword($postData['plainPassword']['first']);
                    $User->setPlainPassword($postData['plainPassword']['second']);
                    $encoderFactory = $this->container->get('security.encoder_factory');
                    $encoder = $encoderFactory->getEncoder($User);
                    $encodedPasswd = $encoder->encodePassword($User->getPlainPassword(), $User->getSalt());
                    $User->setPassword($encodedPasswd);
                    $User->setEnabled(true);
                    $User->setTyp($postData['typ']);
                    
                    if($User->getTyp() == 1) {
                        $User->setRoles(array('ROLE_USER'));
                    } else {
                        $User->setRoles(array('ROLE_ADMIN'));
                    }
                    
                    
                    $User->setEmail($postData['email']);
                    $User->setUsername($postData['username']);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($User);
                    $em->flush();
                    
                    $UserInfo->setIdUser($User);
                    $UserInfo->setImie($postData['imie']);
                    $UserInfo->setNazwisko($postData['nazwisko']);
                    $UserInfo->setPesel($postData['pesel']);
                    
                    $UserInfo->setImieDrugie($postData['imie_drugie']);
                    $UserInfo->setNrDowodu($postData['nr_dowodu']);
                    $UserInfo->setMiasto($postData['miasto']);
                    $UserInfo->setUlica($postData['ulica']);
                    $UserInfo->setNrDomu($postData['nr_domu']);
                    $UserInfo->setNrLokalu($postData['nr_lokalu']);
                    
                    $UserInfo->setTelefon($postData['telefon']);
                    $UserInfo->setStanowisko($postData['stanowisko']);
                    $UserInfo->setFunkcja($postData['funkcja']);
                    $UserInfo->setWyksztalcenie($postData['wyksztalcenie']);
                    
                    $em->persist($UserInfo);
                    $em->flush();
                    
                    $User->setInfo($UserInfo);
                    $em->persist($User);
                    $em->flush();
                    
                    $Session->getFlashBag()->add('success', 'Użytkownik został‚ zapisany');
                } catch (Exception $exc) {
                    $this->get('session')->getFlashBag()->add('danger', $exc->getMessage());
                }
            }
            else {
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza!');
            }
        }
        
        return array(
            'form' => $registerUserForm->createView()
        );
    }
    
    /**
     * @Route(
     *      "/delete/{id}", 
     *      name="kal_delete_user",
     *      requirements={"id"="\d+"}
     * )
     * 
     * @Template()
     */
    public function deleteAction($id) {
        $User = $this->getDoctrine()->getRepository('CommonUserBundle:User')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($User);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Poprawnie usuniÄ™to post wraz ze wszystkimi komentarzami');
        return $this->redirect($this->generateUrl('kal_user_list'));
    }
}
