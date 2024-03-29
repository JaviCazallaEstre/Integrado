<?php

namespace App\Repository;

use App\Entity\Carrito;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Carrito>
 *
 * @method Carrito|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carrito|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carrito[]    findAll()
 * @method Carrito[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarritoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carrito::class);
    }

    public function add(Carrito $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Carrito $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Carrito[] Returns an array of Carrito objects
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

    //    public function findOneBySomeField($value): ?Carrito
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findOneByIdJoinedToProduct(int $idUsuario): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c, p
            FROM App\Entity\Carrito c
            INNER JOIN c.producto p
            WHERE c.usuario = :id'
        )->setParameter('id', $idUsuario);

        return $query->getArrayResult();
    }

    public function findFirstCarritoForUserAndProduct(int $idUsuario, int $idProducto): ?Carrito
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Carrito c
            WHERE c.usuario = :idUsuario
            AND c.producto = :idProducto'
        )
            ->setMaxResults(1)
            ->setParameter('idUsuario', $idUsuario)
            ->setParameter("idProducto", $idProducto);

        return $query->getOneOrNullResult();
    }

    public function findAllCarritoForUserAndProduct(int $idUsuario, int $idProducto): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Carrito c
            WHERE c.usuario = :idUsuario
            AND c.producto = :idProducto'
        )
            ->setParameter('idUsuario', $idUsuario)
            ->setParameter("idProducto", $idProducto);

        return $query->getArrayResult();
    }
}
