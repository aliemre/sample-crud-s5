<?php

namespace App\DataFixtures;

use App\Entity\SubCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SubCategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categories = ['Man','Woman'];

        foreach ($categories as $name) {
            $subCategory = new SubCategory();
            $subCategory->setName($name);
            $subCategory->setIsVisible(true);

            // Get reference of the category
            $category = $this->getReference(sprintf('category-%s', rand(0, 2)));
            $subCategory->setCategory($category);

            $manager->persist($subCategory);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}
