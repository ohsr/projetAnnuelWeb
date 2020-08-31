<?php

namespace App\Events;

use App\Entity\User;
use App\Service\MailSender;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RegisterSubsriber implements EventSubscriberInterface
{
    private $manager;
    private $security;
    private $encoder;
    private $mailer;
    private $templating;

    public function __construct(EntityManagerInterface $manager, Security $security,UserPasswordEncoderInterface $encoder,\Twig\Environment $templating,ParameterBagInterface $params)
    {
        $this->manager = $manager;
        $this->security = $security;
        $this->encoder = $encoder;
        $this->mailer = new MailSender($templating,$params);
    }

    public static function getSubscribedEvents()
    {
        return[
            KernelEvents::VIEW => ['handleRegistration', EventPriorities::PRE_VALIDATE]
        ];
    }


    public function handleRegistration(ViewEvent $event){
        $data = $event->getControllerResult();
        $request = $event->getRequest();

        if($data instanceof User && $request->getMethod() == "POST"){
            $hash = $this->encoder->encodePassword($data,$data->getPassword());
            $data->setPassword($hash);
            $data->setIsVerified(false);
            

            if(!in_array("ROLE_USER",$data->getRoles()) && !in_array("ROLE_SCHOOL",$data->getRoles())){
                throw new \RuntimeException('Vous ne pouvez ajouter un rendez-vous alors qu\'un autre est encore programmé');
            }
            if(in_array("ROLE_SCHOOL",$data->getRoles())){

                //aboucher.hitema.projet@gmail.com
                $this->mailer->sendMail(array($data->getEmail()),$data);
        
            }
        }
    }
}