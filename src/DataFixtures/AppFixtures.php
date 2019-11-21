<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\School;
use App\Entity\User;
use App\Entity\UserCommentSchool;
use App\Entity\UserNoteSchool;
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

    public function staticCategory($name,$manager){
        $category = new Category();
        $category->setName($name);
        $manager->persist($category);
        return $category;
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

        $this->staticCategory("Enseignement", $manager);
        $this->staticCategory("Batiment(s)", $manager);
        $this->staticCategory("Matériel", $manager);
        $this->staticCategory("Situation", $manager);
        $this->staticCategory("Ambiance", $manager);
        $this->staticCategory("Coûts", $manager);

        for($i=0;$i<=10;$i++){
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
            $manager->persist($school);
        }
        $manager->flush();

        for($h=0; $h<=5; $h++){
            $userNoteSchool = new UserNoteSchool();
            $userCommentSchool = new UserCommentSchool();
            $userFound = $this->getRandom(User::class,$manager);
            $schoolFound = $this->getRandom(School::class,$manager);
            $categoryFound = $this->getRandom(Category::class,$manager);

            $userNoteSchool->setUsers($userFound);
            $userNoteSchool->setSchools($schoolFound);
            $userNoteSchool->setCategorys($categoryFound);
            $userNoteSchool->setNote($faker->numberBetween(0,5));
            $manager->persist($userNoteSchool);
            $userCommentSchool->setUsers($userFound);
            $userCommentSchool->setSchools($schoolFound);
            $userCommentSchool->setCategorys($categoryFound);
            $userCommentSchool->setComment($faker->realText(200));

            $userNoteSchool->setCreatedAt(new \DateTime("now"));
            $manager->persist($userCommentSchool);
        }
        $manager->flush();
    }
}
