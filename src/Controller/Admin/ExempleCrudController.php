<?php

namespace App\Controller\Admin;

use App\Entity\Exemple;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExempleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exemple::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
	        IdField::new('id')->hideOnForm(),
	        TextField::new('titre'),
	        TextareaField::new('description'),
	        TextareaField::new('code'),
	        AssociationField::new('technologies')->setRequired(true),
	        DateField::new('createdAt')->hideOnForm()->setFormat('dd/MM/YYYY HH:mm:ss')
        ];
    }
}
