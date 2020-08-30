<?php

namespace App\Service;

use Mailjet\Resources;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class MailSender{

    private $templating;
    private $mj;
    private $mailSender;
    
    public function __construct($templating,$params){
      $this->templating = $templating;
      $this->mj = new \Mailjet\Client($params->get('MJ_APIKEY_PUBLIC'), $params->get('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
    }

    /**
     * Crée la liste des destinataires pour l'envoi de mail
     *
     * @param [type] $recipients
     * @return void
     */
    protected function buildRecipientList($recipients){
      $recipientsList = array();
      
      foreach($recipients as $recipient){
        array_push($recipientsList,["Email"=>$recipient]);
      }
      return $recipientsList;
    }
    /**
     * Permet de configurer le corps du mail qui va être envoyé
     *
     * @param [type] $recipients
     * @param [type] $data
     * @return void
     */
    protected function configureMailBody($recipients,$data){
      return [
          'Messages' => [
          [
            'From' => [
              'Email' => "mx.france80@protonmail.com",
              'Name' => "Nop"
            ],
            'To' => $this->buildRecipientList($recipients),
            'Subject' => "Mail Test",
            'TextPart' => "Test mail Mailjet",
            'HTMLPart' => $this->templating->render('email.html.twig', array('data'=>$data)),
            'CustomID' => "AppGettingStartedTest"
          ]
        ]
      ];
  }

    /**
     * Envoi du mail via l'api MailJet
     *
     * @param [type] $recipients
     * @param [type] $data
     * @return void
     */
    public function sendMail($recipients,$data){
      $this->mj->post(Resources::$Email, ['body' => $this->configureMailBody($recipients,$data)]);
    }
}
