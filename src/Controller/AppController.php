<?php

namespace App\Controller;

use App\Entity\School;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\UserCommentSchool;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app")
     */
    public function index(SerializerInterface $serializer)
    {
        return $this->render('app/index.html.twig',[
            'user' => $serializer->serialize($this->getUser(),'jsonld')
        ]);
    }

    /**
     * @Route("/api/logout", name="api_logout")
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        if($request->headers->get('Cookie')){
            $res = new Response();
            $res->headers->clearCookie('BEARER');
            $res->send();
        }
        return $this->redirectToRoute("app");

    }

}
