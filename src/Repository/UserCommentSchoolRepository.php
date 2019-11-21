<?php

namespace App\Repository;

use App\Entity\UserCommentSchool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserCommentSchool|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCommentSchool|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCommentSchool[]    findAll()
 * @method UserCommentSchool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCommentSchoolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCommentSchool::class);
    }

    // /**
    //  * @return UserCommentSchool[] Returns an array of UserCommentSchool objects
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
    public function findOneBySomeField($value): ?UserCommentSchool
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
