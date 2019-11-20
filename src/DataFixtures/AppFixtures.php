<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\School;
use App\Entity\User;
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
    }
}
