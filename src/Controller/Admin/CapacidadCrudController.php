<?php

namespace App\Controller\Admin;

use App\Entity\Capacidad;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CapacidadCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Capacidad::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
