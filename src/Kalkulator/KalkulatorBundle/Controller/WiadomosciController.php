<?php

namespace Kalkulator\KalkulatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class WiadomosciController extends Controller {
    public function wyslijAjaxAction(Request $request)
    {
        $data = $_GET;
        $htmlBody = '';
        
        if(!empty($data)){
            foreach($data as $key => $row){
                $htmlBody .= "<b>{$key}: </b> {$row}<br />";
            }
        }
        
        $response = new JsonResponse();
        $response->setData($wynik);
        
        
        try {
            $message = \Swift_Message::newInstance()
                ->setSubject('Wiadomość z kalkulatorKcal.pl')
                ->setFrom($data['email'], $data['email'])
                ->setTo('kamil.gwozd@gmail.com', 'kamil.gwozd@gmail.com')
                ->setBody($htmlBody, 'text/html');
            $this->get('mailer')->send($message);
            $response->setData(1);
        } catch (\Exception $e) {
            $response->setData(0);
        }
        
        return $response;
    }
}

