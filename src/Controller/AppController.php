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

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app")
     */
    public function index()
    {
        return $this->render('app/index.html.twig');
    }

    /**
     * @Route("/logout", name="api_logout")
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
