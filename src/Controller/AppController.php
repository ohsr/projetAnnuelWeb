<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\School;
use App\Entity\Category;
use App\Entity\UserCommentSchool;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
            "isVerified" => $user->getIsVerified()
        ]);
    }

    /**
     * @Route("/api/users/verify/{id}", name="api_verify", methods={"POST"})
     * @param Request $request
     * @return mixed
     */
    public function verify(Request $request, User $user, EntityManagerInterface $manager,Security $security)
    {

       
            if($user->getIsVerified()){
                $user->setIsVerified(false);
            }else{
                $user->setIsVerified(true);
            }
            $manager->persist($user);
            $manager->flush();
            return $this->json([
                "id" => $user->getId(),
                "firstName" => $user->getFirstName(),
                "lastName" => $user->getLastName(),
                "roles" => $user->getRoles(),
                "isVerified" => $user->getIsVerified(),
            ]);
    }

}
