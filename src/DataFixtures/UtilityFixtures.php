<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Faker\Factory;

use App\Entity\Category;

class UtilityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = [
            [
                'name' => 'Adaptation cinéma' 
            ],
            [
                'name' => 'Bande-dessinée'
            ],
            [
                'name' => 'Cinéma'
            ],
            [
                'name' => "Enseignements"
            ],
            [
                'name' => "Livres-objets"
            ],
            [
                'name' => "Mise-en-scène"
            ],
            [
                'name' => "Peinture"
            ],
            [
                'name' => "Sculptures"
            ],
            [
                'name' => "Théatre"
            ],
        ];

        foreach ($categories as $category) {
            $categoryObjet = new Category();

            $categoryObjet->setName($category['name']);
            $manager->persist($categoryObjet);
        }

        $manager->flush();

    }
}