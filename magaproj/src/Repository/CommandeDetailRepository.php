<?php

namespace App\Repository;

use App\Entity\CommandeDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeDetail[]    findAll()
 * @method CommandeDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeDetail::class);
    }

    // /**
    //  * @return CommandeDetail[] Returns an array of CommandeDetail objects
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
    public function findOneBySomeField($value): ?CommandeDetail
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
