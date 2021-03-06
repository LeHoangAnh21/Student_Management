<?php

namespace App\DataFixtures;

use App\Entity\Classroom;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClassroomFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=2; $i++) {
            $classroom = new Classroom();
            $classroom->setName("Classroom $i");

            $manager->persist($classroom);
        }

        $manager->flush();
    }
}
