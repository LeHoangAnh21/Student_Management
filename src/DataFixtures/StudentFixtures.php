<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=2; $i++) {
            $student = new Student();
            $student->setName("Student $i");
            $student->setEmail("anhlhgch190172@fpt.edu.vn");
            $student->setStudentId("GCH190172");
            $student->setBirthday(\DateTime::createFromFormat('Y-m-d', '2011-1-11'));
            $student->setImage("avatar.png");

            $manager->persist($student);
        }

        $manager->flush();
    }
}
