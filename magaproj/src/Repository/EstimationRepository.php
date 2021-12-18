<?php

namespace App\Repository;

use App\Entity\Estimation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Estimation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estimation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estimation[]    findAll()
 * @method Estimation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstimationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estimation::class);
    }

    // /**
    //  * @return Estimation[] Returns an array of Estimation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Estimation
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
