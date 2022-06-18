<?php

namespace App\Controller;

use App\Entity\Compra;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PedidosController extends AbstractController
{
    #[Route('/pedidos', name: 'app_pedidos')]
    public function index(): Response
    {
        return $this->render('pedidos/index.html.twig', [
            'controller_name' => 'PedidosController',
        ]);
    }

    #[Route('/mis/pedidos', name: 'misPedidos')]
    public function sacaPedidos(ManagerRegistry $doctrine)
    {
        $compras = $doctrine->getRepository(Compra::class)->findOneShopByIdJoinedToProduct($this->getUser()->getId());
        $reponse = array(
            "code" => 200,
            "compras" => $compras
        );
        return new Response(json_encode($reponse));
    }
}
