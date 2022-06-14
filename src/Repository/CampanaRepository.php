<?php

namespace App\Repository;

use App\Entity\Campana;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Campana>
 *
 * @method Campana|null find($id, $lockMode = null, $lockVersion = null)
 * @method Campana|null findOneBy(array $criteria, array $orderBy = null)
 * @method Campana[]    findAll()
 * @method Campana[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampanaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campana::class);
    }

    public function add(Campana $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Campana $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Campana[] Returns an array of Campana objects
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

//    public function findOneBySomeField($value): ?Campana
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function findAllCampaign(){
        $con = $this->getEntityManager()->getConnection();
        $query="
        select id, campana 
        from campana;";
        $consulta= $con->prepare($query);
        $datos=$consulta->executeQuery();
        return $datos->fetchAllAssociative();
    }
}
