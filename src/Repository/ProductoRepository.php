<?php

namespace App\Repository;

use App\Entity\Producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Producto>
 *
 * @method Producto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Producto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Producto[]    findAll()
 * @method Producto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

    public function add(Producto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Producto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Producto[] Returns an array of Producto objects
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

//    public function findOneBySomeField($value): ?Producto
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findAllProducts(){
        $con = $this->getEntityManager()->getConnection();
        $query="
        select id,nombre,precio,foto,stock,campana_id,capacidad_id,cosecha_id,variedad_id 
        from producto;";
        $consulta= $con->prepare($query);
        $datos=$consulta->executeQuery();
        return $datos->fetchAllAssociative();
    }

    public function findProductoById(int $id){
        $idString=strval($id);
        $con = $this->getEntityManager()->getConnection();
        $query="
        select id,nombre,precio,foto,stock,campana_id,capacidad_id,cosecha_id,variedad_id 
        from producto
        where id=".$idString.";";
        $consulta= $con->prepare($query);
        $datos=$consulta->executeQuery();
        return $datos->fetchAssociative();
    }

    public function findProduct(string $id){
        $con = $this->getEntityManager()->getConnection();
        $query="select p.id as id, p.nombre as nombre, p.precio as precio,p.foto as foto,p.descripcion as descripcion,c.cosecha as cosecha, c2.campana as campana,c3.capacidad as capacidad,v.variedad as variedad
        from producto p
            join cosecha c on c.id = p.cosecha_id
            join campana c2 on c2.id = p.campana_id
            join capacidad c3 on c3.id = p.capacidad_id
            join variedad v on v.id = p.variedad_id
            where p.id=".$id."
            group by p.id, c.cosecha, c2.campana, c3.capacidad, v.variedad;";
        $consulta =$con->prepare($query);
        $datos=$consulta->executeQuery();
        return $datos->fetchAssociative();
    }
}
