<?php

namespace App\Controller\Admin;

use App\Entity\Dispositions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DispositionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dispositions::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Mises à dispositions des joueurs')
            ->setEntityLabelInSingular('Mise à disposition')
            ->setPageTitle('index', 'Listes des %entity_label_plural%')
            ->setPageTitle('new', 'Ajouter une %entity_label_singular%')
            ->setPageTitle('edit', 'Modifier une %entity_label_singular%');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Dispositions'),
            TextField::new('name')->setLabel('Nom des mises à dispositions des joueurs'),
        ];
    }

}
