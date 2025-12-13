<?php

namespace App\Repository;

use App\Entity\OublierPass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OublierPass>
 *
 * @method OublierPass|null find($id, $lockMode = null, $lockVersion = null)
 * @method OublierPass|null findOneBy(array $criteria, array $orderBy = null)
 * @method OublierPass[]    findAll()
 * @method OublierPass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OublierPassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OublierPass::class);
    }

//    /**
//     * @return OublierPass[] Returns an array of OublierPass objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OublierPass
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
