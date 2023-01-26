<?php

namespace App\Controller;

use App\Repository\TerrainRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TerrainController extends AbstractController
{
    #[Route('/terrain', name: 'app_terrain', methods: ['GET'])]
    public function index(PaginatorInterface $paginator, TerrainRepository $terrainRepository, Request $request): Response
    {
        /**
         * This controller display all recettes
         * @param TerrainRepository $terrainRepository
         * @param PaginatorInterface $paginator
         * @param Request $request
         * @return Response
         */

        $terrains = $paginator->paginate(
            $terrainRepository->findAll(),
            $request->query->getInt('page', 1),
            1
        );

        return $this->render('terrain/index.html.twig', [
            'terrains' => $terrains
        ]);
    }
}
