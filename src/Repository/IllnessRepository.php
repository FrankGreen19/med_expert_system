<?php

namespace App\Repository;

use App\Entity\Illness;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Illness|null find($id, $lockMode = null, $lockVersion = null)
 * @method Illness|null findOneBy(array $criteria, array $orderBy = null)
 * @method Illness[]    findAll()
 * @method Illness[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IllnessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Illness::class);
    }

    // /**
    //  * @return Illness[] Returns an array of Illness objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Illness
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
