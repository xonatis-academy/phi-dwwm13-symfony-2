<?php

namespace App\Repository;

use App\Entity\ProfileAcheteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProfileAcheteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfileAcheteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfileAcheteur[]    findAll()
 * @method ProfileAcheteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfileAcheteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfileAcheteur::class);
    }

    // /**
    //  * @return ProfileAcheteur[] Returns an array of ProfileAcheteur objects
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
    public function findOneBySomeField($value): ?ProfileAcheteur
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
