<?php

namespace App\Controller\Admin;

use App\Entity\Exemple;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExempleCrudController extends AbstractCrudController
{
    public const UPLOAD_BASE_DIR = "upload/videos/exemples";
    public const UPLOAD_VIDEO_DIR = "public/upload/videos/exemples";

    public static function getEntityFqcn(): string
    {
        return Exemple::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
	        IdField::new('id')->hideOnForm(),
	        TextField::new('titre')->setColumns(4),
	        TextareaField::new('description')->setColumns(8),
            AssociationField::new('technologies')->setColumns(4),
            CodeEditorField::new('code')->setColumns(8),
            ImageField::new('video')
                ->setFormType(FileUploadType::class)
                ->setBasePath(self::UPLOAD_BASE_DIR)
                ->setUploadDir(self::UPLOAD_VIDEO_DIR)
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->hideOnIndex()
                ->setColumns(4)
                ->setFormTypeOptions(['attr' => [
                        'accept' => 'video/mp4',
                    ]
                ]),
	        DateField::new('createdAt')->hideOnForm()->setFormat('dd/MM/YYYY HH:mm:ss')
        ];
    }
}
