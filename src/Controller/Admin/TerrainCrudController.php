<?php

namespace App\Controller\Admin;

use App\Entity\Terrain;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TerrainCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Terrain::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Terrains')
            ->setEntityLabelInSingular('Terrain')
            ->setPageTitle('index', 'Listes des %entity_label_plural%')
            ->setPageTitle('new', 'Ajouter un %entity_label_singular%')
            ->setPageTitle('edit', 'Modifier un %entity_label_singular%');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Terrain'),
            TextField::new('name')->setLabel('Nom du terrain'),
            TextField::new('locate')->setLabel('Emplacement'),
            TextareaField::new('description')->setLabel('Description'),
            AssociationField::new('disposition'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
            ImageField::new('imageName')->setBasePath('/images/products/')->onlyOnIndex()->setLabel('Image'),


        ];
    }

}
