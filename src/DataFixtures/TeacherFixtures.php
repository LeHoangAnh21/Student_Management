<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeacherFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=2; $i++) {
            $teacher = new Teacher();
            $teacher->setName("Teacher $i");
            $teacher->setEmail("dragon@gmail.com");
            $teacher->setBirthday(\DateTime::createFromFormat('Y-m-d', '2011-1-11'));
            $teacher->setImage("cover.jpg");

            $manager->persist($teacher);
        }

        $manager->flush();
    }
}
