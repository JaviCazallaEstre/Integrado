<?php

namespace App\Controller\Admin;

use App\Entity\Variedad;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VariedadCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Variedad::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('variedad')
                ->setRequired(true)
                ->setLabel('Variedad')
        ];
    }
}
