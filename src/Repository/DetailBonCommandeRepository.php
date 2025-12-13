<?php

namespace App\Repository;

use App\Entity\DetailBonCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailBonCommande>
 *
 * @method DetailBonCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailBonCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailBonCommande[]    findAll()
 * @method DetailBonCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailBonCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailBonCommande::class);
    }

//    /**
//     * @return DetailBonCommande[] Returns an array of DetailBonCommande objects
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

//    public function findOneBySomeField($value): ?DetailBonCommande
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
