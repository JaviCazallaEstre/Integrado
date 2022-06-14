<?php

namespace App\Controller\Admin;

use App\Entity\Producto;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ProductoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Producto::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('nombre')
                ->setRequired(true)
                ->setLabel('Nombre producto'),
            yield MoneyField::new('precio')
                ->setRequired(true)
                ->setCurrency('EUR')
                ->setCustomOption('storedAsCent', false)
                ->setLabel('Precio'),
            yield TextEditorField::new('descripcion')
                ->setRequired(true)
                ->setLabel('Descripción'),
            yield AssociationField::new('variedad')
                ->setRequired(true)
                ->setLabel('Variedad'),
            yield AssociationField::new('cosecha')
                ->setRequired(true)
                ->setLabel('Cosecha'),
            yield ImageField::new('foto')
                ->setUploadDir('public/img/productos')
                ->setBasePath('img/productos')
                ->setLabel('Foto del producto'),
            yield AssociationField::new('capacidad')
                ->setRequired(true)
                ->setLabel('Capacidad'),
            yield AssociationField::new('campana')
                ->setRequired(true)
                ->setLabel('Campaña'),
            yield IntegerField::new('stock')
                ->setRequired(true)
                ->setLabel('Stock')
        ];
    }
}
