<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');

        for ($prd =1; $prd <= 10; $prd++) {
            $product = new Product();
            $product->setName($faker->text(15));
            $product->setDescription($faker->sentence(10));
            $product->setPrice($faker->numberBetween(900, 150000));
            $product->setStock($faker->numberBetween(0, 10));
            $product->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-6 months', 'now')));

            // on va cherhcher une référence de catégorie parmi celles créées dans CategoryFixtures
            $randCat = $faker->numberBetween(1, 2);
            $category = $this->getReference('cat-'.$randCat, Category::class);
            $product->setCategory($category);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
