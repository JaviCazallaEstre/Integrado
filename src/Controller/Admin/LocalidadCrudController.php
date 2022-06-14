<?php

namespace App\Controller\Admin;

use App\Entity\Localidad;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class LocalidadCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Localidad::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('nombre')
                ->setRequired(true)
                ->setLabel('Localidad'),
            yield AssociationField::new('provincia')
                ->setRequired(true)
                ->setLabel('Nombre provincia')
        ];
    }
}
