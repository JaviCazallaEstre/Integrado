<?php

namespace App\Controller\Admin;

use App\Entity\Cosecha;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CosechaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cosecha::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('cosecha')
                ->setRequired(true)
                ->setLabel('Cosecha')
        ];
    }
}
