<?php

namespace App\Repository;

use App\Entity\XrayImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method XrayImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method XrayImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method XrayImage[]    findAll()
 * @method XrayImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XrayImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, XrayImage::class);
    }

    // /**
    //  * @return XrayImage[] Returns an array of XrayImage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('x.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?XrayImage
    {
        return $this->createQueryBuilder('x')
            ->andWhere('x.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
