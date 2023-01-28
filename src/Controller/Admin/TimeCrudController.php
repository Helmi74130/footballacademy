<?php

namespace App\Controller\Admin;

use App\Entity\Time;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class TimeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Time::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Réservations')
            ->setEntityLabelInSingular('Réservation')
            ->setPageTitle('index', 'Listes des %entity_label_plural%')
            ->setPageTitle('new', 'Ajouter une %entity_label_singular%')
            ->setPageTitle('edit', 'Modifier une %entity_label_singular%');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Réservation'),
            DateField::new('date')->setLabel('Date de réservation'),
            TimeField::new('hour')->setLabel('Heures de réservation'),
            AssociationField::new('terrain'),

        ];
    }

}
