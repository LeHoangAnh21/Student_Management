<?php

namespace App\DataFixtures;

use App\Entity\Classroomn;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClassroomnFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $classroomn = new Classroomn();
            $classroomn->setName("Classroom $i");

            $manager->persist($classroomn);
        };

        $manager->flush();
    }
}
