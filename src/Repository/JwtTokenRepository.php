<?php

namespace App\Repository;

use App\Entity\JwtToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JwtToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method JwtToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method JwtToken[]    findAll()
 * @method JwtToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JwtTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JwtToken::class);
    }

    // /**
    //  * @return JwtToken[] Returns an array of JwtToken objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JwtToken
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
