<?php

namespace App\Repository;

use App\Entity\ProfilEstimateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProfilEstimateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfilEstimateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfilEstimateur[]    findAll()
 * @method ProfilEstimateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfilEstimateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfilEstimateur::class);
    }

    // /**
    //  * @return ProfilEstimateur[] Returns an array of ProfilEstimateur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProfilEstimateur
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
