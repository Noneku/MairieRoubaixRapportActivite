<?php

namespace App\Repository;

use App\Entity\RapportActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RapportActivite>
 *
 * @method RapportActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportActivite[]    findAll()
 * @method RapportActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RapportActivite::class);
    }

//    /**
//     * @return RapportActivite[] Returns an array of RapportActivite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RapportActivite
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
