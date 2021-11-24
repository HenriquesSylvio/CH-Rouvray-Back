<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Faker;
use Symfony\Component\Console\Output\OutputInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface  $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager) : void
    {

        $user = new User();
        $user->setEmail("henriques.sylvio@outlook.fr");
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword($user, '54875487'));
        $user->setLastName("Henriques");
        $user->setFirstname("Sylvio");
        $manager->persist($user);


        $faker = Faker\Factory::create('fr_FR');
        for($nbUsers = 1; $nbUsers <= 30; $nbUsers++){
            $user = new User();
            $user->setEmail($faker->email);
            if($nbUsers === 1)
                $user->setRoles(['ROLE_ADMIN']);
            else
                $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordHasher->hashPassword($user, '54875487'));
            $user->setLastName($faker->lastName);
            $user->setFirstname($faker->firstName);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
