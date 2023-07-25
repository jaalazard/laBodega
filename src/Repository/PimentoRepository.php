<?php

namespace App\Repository;

use App\Entity\Pimento;
use App\Entity\PimentoSearch;
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

    public function save(Pimento $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Pimento $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchPimento(PimentoSearch $pimentoSearch): array
    {
        $queryBuilder = $this->createQueryBuilder('p');
        if($pimentoSearch->getSearch()){
            $queryBuilder->andWhere('p.name LIKE :search')
            ->setParameter('search', '%' . $pimentoSearch->getSearch() . '%');
        }
        if($pimentoSearch->getMinPrice()){
            $queryBuilder->andWhere('p.price > :minPrice')
            ->setParameter('minPrice', $pimentoSearch->getMinPrice());
        }
        if($pimentoSearch->getMaxPrice()){
            $queryBuilder->andWhere('p.price < :maxPrice')
            ->setParameter('maxPrice', $pimentoSearch->getMaxPrice());
        }
        if($pimentoSearch->getColor()){
            $queryBuilder->andWhere('p.color = :color')
            ->setParameter('color', $pimentoSearch->getColor());
        }
        if($pimentoSearch->getMinStrength()){
            $queryBuilder->andWhere('p.strength > :minStrength')
            ->setParameter('minStrength', $pimentoSearch->getMinStrength());
        }
        if($pimentoSearch->getMaxStrength()){
            $queryBuilder->andWhere('p.strength < :maxStrength')
            ->setParameter('maxStrength', $pimentoSearch->getMaxStrength());
        }
        return $queryBuilder->getQuery()
            ->getResult();
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
