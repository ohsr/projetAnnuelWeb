<?php

namespace App\Controller;


use ApiPlatform\Core\Api\IriConverterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController{

    /**
     * @Route("/login", name="app_login", methods={"POST"})
     * @param IriConverterInterface $iriConverter
     * @return JsonResponse
     */
    public function login(IriConverterInterface $iriConverter){
        if(!$this->isGranted("IS_AUTHENTICATED_FULLY")){
            return $this->json("Invalid login request check", 400);
        }

        return new JsonResponse(null,204,[
            'Location' => $iriConverter->getIriFromItem($this->getUser())
        ]);
    }
}