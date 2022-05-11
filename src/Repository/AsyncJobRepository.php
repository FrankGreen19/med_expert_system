<?php

namespace App\Repository;

use App\Entity\AsyncJob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AsyncJob|null find($id, $lockMode = null, $lockVersion = null)
 * @method AsyncJob|null findOneBy(array $criteria, array $orderBy = null)
 * @method AsyncJob[]    findAll()
 * @method AsyncJob[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsyncJobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AsyncJob::class);
    }

    // /**
    //  * @return AsyncJob[] Returns an array of AsyncJob objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AsyncJob
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
