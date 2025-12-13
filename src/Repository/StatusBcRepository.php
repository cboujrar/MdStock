<?php

namespace App\Repository;

use App\Entity\StatusBc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusBc>
 *
 * @method StatusBc|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusBc|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusBc[]    findAll()
 * @method StatusBc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusBcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusBc::class);
    }

//    /**
//     * @return StatusBc[] Returns an array of StatusBc objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StatusBc
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
