<?php

namespace App\Events;

use App\Entity\UserCommentSchool;
use App\Entity\Category;
use App\Entity\School;
use ApiPlatform\Core\EventListener\EventPriorities;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class GlobalNoteSubscriber implements EventSubscriberInterface{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public static function getSubscribedEvents()
    {
        return[
            KernelEvents::VIEW => ['globalNote', EventPriorities::POST_WRITE]
        ];
    }

    private function calculMoy($school){
        $comments = $this->manager->getRepository(UserCommentSchool::class)->findBy(["schools"=>$school]);
        $rating = 0;
        $count = 0;
        foreach ($comments as $comment){
            if($comment->getCategorys()){
                $rating += ( $comment->getCategorys()->getCoefficient() * $comment->getNote());
                $count += $comment->getCategorys()->getCoefficient();
            }

        }
        if($count == 0)$count = 1;
        $result = $rating / $count;
        return $result;
    }

    public function globalNote(ViewEvent $event){
        $data = $event->getControllerResult();
        $request = $event->getRequest();
        if($data instanceof UserCommentSchool && ($request->getMethod() == "POST" ||$request->getMethod() == "PUT") ){
            //$data->getSchools()->setGlobalNote($this->calculMoy($data->getSchools()->getId()));
            //$this->calculMoy($data->getSchools()->getId())
            $school = $data->getSchools();
            $school->setGlobalNote($this->calculMoy($data->getSchools()->getId()));
            $this->manager->persist($school);
            $this->manager->flush();
        }
    }

}