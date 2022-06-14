<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Compra;
use App\Entity\Campana;
use App\Entity\Cosecha;
use App\Entity\Producto;
use App\Entity\Variedad;
use App\Entity\Localidad;
use App\Entity\Provincia;
use App\Controller\Admin\UserCrudController;
use App\Entity\Capacidad;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('AlmaVerde');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Alma Verde', 'fa fa-home');
        yield MenuItem::linkToCrud('Campaña', 'fas fa-list', Campana::class);
        yield MenuItem::linkToCrud('Usuarios', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Producto', 'fas fa-list', Producto::class);
        yield MenuItem::linkToCrud('Cosecha', 'fas fa-list', Cosecha::class);
        yield MenuItem::linkToCrud('Compra', 'fas fa-list', Compra::class);
        yield MenuItem::linkToCrud('Variedad', 'fas fa-list', Variedad::class);
        yield MenuItem::linkToCrud('Localidad', 'fas fa-list', Localidad::class);
        yield MenuItem::linkToCrud('Provincia', 'fas fa-list', Provincia::class);
        yield MenuItem::linkToCrud('Capacidad', 'fas fa-list', Capacidad::class);
    }
}
