<?php

namespace App\Repository;

use App\Entity\Trajets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Trajets>
 *
 * @method Trajets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trajets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trajets[]    findAll()
 * @method Trajets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrajetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trajets::class);
    }

    public function findByDepartEtDestination(?string $depart, ?string $destination): array
    {
    $qb = $this->createQueryBuilder('t');

    if ($depart) {
        $qb->andWhere('t.depart = :depart')
           ->setParameter('depart', $depart);
    }

    if ($destination) {
        $qb->andWhere('t.destination = :destination')
           ->setParameter('destination', $destination);
    }

    return $qb->getQuery()->getResult();
    }


//    /**
//     * @return Trajet[] Returns an array of Trajets objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
