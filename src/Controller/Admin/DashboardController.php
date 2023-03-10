<?php

namespace App\Controller\Admin;

use App\Entity\Dispositions;
use App\Entity\Players;
use App\Entity\Terrain;
use App\Entity\Time;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FootBall Administration')
            ->setTranslationDomain('admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');
        yield MenuItem::section('Comptes Utilisateurs')->setCssClass('fs-5 font-weight-bold');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-users', User::class);
        yield MenuItem::section('Terrains')->setCssClass('fs-5 font-weight-bold');
        yield MenuItem::linkToCrud('Terrains', 'fa-solid fa-futbol', Terrain::class);
        yield MenuItem::section('Réservations')->setCssClass('fs-5 font-weight-bold');
        yield MenuItem::linkToCrud('Horaires', 'fa-regular fa-clock', Time::class);
        yield MenuItem::section('Joueurs')->setCssClass('fs-5 font-weight-bold');
        yield MenuItem::linkToCrud('Joueurs', 'fa-solid fa-users-line', Players::class);
        yield MenuItem::section('Mise à dispositions')->setCssClass('fs-5 font-weight-bold');
        yield MenuItem::linkToCrud('Disponibilités', 'fa-solid fa-users-line', Dispositions::class);
        yield MenuItem::section('Sites')->setCssClass('fs-5 font-weight-bold');
        yield MenuItem::subMenu('Pages', 'fa-solid fa-laptop')->setSubItems([
            MenuItem::linkToRoute('Accueil', 'fa-solid fa-house-laptop', 'app_home'),
            MenuItem::linkToRoute('Terrains', 'fa-solid fa-futbol', 'app_terrain'),
        ]);

        yield MenuItem::linkToLogout('Déconnexion', 'fa-solid fa-door-open')->setCssClass('btn btn-outline-danger mt-5');
    }
}
