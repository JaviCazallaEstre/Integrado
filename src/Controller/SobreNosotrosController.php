<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SobreNosotrosController extends AbstractController
{
    #[Route('/sobre', name: 'app_sobre_nosotros')]
    public function index(): Response
    {
        return $this->render('sobre_nosotros/index.html.twig', [
            'controller_name' => 'SobreNosotrosController',
        ]);
    }
}
