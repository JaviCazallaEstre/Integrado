<?php

namespace App\Controller\Admin;

use App\Entity\Campana;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CampanaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Campana::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('campana')
                ->setLabel('Campaña')
                ->setRequired(true)
        ];
    }
}
