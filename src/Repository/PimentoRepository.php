<?php

namespace App\Repository;

use App\Entity\Pimento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pimento>
 *
 * @method Pimento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pimento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pimento[]    findAll()
 * @method Pimento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PimentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pimento::class);
    }

//    /**
//     * @return Pimento[] Returns an array of Pimento objects
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

//    public function findOneBySomeField($value): ?Pimento
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
