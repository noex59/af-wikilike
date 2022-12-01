<?php

namespace App\Controller\Admin;

use App\Entity\Technologie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TechnologieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Technologie::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('libelle'),
	        AssociationField::new('exemples')->hideOnForm()
        ];
    }

	public function configureCrud(Crud $crud): Crud {
		return $crud->setDefaultSort(['libelle' => "ASC"]);
	}
}
