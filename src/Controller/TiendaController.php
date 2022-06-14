<?php

namespace App\Controller;

use App\Entity\Campana;
use App\Entity\Capacidad;
use App\Entity\Cosecha;
use App\Entity\Producto;
use App\Entity\Variedad;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TiendaController extends AbstractController
{
    #[Route('/tienda', name: 'app_tienda')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $productos= $doctrine->getRepository(Producto::class)->findAllProducts();
        $listaProductos=[];
        foreach ($productos as $producto){
            $listaProductos[]=[
                'id'=>$producto["id"],
                'nombre'=>$producto["nombre"],
                'foto' =>$producto["foto"],
                'precio'=>$producto["precio"],
                'stock'=>$producto["stock"],
                'idCosecha'=>$producto["cosecha_id"],
                'idCampana'=>$producto["campana_id"],
                'idCapacidad'=>$producto["capacidad_id"],
                'idVariedad'=>$producto["variedad_id"]
            ];
        }
        $capacidades= $doctrine->getRepository(Capacidad::class)->findAllCapacity();
        $listaCapacidades=[];
        foreach($capacidades as $capacidad){
            $listaCapacidades[]=[
                'id'=>$capacidad["id"],
                'capacidad'=>$capacidad["capacidad"]
            ];
        }
        $cosechas= $doctrine->getRepository(Cosecha::class)->findAllHarvets();
        $listaCosechas=[];
        foreach($cosechas as $cosecha){
            $listaCosechas[]=[
                'id'=>$cosecha["id"],
                'cosecha'=>$cosecha["cosecha"]
            ];
        }
        $variedades= $doctrine->getRepository(Variedad::class)->findAllVarieties();
        $listaVariedades=[];
        foreach($variedades as $variedad){
            $listaVariedades[]=[
                'id'=>$variedad["id"],
                'variedad'=>$variedad['variedad']
            ];
        }
        $campanas= $doctrine->getRepository(Campana::class)->findAllCampaign();
        $listaCamapanas=[];
        foreach($campanas as $campana){
            $listaCamapanas[]=[
                'id'=>$campana["id"],
                'campana'=>$campana["campana"]
            ];
        }
        return $this->render('tienda/index.html.twig', [
            'controller_name' => 'TiendaController',
            'productos'=>$listaProductos,
            'variedades'=>$listaVariedades,
            'campanas'=>$listaCamapanas,
            'cosechas'=>$listaCosechas,
            'capacidades'=>$listaCapacidades
        ]);
    }

    #[Route('/tienda/producto/{id}', name: 'getProducto')]
    public function findProductById(string $id, ManagerRegistry $doctrine): Response{
        $producto=$doctrine->getRepository(Producto::class)->findProduct($id);
        if(!$producto){
            throw $this->createNotFoundException("El producto que buscas no existe");
        }else{
            $response = array(
                "code"=>200,
                "response"=> $this->render('detalles_producto/contenido.html.twig',[
                    'producto'=>$producto,
                ])->getContent()
            );
            return new Response(json_encode($response));
        }
    }
}
