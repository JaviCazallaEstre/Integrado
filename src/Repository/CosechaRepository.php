<?php

namespace App\Repository;

use App\Entity\Cosecha;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cosecha>
 *
 * @method Cosecha|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cosecha|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cosecha[]    findAll()
 * @method Cosecha[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CosechaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cosecha::class);
    }

    public function add(Cosecha $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cosecha $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Cosecha[] Returns an array of Cosecha objects
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

//    public function findOneBySomeField($value): ?Cosecha
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function findAllHarvets(){
        $con = $this->getEntityManager()->getConnection();
        $query="
        select id, cosecha 
        from cosecha;";
        $consulta= $con->prepare($query);
        $datos=$consulta->executeQuery();
        return $datos->fetchAllAssociative();
    }
}
