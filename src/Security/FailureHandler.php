<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class FailureHandler implements AuthenticationFailureHandlerInterface
{
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        //$user = $exception->getToken()->getUser();
        switch ($exception->getMessage()){
            case("Bad credentials."):
                $message = "Adresse Email ou mot de passe incorrect";
                $status = 403;
                break;
            default:
                $message = "Une erreur est survenue durant l'authentication";
                $status = 400;
                break;
        }
        return new JsonResponse($message, $status);

    }
}