<?php

namespace App\DataFixtures;

use App\Entity\Employe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class EmployeFixtures extends Fixture
{

    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for($i=0;$i<101;$i++){

            $employe = new Employe();
            $employe->setNom($faker->lastName);
            $employe->setPrenom($faker->firstName);
            $employe->setUsername($faker->userName);
            $employe->setPassword($this->hasher->hashPassword($employe,"Bonjour"));
            $manager->persist($employe);
        }

        $admin = new Employe();
        $admin->setNom('admin');
        $admin->setPrenom('admin');
        $admin->setUsername('admin');
        $admin->setPassword($this->hasher->hashPassword($admin,"admin"));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager->flush();
    }
}
