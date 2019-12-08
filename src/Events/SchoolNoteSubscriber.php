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
use Symfony\Component\Security\Core\Security;

class SchoolNoteSubscriber implements EventSubscriberInterface
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
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
        if($data instanceof UserCommentSchool && ($request->getMethod() == "POST" ||$request->getMethod() == "PUT") ){
            $data->setCreatedAt(new \DateTime('now'));
        }

    }
}