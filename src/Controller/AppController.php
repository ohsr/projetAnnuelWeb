<?php

namespace App\Controller;

use App\Entity\School;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\UserCommentSchool;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app")
     * @param SerializerInterface|null $serializer
     * @return
     */
    public function index(SerializerInterface $serializer)
    {
        return $this->render('app/index.html.twig',[
            'user' => ($this->isGranted("IS_AUTHENTICATED_FULLY") ? $serializer->serialize($this->getUser(),'jsonld') : null)
        ]);
    }

    /**
     * @Route("/api/logout", name="api_logout", methods={"GET"})
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

    /**
     * @Route("/api/profile", name="my_profile", methods={"GET"})
     */
    public function profile(){
        $user = $this->getUser();
        return $this->json([
            "id" => $user->getId(),
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "roles" => $user->getRoles(),
        ]);
    }

}
