<?php

namespace App\Repository;

use App\Entity\FavorisJoueur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FavorisJoueur>
 *
 * @method FavorisJoueur|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavorisJoueur|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavorisJoueur[]    findAll()
 * @method FavorisJoueur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavorisJoueurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FavorisJoueur::class);
    }

    public function save(FavorisJoueur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FavorisJoueur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FavorisJoueur[] Returns an array of FavorisJoueur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FavorisJoueur
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
