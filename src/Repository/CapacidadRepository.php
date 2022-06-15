<?php

namespace App\Repository;

use App\Entity\Capacidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Capacidad>
 *
 * @method Capacidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Capacidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Capacidad[]    findAll()
 * @method Capacidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapacidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Capacidad::class);
    }

    public function add(Capacidad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Capacidad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Capacidad[] Returns an array of Capacidad objects
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

//    public function findOneBySomeField($value): ?Capacidad
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function findAllCapacity(){
        $con = $this->getEntityManager()->getConnection();
        $query="
        select id, capacidad 
        from capacidad;";
        $consulta= $con->prepare($query);
        $datos=$consulta->executeQuery();
        return $datos->fetchAllAssociative();
    }
    public function findCapacityById(string $id){
        $con = $this->getEntityManager()->getConnection();
        $query="
        select id, capacidad 
        from capacidad
        where id=".$id.";";
        $consulta= $con->prepare($query);
        $datos=$consulta->executeQuery();
        return $datos->fetchAssociative();
    }
}
