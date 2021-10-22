<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=2; $i++) {
            $course = new Course();
            $course->setTitle("Course $i");
            $course->setDate(\DateTime::createFromFormat('Y-m-d', '1990-05-08'));

            $manager->persist($course);
        }

        $manager->flush();
    }
}
