<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        return [
            yield EmailField::new('email')
                ->setRequired(true),
            yield TextField::new('nombre')
                ->setRequired(true)
                ->setLabel("Nombre"),
            yield TextField::new('apellidos')
                ->setRequired(true)
                ->setLabel('Apellidos'),
            yield TextField::new('password')
                ->setRequired(true)
                ->setFormType(PasswordType::class)
                ->setLabel('Contraseña'),
            yield TextField::new('tipoVia')
                ->setRequired(true)
                ->setLabel('Tipo vía'),
            yield TextField::new('nombreVia')
                ->setRequired(true)
                ->setLabel('Nombre vía'),
            yield TextField::new('numeroVia')
                ->setRequired(true)
                ->setLabel('Número vía'),
            yield TextField::new('escalera')
                ->setRequired(false)
                ->setLabel('Escalera'),
            yield TextField::new('bloque')
                ->setRequired(false)
                ->setLabel('Bloque'),
            yield TextField::new('puerta')
                ->setRequired(false)
                ->setLabel('Puerta'),
            yield TextField::new('piso')
                ->setRequired(false)
                ->setLabel('Piso'),
            yield IntegerField::new('codigoPostal')
                ->setLabel('Código postal')
                ->setRequired(true),
            yield ChoiceField::new('roles')
                ->setChoices(array_combine($roles,$roles))
                ->allowMultipleChoices()
                ->renderExpanded()
                ->setRequired(true)
                ->setLabel('Rol'),
            yield AssociationField::new('localidad')
                ->setRequired(true)
                ->setLabel('Localidad')
        ];
    }
    
}
