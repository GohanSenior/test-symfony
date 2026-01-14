<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    private $cptCat = 1;

    public function load(ObjectManager $manager): void
    {
        // Créer un nouvel objet Category
        $category = new Category();
        // Nourrir l'objet Category
        $category->setName('Informatique');
        // Persister les données
        $manager->persist($category);

        $this->addReference('cat-'.$this->cptCat, $category);
        $this->cptCat++;

        $category = new Category();
        $category->setName('Ordinateur');
        $manager->persist($category);
        $this->addReference('cat-'.$this->cptCat, $category);
        $this->cptCat++;

        // Pusher le tout dans la BDD
        $manager->flush();
    }
}
