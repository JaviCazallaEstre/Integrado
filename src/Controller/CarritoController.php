<?php

namespace App\Controller;

use App\Entity\Carrito;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarritoController extends AbstractController
{
    #[Route('/carrito', name: 'app_carrito')]
    public function index(): Response
    {
        return $this->render('carrito/index.html.twig', [
            'controller_name' => 'CarritoController',
        ]);
    }
    #[Route('/carrito/{params}', name: 'creaCarrito')]
    public function creaCarrito(Request $request, EntityManagerInterface $entityManager)
    {
        $carrito = new Carrito;
        $usuario = $request->get('idUsuario');
        $producto = $request->get('idProducto');
        $cantidad = $request->get('cantidad');
        if ($usuario != "" && $producto != "" && $cantidad > 0) {
            $carrito->setUsuario($usuario);
            $carrito->setProducto($producto);
            $carrito->setCantidad($cantidad);
            $entityManager->persist($carrito);
            $entityManager->flush();
        }
    }
}
