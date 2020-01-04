<?php

namespace App\Listeners;


use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class AuthenticationSuccessListener{
    private $secure = false;
    private $tokenTtl;
    public function __construct($tokenTtl)
    {
        $this->tokenTtl = $tokenTtl;
    }

    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event){
        $response = $event->getResponse();
        $data = $event->getData();
        $token = $data["token"];
        $response->headers->setCookie(
            new Cookie(
                "BEARER",
                $token,
                (new \DateTime())
                    ->add(new \DateInterval("PT" . $this->tokenTtl . "S"))
                ,"/",null,$this->secure,true,false,Cookie::SAMESITE_STRICT
            )
        );
    }

}
