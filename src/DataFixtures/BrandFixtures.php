<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $brands = ['Adidas','Nike','Puma','Pull&Bear','Prada','Tommy&Hilfiger','Lacoste'];

        foreach ($brands as $name) {
            $brand = new Brand();
            $brand->setName($name);
            $brand->setIsVisible(true);
            $manager->persist($brand);
        }

        $manager->flush();
    }
}
