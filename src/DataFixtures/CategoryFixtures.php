<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $i = 0;
        $categories = ['Shoes','Tshirt','Trousers'];

        foreach ($categories as $name) {
            $category = new Category();
            $category->setName($name);
            $category->setIsVisible(true);
            $manager->persist($category);

            $this->addReference(sprintf('category-%s', $i++), $category);
        }

        $manager->flush();
    }
}
