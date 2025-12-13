<?php

namespace App\Repository;

use App\Entity\HistoriqueOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HistoriqueOperation>
 *
 * @method HistoriqueOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoriqueOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoriqueOperation[]    findAll()
 * @method HistoriqueOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoriqueOperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoriqueOperation::class);
    }

//    /**
//     * @return HistoriqueOperation[] Returns an array of HistoriqueOperation objects
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

//    public function findOneBySomeField($value): ?HistoriqueOperation
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
