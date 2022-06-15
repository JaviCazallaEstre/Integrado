<?php

namespace App\Repository;

use App\Entity\Variedad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Variedad>
 *
 * @method Variedad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Variedad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Variedad[]    findAll()
 * @method Variedad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VariedadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Variedad::class);
    }

    public function add(Variedad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Variedad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Variedad[] Returns an array of Variedad objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Variedad
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findAllVarieties(){
        $con = $this->getEntityManager()->getConnection();
        $query="
        select id, variedad 
        from variedad;";
        $consulta= $con->prepare($query);
        $datos=$consulta->executeQuery();
        return $datos->fetchAllAssociative();
    }
    public function findVrietyById(string $id){
        $con = $this->getEntityManager()->getConnection();
        $query="
        select id, variedad 
        from variedad
        where id=".$id.";";
        $consulta= $con->prepare($query);
        $datos=$consulta->executeQuery();
        return $datos->fetchAssociative();
    }
}
