<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $passwordEncoder)
    {

    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setLastname('Gatti');
        $admin->setFirstName('Jerome');
        $admin->setAddress('10 rue des roses');
        $admin->setZipCode('75000');
        $admin->setCity('Paris');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $faker = Factory::create('fr_FR');

        for ($usr =1; $usr <= 5; $usr++) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstName($faker->firstName);
            $user->setAddress($faker->streetAddress);
            $user->setZipCode(str_replace(' ', '', $faker->postcode));
            $user->setCity($faker->city);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, 'password')
            );

            $manager->persist($user);
        }

        $manager->flush();
    }
}
