<?php

namespace App\Repository;

use App\Entity\Partcipant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Partcipant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partcipant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partcipant[]    findAll()
 * @method Partcipant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartcipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partcipant::class);
    }

    // /**
    //  * @return Partcipant[] Returns an array of Partcipant objects
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
    public function findOneBySomeField($value): ?Partcipant
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
