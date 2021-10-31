<?php

namespace App\Repository;

use App\Entity\Classroomn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Classroomn|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classroomn|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classroomn[]    findAll()
 * @method Classroomn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassroomnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classroomn::class);
    }

    // /**
    //  * @return Classroomn[] Returns an array of Classroomn objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Classroomn
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
