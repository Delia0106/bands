<?php

namespace App\Repository;

use App\Entity\GroupeMusical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupeMusical>
 *
 * @method GroupeMusical|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeMusical|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeMusical[]    findAll()
 * @method GroupeMusical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeMusicalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeMusical::class);
    }

//    /**
//     * @return GroupeMusical[] Returns an array of GroupeMusical objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GroupeMusical
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
