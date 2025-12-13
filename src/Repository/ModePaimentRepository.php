<?php

namespace App\Repository;

use App\Entity\ModePaiment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModePaiment>
 *
 * @method ModePaiment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModePaiment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModePaiment[]    findAll()
 * @method ModePaiment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModePaimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModePaiment::class);
    }

//    /**
//     * @return ModePaiment[] Returns an array of ModePaiment objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ModePaiment
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
