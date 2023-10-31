<?php

namespace App\Repository;

use App\Entity\IndexPole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IndexPole>
 *
 * @method IndexPole|null find($id, $lockMode = null, $lockVersion = null)
 * @method IndexPole|null findOneBy(array $criteria, array $orderBy = null)
 * @method IndexPole[]    findAll()
 * @method IndexPole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndexPoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IndexPole::class);
    }

//    /**
//     * @return IndexPole[] Returns an array of IndexPole objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IndexPole
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
