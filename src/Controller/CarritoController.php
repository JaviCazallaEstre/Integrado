<?php

namespace App\Controller;

use DateTime;
use App\Entity\Compra;
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

        $productos = array_map(function ($carrito) {
            return $carrito["producto"];
        }, $carritos);
        $cantidades = array_count_values(array_column($productos, 'id'));
        $productosUnicos = array_unique($productos, SORT_REGULAR);
        $productosUnicosConCantidad = array_map(
            function ($producto) use ($cantidades) {
                $producto["cantidad"] = $cantidades[$producto['id']];
                $producto["precio"] = $producto["precio"] / 100;
                return $producto;
            },
            $productosUnicos
        );
        return $this->render('carrito/index.html.twig', [
            'controller_name' => 'CarritoController',
            'productos' => $productosUnicosConCantidad
        ]);
    }

    #[Route('/carrito/actualizar', name: 'actualizaCarrito')]
    public function actualizaCarrito(ManagerRegistry $doctrine): Response
    {
        $carritos = $doctrine->getRepository(Carrito::class)->findOneByIdJoinedToProduct($this->getUser()->getId());
        $productos = array_map(function ($carrito) {
            return $carrito["producto"];
        }, $carritos);
        $cantidades = array_count_values(array_column($productos, 'id'));
        $productosUnicos = array_unique($productos, SORT_REGULAR);
        $productosUnicosConCantidad = array_map(
            function ($producto) use ($cantidades) {
                $producto["cantidad"] = $cantidades[$producto['id']];
                $producto["precio"] = $producto["precio"] / 100;
                return $producto;
            },
            $productosUnicos
        );
        $response = array(
            "code" => 200,
            "response" => $this->render('carrito/contenido.html.twig', [
                'productos' => $productosUnicosConCantidad,
            ])->getContent()
        );
        return new Response(json_encode($response));
    }

    #[Route('/elimina/carrito/{id}', name: 'quitaCarrito')]
    public function eliminaCarrito(ManagerRegistry $doctrine, int $id)
    {     
        $carrito = $doctrine->getRepository(Carrito::class)->findFirstCarritoForUserAndProduct($this->getUser()->getId(), $id);
        if($carrito!= null){
            $doctrine->getRepository(Carrito::class)->remove($carrito, true);
        } 
        $response = array(
            "code" => 200
        );
        return new Response(json_encode($response));
    }
    
    #[Route('/todos/carrito/{id}', name: 'quitaTodosCarritos')]
    public function eliminarTodosCarritos(ManagerRegistry $doctrine, int $id)
    {     
        $carritos = $doctrine->getRepository(Carrito::class)->findAllCarritoForUserAndProduct($this->getUser()->getId(), $id);
        if (count($carritos) > 0){
            foreach ($carritos as $carrito){
                 $carro = $doctrine->getRepository(Carrito::class)->findOneBy([
                    "id"=>$carrito["id"]
                ]);
                $doctrine->getRepository(Carrito::class)->remove($carro,true);
            }
     
        } 
        $response = array(
            "code" => 200
        );
        return new Response(json_encode($response));
    }


    #[Route('/crea/carrito/{idProducto}', name: 'creaCarrito')]
    public function creaCarrito(ManagerRegistry $doctrine, EntityManagerInterface $entityManager, int $idProducto)
    {
        if ($idProducto != null) {
            $producto = $doctrine->getRepository(Producto::class)->find($idProducto);
            $carrito = new Carrito;
            $carrito->setUsuario($this->getUser());
            $carrito->setProducto($producto);
            $entityManager->persist($carrito);
            $entityManager->flush();
            $response = array(
                "code" => 200
            );
            return new Response(json_encode($response));
        } else {
            throw $this->createNotFoundException("El producto que quieres comprar no existe.");
        }
    }
    #[Route('/comprar', name:'comprar')]
    public function compra(ManagerRegistry $doctrine, EntityManagerInterface $entityManager) {
        $carritos = $doctrine->getRepository(Carrito::class)->findOneByIdJoinedToProduct($this->getUser()->getId());

        if (count($carritos) > 0) {
            $compra = new Compra();
            $compra->setFecha(new DateTime());
            $compra->setUsuario($this->getUser());
            foreach ($carritos as $carrito){
                $producto = $doctrine->getRepository(Producto::class)->findOneBy([
                    "id"=>$carrito["producto"]["id"]
                ]);
                if($producto != null) {
                    $compra->addCompra($producto);
                    $producto->setStock($producto->getStock() - 1);
                }
                $carritoRepository = $doctrine->getRepository(Carrito::class);
                $entityCarrito = $carritoRepository->find($carrito["id"]);
                if($entityCarrito!= null) {
                    $carritoRepository->remove($entityCarrito);
                } 
            }
            
            $entityManager->persist($compra);
            $entityManager->flush();
            $response = array(
                "code" => 200
            );
        } else {
            $response = array(
                "code" => 403,
                "message" => "El carrito debe tener productos para poder realizar una compra"
            );
        }
        
        return new Response(json_encode($response));
    }
}
