<?php

namespace App\Repository;

use App\Entity\BonCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Cast\Array_;

/**
 * @extends ServiceEntityRepository<BonCommande>
 *
 * @method BonCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method BonCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method BonCommande[]    findAll()
 * @method BonCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BonCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BonCommande::class);
    }


    public function findBonCommEnAtt(): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.codeStatus = :status')
            ->setParameter('status', 1)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findBonCommValide(): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.codeStatus = :status')
            ->setParameter('status', 3)
            ->getQuery()
            ->getResult()
        ;
    }

    public function bonCommandeParStatus()
    {
        return $this->createQueryBuilder('b')
        ->select('b.id')
        ->select('s.libelle','count(b.id) as count')
             ->join('b.codeStatus','s')
             ->groupBy('s.libelle')
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return BonCommande[] Returns an array of BonCommande objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BonCommande
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
