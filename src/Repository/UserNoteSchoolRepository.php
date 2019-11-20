<?php

namespace App\Repository;

use App\Entity\UserNoteSchool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserNoteSchool|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserNoteSchool|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserNoteSchool[]    findAll()
 * @method UserNoteSchool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserNoteSchoolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserNoteSchool::class);
    }

    // /**
    //  * @return UserNoteSchool[] Returns an array of UserNoteSchool objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserNoteSchool
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
