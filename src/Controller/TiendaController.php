<?php

namespace App\Controller;

use App\Entity\Campana;
use App\Entity\Cosecha;
use App\Entity\Producto;
use App\Entity\Variedad;
use App\Entity\Capacidad;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TiendaController extends AbstractController
{
    #[Route('/tienda', name: 'app_tienda')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $productos =  $doctrine->getRepository(Producto::class)->findAllProducts();

        $todasCapacidades = $doctrine->getRepository(Capacidad::class)->findAllCapacity();
        $listaCapacidades = [];
        foreach ($todasCapacidades as $capacidad) {
            $listaCapacidades[] = [
                'id' => $capacidad["id"],
                'capacidad' => $capacidad["capacidad"]
            ];
        }
        $cosechas = $doctrine->getRepository(Cosecha::class)->findAllHarvets();
        $listaCosechas = [];
        foreach ($cosechas as $cosecha) {
            $listaCosechas[] = [
                'id' => $cosecha["id"],
                'cosecha' => $cosecha["cosecha"]
            ];
        }
        $variedades = $doctrine->getRepository(Variedad::class)->findAllVarieties();
        $listaVariedades = [];
        foreach ($variedades as $variedad) {
            $listaVariedades[] = [
                'id' => $variedad["id"],
                'variedad' => $variedad['variedad']
            ];
        }
        $campanas = $doctrine->getRepository(Campana::class)->findAllCampaign();
        $listaCamapanas = [];
        foreach ($campanas as $campana) {
            $listaCamapanas[] = [
                'id' => $campana["id"],
                'campana' => $campana["campana"]
            ];
        }

        $filter = $request->query->get('filter[]');
        if ($filter != null) {
            $filtros = explode('/', $filter);
            $filtrosPorTipo = array();
            foreach ($filtros as $filtro) {
                $claveValor = explode('~', $filtro);
                if (count($claveValor) > 1) {
                    $filtrosPorTipo[$claveValor[0]] = explode('_', $claveValor[1]);
                }
            }

            if (isset($filtrosPorTipo["capacidad"])) {
                $idCapacidades = array_map(function($capacidad) use ($todasCapacidades) {
                    foreach ($todasCapacidades as $capacidadConId) {
                        if ($capacidadConId["capacidad"] == $capacidad) {
                            return $capacidadConId["id"];
                        }
                    }

                    return null;
                }, $filtrosPorTipo["capacidad"]);

                $productos = array_filter($productos, function ($producto) use ($idCapacidades) {
                    return in_array($producto["capacidad_id"], $idCapacidades);
                });
            }

            if (isset($filtrosPorTipo["cosecha"])) {
                $idCosechas = array_map(function($cosecha) use ($cosechas) {
                    foreach ($cosechas as $cosechaConId) {
                        if ($cosechaConId["cosecha"] == $cosecha) {
                            return $cosechaConId["id"];
                        }
                    }

                    return null;
                }, $filtrosPorTipo["cosecha"]);

                $productos = array_filter($productos, function ($producto) use ($idCosechas) {
                    return in_array($producto["cosecha_id"], $idCosechas);
                });
            }

            if (isset($filtrosPorTipo["campana"])) {
                $idCampanas = array_map(function($campana) use ($campanas) {
                    foreach ($campanas as $campanaConId) {
                        if ($campanaConId["campana"] == $campana) {
                            return $campanaConId["id"];
                        }
                    }

                    return null;
                }, $filtrosPorTipo["campana"]);

                $productos = array_filter($productos, function ($producto) use ($idCampanas) {
                    return in_array($producto["campana_id"], $idCampanas);
                });
            }

            if (isset($filtrosPorTipo["variedad"])) {
                $idVariedades = array_map(function($variedad) use ($variedades) {
                    foreach ($variedades as $variedadConId) {
                        if ($variedadConId["variedad"] == $variedad) {
                            return $variedadConId["id"];
                        }
                    }

                    return null;
                }, $filtrosPorTipo["variedad"]);

                $productos = array_filter($productos, function ($producto) use ($idVariedades) {
                    return in_array($producto["variedad_id"], $idVariedades);
                });
            }
        }

        $ordenPrecio = $request->query->get('ordenPrecio');
        if ($ordenPrecio == "asc") {
            usort($productos, function($a, $b) { return $a["precio"] > $b["precio"]; });
        } else if ($ordenPrecio == "desc") {
            usort($productos, function($a, $b) { return $a["precio"] < $b["precio"]; });
        }

        $listaProductos = [];
        foreach ($productos as $producto) {
            $listaProductos[] = [
                'id' => $producto["id"],
                'nombre' => $producto["nombre"],
                'foto' => $producto["foto"],
                'precio' => $producto["precio"] / 100,
                'stock' => $producto["stock"]
            ];
        }
        return $this->render('tienda/index.html.twig', [
            'controller_name' => 'TiendaController',
            'productos' => $listaProductos,
            'variedades' => $listaVariedades,
            'campanas' => $listaCamapanas,
            'cosechas' => $listaCosechas,
            'capacidades' => $listaCapacidades
        ]);
    }

    #[Route('/tienda/producto/{id}', name: 'getProducto')]
    public function findProductById(string $id, ManagerRegistry $doctrine): Response
    {
        $producto = $doctrine->getRepository(Producto::class)->findProduct($id);
        if (!$producto) {
            throw $this->createNotFoundException("El producto que buscas no existe");
        } else {
            $precioCentimos = (int)$producto["precio"];
            $precioEuros = $precioCentimos / 100;
            $producto["precio"] = $precioEuros;
            $response = array(
                "code" => 200,
                "response" => $this->render('detalles_producto/contenido.html.twig', [
                    'producto' => $producto,
                ])->getContent()
            );
            return new Response(json_encode($response));
        }
    }
}
