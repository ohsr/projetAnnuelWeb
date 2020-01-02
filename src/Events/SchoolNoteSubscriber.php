<?php
namespace App\Events;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\UserCommentSchool;
use App\Entity\Category;
use App\Entity\School;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class SchoolNoteSubscriber implements EventSubscriberInterface
{
    private $manager;
    private $security;
    public function __construct(EntityManagerInterface $manager, Security $security)
    {
        $this->manager = $manager;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return[
            KernelEvents::VIEW => ['setNoteSchool', EventPriorities::PRE_VALIDATE]
        ];
    }


    public function setNoteSchool(ViewEvent $event){
        $data = $event->getControllerResult();
        $request = $event->getRequest();

        if($data instanceof UserCommentSchool && $this->security->isGranted("IS_AUTHENTICATED_FULLY")){
            switch ($request->getMethod() ){
                case ("POST"):
                    $data->setUsers($this->security->getUser());
                    $data->setCreatedAt(new \DateTime());
                    break;
                case ("DELETE"):
                case ("PUT"):
                    if($this->security->getUser() != $data->getUsers() && !$this->security->isGranted("ROLE_ADMIN")){
                        throw new AccessDeniedException();
                    }
                    break;
                default:
                    //throw new AccessDeniedException();
            }
        }
    }
}