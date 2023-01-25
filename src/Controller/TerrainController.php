<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TerrainController extends AbstractController
{
    #[Route('/terrain', name: 'app_terrain')]
    public function index(PaginatorInterface $paginator, ): Response
    {
        $terrains = $paginator->paginate();

        return $this->render('terrain/index.html.twig', [

        ]);
    }
}
