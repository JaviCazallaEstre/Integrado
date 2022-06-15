<?php

namespace App\Controller;

use App\Entity\Carrito;
use App\Entity\Producto;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarritoController extends AbstractController
{
    #[Route('/carrito', name: 'app_carrito')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $carritos = $doctrine->getRepository(Carrito::class)->findOneByIdJoinedToProduct($this->getUser()->getId());
        $productos = array_map(function ($carrito) { return $carrito["producto"]; }, $carritos);
        $cantidades = array_count_values(array_column($productos, 'id'));
        $productosUnicos = array_unique($productos, SORT_REGULAR);
        $productosUnicosConCantidad = array_map(
            function ($producto) use ($cantidades) { 
                $producto["cantidad"] = $cantidades[$producto['id']];
                return $producto; 
            },
            $productosUnicos
        );
        dd($productosUnicosConCantidad);
        return $this->render('carrito/index.html.twig', [
            'controller_name' => 'CarritoController',
        ]);
    }

    #[Route('/crea/carrito/{idProducto}/{cantidad}', name: 'creaCarrito')]
    public function creaCarrito(ManagerRegistry $doctrine,EntityManagerInterface $entityManager, int $idProducto, int $cantidad)
    {
        if ( $idProducto != null && $cantidad > 0) {
            $producto= $doctrine->getRepository(Producto::class)->find($idProducto);
            $carrito = new Carrito;
            $carrito->setUsuario($this->getUser());
            $carrito->setProducto($producto);
            $carrito->setCantidad($cantidad);
            $entityManager->persist($carrito);
            $entityManager->flush();
            $response = array(
                "code"=>200
            );
            return new Response(json_encode($response));
        } else {
            throw $this->createNotFoundException("El producto que quieres comprar no existe o la cantidad es inválida.");
        }
    }
}
