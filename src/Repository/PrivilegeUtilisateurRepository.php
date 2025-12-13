<?php

namespace App\Repository;

use App\Entity\PrivilegeUtilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrivilegeUtilisateur>
 *
 * @method PrivilegeUtilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrivilegeUtilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrivilegeUtilisateur[]    findAll()
 * @method PrivilegeUtilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrivilegeUtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrivilegeUtilisateur::class);
    }
    public function verifPrivilege($idutil,$libPriv): ?PrivilegeUtilisateur
   {
       return $this->createQueryBuilder('p')
       ->select("p")
            ->join("p.idUtilisateur", "u")
            ->join("p.idPriv", 'pr')
            ->andWhere('u.id = :idUtil')
           ->setParameter('idUtil', $idutil)
           ->andWhere("pr.libPriv = :libPriv")
           ->setParameter("libPriv", $libPriv)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }

//    /**
//     * @return PrivilegeUtilisateur[] Returns an array of PrivilegeUtilisateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PrivilegeUtilisateur
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
