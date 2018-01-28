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
        
        try {
            $message = \Swift_Message::newInstance()
                ->setSubject('Wiadomość z kalkulatorKcal.pl')
                ->setFrom($data['email'], $data['email'])
                ->setTo('kamil.gwozd@gmail.com', 'kamil.gwozd@gmail.com')
                ->setBody($htmlBody, 'text/html');
            $this->swiftMailer->send($message);
            echo 1;
        } catch (\Exception $e) {
            echo 0;
        }
    }
}

