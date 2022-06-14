<?php

namespace App\Controller\Admin;

use App\Entity\Compra;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CompraCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Compra::class;
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
