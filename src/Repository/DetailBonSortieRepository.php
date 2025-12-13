<?php

namespace App\Repository;

use App\Entity\DetailBonSortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailBonSortie>
 *
 * @method DetailBonSortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailBonSortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailBonSortie[]    findAll()
 * @method DetailBonSortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailBonSortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailBonSortie::class);
    }

//    /**
//     * @return DetailBonSortie[] Returns an array of DetailBonSortie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DetailBonSortie
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
