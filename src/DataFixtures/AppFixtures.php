<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\School;
use App\Entity\User;
use App\Entity\UserCommentSchool;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    protected $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function staticCategory($name,$coefficient,$info,$manager){
        $category = new Category();
        $category->setName($name);
        $category->setCoefficient($coefficient);
        $category->setInfo($info);
        $manager->persist($category);
        return $category;
    }
    public function calculMoy($school, $manager){
        $comments = $manager->getRepository(UserCommentSchool::class)->findBy(["schools"=>$school]);
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
    public function getRandom($entity,$manager){
        $data = $manager->getRepository($entity)->findAll();
        shuffle($data);
        return $data[0];
    }
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new Faker\Provider\fr_FR\Address($faker));
        $faker->addProvider(new Faker\Provider\en_US\Payment($faker));

        $this->staticCategory("Enseignement",3,"Qualité de l'enseignement (Pédagogie, Compétences, Capacité à transmettre leurs connaissances),", $manager);
        $this->staticCategory("Batiment(s)",2,"Qualité des infrastructures liée au lieu d'enseignement (Classes,Amphithéâtre,Couloirs,Lieux Sociaux,Cantines etc...), ", $manager);
        $this->staticCategory("Matériel",2,"Qualité du matériel mis à disposition par l'établissement (Informatique,Mobiliers,Distributeurs)", $manager);
        $this->staticCategory("Situation",2,"Qualité de la situtation géographique de l'établissement (Centre Ville, Proche des transports en communs, Restauration à proximité etc...)", $manager);
        $this->staticCategory("Ambiance", 1,"Ambiance au sein de l'établissement (Bonne entente,bienveillance,solidarité,évenements sociaux,fêtes)",$manager);
        $this->staticCategory("Coûts",2,"Coûts de l'établissement (uniquement pour les écoles privées hors contract)",$manager);

        for($i=0;$i<=20;$i++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword($this->encoder->encodePassword($user,"Password"));
            $user->setRoles(["ROLE_USER"]);
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $manager->persist($user);
        }
        $manager->flush();

        for($j=0; $j<=20; $j++){
            $school = new School();
            $school->setUai($faker->bankRoutingNumber);
            $school->setType("Université");
            $school->setName("Université ".$faker->name);
            $school->setStatus('Ecole Publique');

            $school->setAcademy($faker->city);
            $school->setAdress($faker->address);
            $school->setPostalCode($faker->postcode);
            $school->setDepartment($faker->departmentName);
            $randPicture = rand(1,4);
            switch ($randPicture){
                case (1):
                    $school->setPicture('first.jpg');
                    break;
                case (2):
                    $school->setPicture('second.jpg');
                    break;
                case (3):
                    $school->setPicture('third.jpg');
                    break;
                case (4):
                    $school->setPicture('fourth.jpg');
                    break;
            }
            $manager->persist($school);
        }
        $manager->flush();

        $schools = $manager->getRepository(School::class)->findAll();
        $categorys = $manager->getRepository(Category::class)->findAll();
        foreach ($schools as $school){
            foreach ($categorys as $category){
                $rand = rand(1,5);
                for($h=0;$h<=$rand; $h++){
                    $userCommentSchool = new UserCommentSchool();
                    $userFound = $this->getRandom(User::class,$manager);
                    $userCommentSchool->setUsers($userFound);
                    $userCommentSchool->setCategorys($category);
                    $userCommentSchool->setSchools($school);
                    $userCommentSchool->setComment($faker->realText(200));
                    $userCommentSchool->setNote($faker->numberBetween(0,5));
                    $userCommentSchool->setCreatedAt(new \DateTime("now"));
                    $school = $userCommentSchool->getSchools();
                    $school->setGlobalNote(round($this->calculMoy($userCommentSchool->getSchools()->getId(),$manager),2));
                    $manager->persist($userCommentSchool);
                    $manager->flush();

                }
            }
        }

    }
}
