<?php

namespace App\Repository;

use App\Entity\HitoriqueOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HitoriqueOperation>
 *
 * @method HitoriqueOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method HitoriqueOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method HitoriqueOperation[]    findAll()
 * @method HitoriqueOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HitoriqueOperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HitoriqueOperation::class);
    }

//    /**
//     * @return HitoriqueOperation[] Returns an array of HitoriqueOperation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HitoriqueOperation
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
