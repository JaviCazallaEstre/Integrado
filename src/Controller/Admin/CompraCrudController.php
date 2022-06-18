<?php

namespace App\Controller\Admin;

use App\Entity\Compra;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class CompraCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Compra::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            yield DateField::new('fecha')
                ->setLabel(""),
            yield MoneyField::new('coste')
                ->setRequired(true)
                ->setCurrency('EUR')
                ->setCustomOption('storedAsCent', false),
            yield AssociationField::new('compras')
                ->setCrudController(ProductoCrudController::class)
                ->setLabel("Productos")->formatValue(function ($value, $entity) {
                    $productos = $entity->getCompras()[0];
                    for ($i = 1; $i < $entity->getCompras()->count(); $i++) {
                        $productos = $productos . "</br>" . $entity->getCompras()[$i];
                    }
                    return $productos;
                }),
            yield AssociationField::new('usuario')
        ];
    }
}
